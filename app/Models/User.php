<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
      use Notifiable;
      use HasFactory;
    
    protected $fillable=['name','email','password','role','updated_at','created_at'];
  public function task(){
    return $this->hasMany(Task::class);
  }
    

}

