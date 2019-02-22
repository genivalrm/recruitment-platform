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
	public function index(Request $in)
	{
		$archived = $not_archived = [];
		if ( !$in->not_archived ) {
			$archived = Profile::where('archived', true)->orderBy('star', 'desc')->get();

		}
		if ( !$in->archived ) {
			$not_archived = Profile::where('archived', '!=', true)->orderBy('star', 'desc')->get();
		}

		foreach ($archived as $i => $profile) {
			$profile->_id = encrypt($profile->_id);
			$profile->tag = $this->listTag($profile->_id)['tag'];
		}
		foreach ($not_archived as $i => $profile) {
			$profile->_id = encrypt($profile->_id);
			$profile->tag = $this->listTag($profile->_id)['tag'];
		}

		if ($in->archived) {
			return view('card-section', ['profiles' => $archived]);
		}
		elseif ($in->not_archived) {
			return view('card-section', ['profiles' => $not_archived]);
		}
		else {
			return view('list-curriculas', ['archived' => $archived, 'not_archived' => $not_archived]);
		}
	}

	public function show($id)
	{
		//mostra o currículo
		$profile = Profile::find(decrypt($id));

		if (!empty($profile->curriculum_id)) {
			Curriculum::whereIn('_id', $profile->curriculum_id)->update([
				'profile_id' => $profile->id,
			]);
			$profile->unset('curriculum_id');
		}

		$curriculum = Curriculum::where('profile_id', $profile->id)
			->orderBy('created_at', 'desc')
			->first();

		if (!$curriculum) {
			return [
				'status' => 0,
				'message' => 'Arquivo não encontrado.',
			];
		}
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

	public function updateStar(Request $in, $id)
	{
		//atualizar estrelas
		$profile = Profile::find(decrypt($id));
		$profile->star = $in->star;
		$profile->save();
	}

	public function listTag($id)
	{
		//pegar tags
		$tag = [];
		$tag = array_merge(Profile::find(decrypt($id))->tag ?: [], Profile::find(decrypt($id))->office ?: []);
		$tag = Office::find((array) $tag)->pluck('name');
		return [
			'tag' => $tag,
		];
	}

	public function insertTag(Request $in, $id)
	{
		//inserir tag
		$profile = Profile::find(decrypt($id));
		$tag = Office::firstOrCreate(['name' => $in->tag])->_id;
		$profile->tag = $profile->push('tag', $tag);
	}

	public function deleteTag(Request $in, $id)
	{
		//deletar tag
		$profile = Profile::find(decrypt($id));

		$tag = Office::where('name', $in->tag)->first()->id;

		if(empty($profile->pull('tag', $tag))){
			$profile->office = $profile->pull('office', $tag);
		}
	}

	public function archive($id)
	{
		//arquivar profile
		$profile = Profile::find(decrypt($id));
		$profile->archived = true;
		$profile->save();
	}

	public function restore($id)
	{
		//desarquivar profile
		$profile = Profile::find(decrypt($id));
		$profile->archived = false;
		$profile->save();
	}
}