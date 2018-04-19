<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Curriculum;
use DB;


class HomeController extends Controller
{
	public function index(){
		$profiles = Profile::orderBy('created_at')->get();
		$curriculum_ids = [];
		foreach ($profiles as $i => $profile) {
			$profile->curriculum_id = collect($profile->curriculum_id)->last();
			$curriculum_ids[] = $profile->curriculum_id;
			// $profile->curriculo = Curriculum::find($curriculum_id);
			// dump(Curriculum::find($curriculum_id));
		}
		$curriculas = Curriculum::find($curriculum_ids)->keyBy('id');
		return view('list-curriculas', ['profiles' => $profiles, 'curriculas' => $curriculas]);
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
			$profile->office = $in->office;
			$profile->phone = $in->phone;
			$profile->tag = $in->tag;
			$profile->save();
			return redirect('/create')->with('message', 'Currículo e Perfil atualizados!');
		}
		
		$profile = new Profile;
		$profile->name = $in->name;
		$profile->office = $in->office;
		$profile->phone = $in->phone;
		$profile->email = $in->email;
		$profile->tag = $in->tag;
		$profile->push('curriculum_id', $curriculum->id);
		$profile->save();

		return redirect('/create')->with('message', 'Currículo enviado!');
	}

	public function show($in){

	}

	 public function edit($id)
    {
       
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