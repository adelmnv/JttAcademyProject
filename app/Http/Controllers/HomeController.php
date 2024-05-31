<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\{User,Coach,Category};

class HomeController extends Controller
{
    
    public function index(){
        return view('main_page');
    }

    public function about(){
        return view('about_page');
    }

    public function user_login(){
        return view('user.login');
    }

    public function user_auth(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|min:4|max:255',
            'password' => 'required|min:4|max:255'
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)){
            $request->session()->regenerate();
            return redirect()->intended(); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function user_logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }

    public function admin_dash(){
        $posts = Post::all();
        return view('user.dash',compact('posts'));
    }

    

}
