<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\User;

class AppController extends Controller
{
    public function home()
    {

        // user::create(['name'=>'admin','username'=>'supAdmin','email'=>'bellaaj.habib@gmail.com','password'=>hash::make('0000')]);
        //  $au= Auth::attempt(['email'=>'mohamed@gamil.com','password'=>'0000']);
        //  dd(Auth::check());
        //Auth::logout();
        //	dd(Auth::check());
        if (Auth::check()) {
            return view('home');
        } else {
            return Redirect::to('auth/login');
        }

    }
}
