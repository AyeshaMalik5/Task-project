<?php

namespace App\Http\Controllers;

use App\Events\testemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class emailController extends Controller
{
  public function getUserEmail(){
 $data = Auth::guard('employee')->user();
$userid=$user->id;
  }

  public function testemail(){
    // dd('hello');
    event(new testemail("User sign up successfully thank you."));
  }
}
