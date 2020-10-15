<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AppRedirectController extends Controller
{
    public function authenticate($uname){

        if(Auth::check()){
            Auth::logout();
        }
        
        if($uname){
             $user = User::where('uname',$uname)->first();
             if($user != null){
                if($user->is_active == 1){
                    Auth::login($user);
                    return redirect('/');
                }
                return view('auth.login_failed');
             } 
        }
        return view('auth.login_failed');
     }


     public function checkUser(Request $request){
            if($request->uname){
                return redirect('/');
            }
     }
    


 
}
