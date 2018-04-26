<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Curriculum;
use DB;


class HomeController extends Controller
{
	public function index(){
		return view('insert-curriculum');
	}

	public function create(){
		return view('insert-curriculum');	
	}

	public function store(Request $in) {
		
		$curriculum = new Curriculum;
		$curriculum->status = '1'; // 1 = Pendente
		$curriculum->attachment_id = $this->processAttachment($in->file('curriculum'));
		$curriculum->save();

		$profile = Profile::where('email', strtolower($in->email))->first();
		if ( $profile ) {
			$profile->push('curriculum_id', $curriculum->id);
			$profile->name = $in->name;
			$profile->phone = $in->phone;
			$profile->linkedin = $in->linkedin;
			$profile->github = $in->github;
			$profile->internship = $in->internship;
			$profile->office = $in->office;

			$profile->save();
			return redirect('/create')->with('message', 'Currículo e Perfil atualizados!');
		}
		
		$profile = new Profile;
		$profile->name = $in->name;
		$profile->phone = $in->phone;
		$profile->email = $in->email;
		$profile->linkedin = $in->linkedin;
		$profile->github = $in->github;
		$profile->internship = $in->internship;
		$profile->office = $in->office;

		$profile->push('curriculum_id', $curriculum->id);
		$profile->save();

		return redirect('/create')->with('message', 'Currículo enviado!');
	}

	private function processAttachment($attachment)
	{
		if ($attachment->isValid()) {
			$bucket = DB::getMongoDB()->selectGridFSBucket(['bucketName' => 'attachment']);
			$file = fopen($attachment->getRealPath(), 'rb');
			$id = $bucket->uploadFromStream($attachment->getClientOriginalName(), $file, [
				'metadata' => ['mimeType' => $attachment->getClientMimeType()],
			]);
			return $id;
		}
		else
			return false;
	}
}