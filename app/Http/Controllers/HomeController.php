<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Curriculum;
use App\Office;
use DB;
use Session;


class HomeController extends Controller
{
	public function index()
	{
		//pega as áres de interesse do banco e direciona para a tela de submeter currículos
		$offices = Office::where('is_office', true)->orderBy('created_at')->get();

		return view('insert-curriculum', ['offices' => $offices]);
	}

	public function store(Request $in)
	{
		// salva o currículo
		// checagem dos dados recebidos
		$this->validate($in, [
            'name' => 'required',
            'email' => 'required|email',
			'tel' => 'required|min:14|max:15',
			'upload-btn' => 'required|file|mimes:pdf',
			'g-recaptcha-response' => 'required|recaptcha',
			'github' => 'nullable|url',
			'linkedin' => 'nullable|url',
		]);
		//verifica se profile já existe atráves da checagem de e-mail
		$profile = Profile::where('email', strtolower($in->email))->first();
		if ( !$profile ) {
			$profile = new Profile;
		}
		//salva dados do profile		
		$profile->name = $in->name;
		$profile->phone = preg_replace("/\D+/", "", $in->tel);
		$profile->star = '0';
		$profile->email = $in->email;
		$profile->internship = $in->internship;
		$profile->office = $in->office;
		$profile->tag = [];
		$profile->archived = false;
		if ($in->linkedin) {
			$profile->linkedin = $in->linkedin;
		}
		if ($in->github) {
			$profile->github = $in->github;
		}
		$profile->save();
		//salva currículo
		$curriculum = new Curriculum;
		$curriculum->attachment_id = $this->processAttachment($in->file('upload-btn'));
		$curriculum->profile_id = $profile->_id;
		$curriculum->save();
		//msg
		Session::flash('curriculumSended', 'Prontinho! Recebemos seu currículo. Entraremos em contrato em breve. Obrigado! :)');
		//redireciona para a página de submeter currículo
		return redirect('/');
	}
	
	private function processAttachment($attachment)
	{
		//salva o pdf do currículo
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