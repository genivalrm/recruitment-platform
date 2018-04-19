<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curriculum;
use DB;
use MongoDB\BSON\ObjectId;

class CurriculumController extends Controller
{
	public function store(Request $in) {

		$curriculum = Curriculum::find(decrypt($in->id));
		$curriculum->status = $in->option;
		$curriculum->save();

		return redirect('/');
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