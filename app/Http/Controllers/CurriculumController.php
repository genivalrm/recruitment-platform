<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curriculum;
use App\Profile;
use DB;
use MongoDB\BSON\ObjectId;

class CurriculumController extends Controller
{
	public function index(Request $in){
		if(!$in->name){
			$profiles = Profile::orderBy('created_at')->get();	
		}
		else{
			$name = str_replace(' ', '.*', $in->name);
			$profiles = Profile::where('name', 'regex',"/$name/gi")->get();
		}
		$curriculum_ids = [];
		foreach ($profiles as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			$profile->office = (array) $profile->office;
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');
		return view('list-curriculas', ['profiles' => $profiles, 'curriculas' => $curriculas]);
	}

	public function store(Request $in) {

		$curriculum = Curriculum::find(decrypt($in->id));
		$curriculum->save();

		return redirect('curriculum');
	}

	public function show($id)
	{
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
}