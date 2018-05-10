<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Curriculum;
use App\Office;
use DB;
use Session;


class HomeController extends Controller
{
	public function index(){
		$offices = Office::where('is_office', true)->orderBy('created_at')->get();
		//foreach ($offices as $office) {
		//	$office->id = crypt($office->id);
		//}
		return view('insert-curriculum', ['offices' => $offices]);
	}

	public function store(Request $in){
		$this->validate($in, [
            'name' => 'required',
            'email' => 'required|email',
			'tel' => 'required|min:14|max:15',
			'upload-btn' => 'required|file|mimes:pdf',
			'g-recaptcha-response' => 'required|recaptcha',
			'github' => 'nullable|url',
			'linkedin' => 'nullable|url',
		]);
		
		$curriculum = new Curriculum;
		$curriculum->attachment_id = $this->processAttachment($in->file('upload-btn'));
		$curriculum->save();

		//$tags = (array) $in->office;
		// $tags = Office::find((array) $in->office)->pluck('name');
		// $tags = Office::whereIn('_id', (array) $in->office)->get()->pluck('name');
		// foreach ($tags as $i => $id) {
		// 	$office = Office::where('_id', $id)->first();
		// 	$id = $office->name;
		// 	$tags[$i] = $office->name;
		// }

		$profile = Profile::where('email', strtolower($in->email))->first();
		if ( $profile ) {
			$profile->push('curriculum_id', $curriculum->id);
			$profile->name = $in->name;
			$profile->phone = $in->tel;
			$profile->star = '0';
			$profile->internship = $in->internship;
			$profile->office = $in->office;
			if ($in->linkedin) {
				$profile->linkedin = $in->linkedin;
			}
			if ($in->github) {
				$profile->github = $in->github;
			}
			$profile->save();
			return redirect('/');
		}
		
		$profile = new Profile;
		$profile->name = $in->name;
		$profile->phone = $in->tel;
		$profile->star = '0';
		$profile->email = $in->email;
		$profile->internship = $in->internship;
		$profile->office = $in->office;
		if ($in->linkedin) {
			$profile->linkedin = $in->linkedin;
		}
		if ($in->github) {
			$profile->github = $in->github;
		}

		$profile->push('curriculum_id', $curriculum->id);
		$profile->save();

		Session::flash('curriculumSended', 'Prontinho! Recebemos seu currículo. Entraremos em contrato em breve. Obrigado! :)');

		return redirect('/');
	}
	
	private function processAttachment($attachment){
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