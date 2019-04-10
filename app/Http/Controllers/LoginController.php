<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{

	public function index()
	{
        if (Auth::check()) {
            return redirect(action('CurriculumController@index'));
        }
        
        return view('login');
	}

	public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
			'password' => 'required'
        ]);
        
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('curriculum');
        }
        return redirect()->intended('auth')->with('message', 'Dados Incorretos');
    }

    public function logout()
    {
    	auth()->logout();
    	return redirect(action('HomeController@index'));
    }
}