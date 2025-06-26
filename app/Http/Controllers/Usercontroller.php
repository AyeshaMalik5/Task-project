<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function sign_up(Request $request){
        $data=$request->validate([  
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:8|',
        ]);
        $data['password']=bcrypt($data['password']);
        $user=User::create($data);
        if($user){
            return redirect()->route('login');
        }
    }
public function login(Request $request){
$credentials=$request->validate([
'email'=>'required|email',
'password'=>'required',
    ]);
    // dd($request);
    if(Auth::attempt($credentials)){
        $user=Auth::user();
        // dd($user,$user->role==='Admin');
        if($user->role==='Admin'){
            // dd('admin');
            return redirect()->route('admin')->with('success','login successfully.');
        }
        if($user->role==='Employee'){
            // dd('employee');
            return redirect()->route('employee')->with('success','login successfully.');
        }
else{
    echo('hi');
}

}

}
public function logout(Request $request){
Auth::logout();
return redirect()->route('login');
}
}
