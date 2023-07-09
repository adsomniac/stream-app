<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('admin.auth.auth');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
    $credentails = $request->only('email', 'password');
    $credentails['role'] ='admin';

    if(Auth::attempt($credentails)){
        $request->session()->regenerate();

        return redirect()->route('admin.movie');
    }
    return back()->withErrors([
        'error' => 'Your credentials are wrong'
    ])->withInput();
    // dd($credentails);
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

}
