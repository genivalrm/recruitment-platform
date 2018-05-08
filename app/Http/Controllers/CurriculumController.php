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
		$archived = $not_archived = [];
		if ( !$in->not_archived ) {
			$archived = Profile::where('archived', true)->orderBy('created_at')->get();

		}
		if ( !$in->archived ) {
			$not_archived = Profile::where('archived', '!=', true)->orderBy('created_at')->get();
		}
			
		$curriculum_ids = [];
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');
		foreach ($archived as $i => $profile) {
			$profile->id = encrypt($profile->_id);
			$profile->curriculum_id = encrypt(collect($profile->curriculum_id)->last());
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = $this->listTag($profile->id)['tag'];
		}
		foreach ($not_archived as $i => $profile) {
			$profile->id = encrypt($profile->_id);
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->tag = $this->listTag($profile->id)['tag'];
		}
		if ($in->archived){
			return view('card-section', ['profiles' => $archived, 'curriculas' => $curriculas]);
		}
		elseif ($in->not_archived){
			return view('card-section', ['profiles' => $not_archived, 'curriculas' => $curriculas]);
		}
		else{
			return view('list-curriculas', ['archived' => $archived, 'not_archived' => $not_archived, 'curriculas' => $curriculas]);	
		}
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
		$tag = [];
		$tag = array_merge(Profile::find(decrypt($id))->tag ?: [], Profile::find(decrypt($id))->office ?: []);
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