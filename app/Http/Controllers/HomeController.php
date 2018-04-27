<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Curriculum;
use App\Office;
use DB;


class HomeController extends Controller
{
	public function index(){
		$offices = Office::orderBy('created_at')->get();
		return view('insert-curriculum', ['offices' => $offices]);
	}

	public function create(){
		return view('insert-curriculum');	
	}

	public function store(Request $in) {
		
		$curriculum = new Curriculum;
		$curriculum->attachment_id = $this->processAttachment($in->file('curriculum'));
		$curriculum->save();

		$profile = Profile::where('email', strtolower($in->email))->first();
		if ( $profile ) {
			$profile->push('curriculum_id', $curriculum->id);
			$profile->name = $in->name;
			$profile->phone = $in->phone;
			$profile->internship = $in->internship;
			$profile->tag = $in->chage;
			if ($in->linkedin) {
				$profile->linkedin = $in->linkedin;
			}
			if ($in->github) {
				$profile->github = $in->github;
			}
			$profile->save();
			return redirect('/create')->with('message', 'Currículo e Perfil atualizados!');
		}
		
		$profile = new Profile;
		$profile->name = $in->name;
		$profile->phone = $in->phone;
		$profile->email = $in->email;
		$profile->internship = $in->internship;
		$profile->tag = $in->chage;
		if ($in->linkedin) {
			$profile->linkedin = $in->linkedin;
		}
		if ($in->github) {
			$profile->github = $in->github;
		}

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