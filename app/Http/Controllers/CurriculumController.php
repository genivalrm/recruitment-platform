<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curriculum;
use App\Profile;
use App\Office;
use DB;
use MongoDB\BSON\ObjectId;
use View;

class CurriculumController extends Controller
{
	public function index(Request $in){
		if(!$in->name){
			$profiles = 
			$archived = Profile::where('archived', true)->orderBy('created_at')->get();
			$not_archived = Profile::where('archived', '!=', true)->orderBy('created_at')->get();
		}
		else{
			$name = str_replace(' ', '.*', $in->name);
			$profiles = Profile::where('name', 'regex',"/$name/gi")->get();
		}
		$curriculum_ids = [];

		foreach ($archived as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = Office::find((array) $profile->office)->pluck('name');
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		foreach ($not_archived as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = Office::find((array) $profile->office)->pluck('name');
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');

		return view('list-curriculas', ['archived' => $archived, 'not_archived' => $not_archived, 'curriculas' => $curriculas]);
	}

	public function store(Request $in){
		$curriculum = Curriculum::find(decrypt($in->id));
		$curriculum->save();

		return redirect('curriculum');
	}

	public function show($id) {
		$curriculum = Curriculum::find(decrypt($id));
		$bucket = DB::getMongoDB()->selectGridFSBucket([ 'bucketName' => 'attachment' ]);
		$stream = $bucket->openDownloadStream(new ObjectId($curriculum->attachment_id));
		if ( !isset($stream) ) {
			return [
				'status' => 0,
				'message' => 'Arquivo não encontrado.',
			];
		}
		$metadata = $bucket->getFileDocumentForStream($stream);
		$mimeType = isset($metadata['mimeType']) ?
			$metadata['mimeType'] : $metadata['metadata']['mimeType'];

		return response(stream_get_contents($stream))->header('Content-Type', $mimeType);
	}

	public function updateStar(Request $in, $id){
		$profile = Profile::find(decrypt($id));
		$profile->star = $in->star;
		$profile->save();
	}

	public function listTag($id){
		$tag = Profile::find(decrypt($id))->tag;
		$tag = Office::find((array) $tag)->pluck('name');
		return [
			'tag' => $tag,
		]; 
	}

	public function insertTag(Request $in, $id){
		$profile = Profile::find(decrypt($id));
		$tag = Office::firstOrCreate(['name' => $in->tag])->_id;
		$profile->tag = $profile->push('tag', $tag);
	}

	public function deleteTag(Request $in, $id){
		$profile = Profile::find(decrypt($id));

		$tag = Office::where('name', $in->tag)->first()->id;

		$profile->tag = $profile->pull('tag', $tag);
	}

	public function listArchived(){
		$profiles = Profile::where('archived', true)->orderBy('created_at')->get();
		$curriculum_ids = [];
		foreach ($profiles as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = Office::find((array) $profile->office)->pluck('name');
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');
		return view('card-section', ['profiles' => $profiles, 'curriculas' => $curriculas]);
	}
	public function listNotArchived(){
		$profiles = Profile::where('archived', '!=', true)->orderBy('created_at')->get();
		$curriculum_ids = [];
		foreach ($profiles as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = Office::find((array) $profile->office)->pluck('name');
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');
		return view('card-section', ['profiles' => $profiles, 'curriculas' => $curriculas]);
	}
	public function archive($id){
		$profile = Profile::find(decrypt($id));
		$profile->archived = true;
		$profile->save();
	}

	public function restore($id){
		$profile = Profile::find(decrypt($id));
		$profile->archived = false;
		$profile->save();
	}
}