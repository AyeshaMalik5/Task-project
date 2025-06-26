<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
protected $fillable = ['name', 'description', 'category', 'code', 'user_id'];
public function images()
{
    return $this->morphMany(Image::class, 'task');
}
public function user(){
return  $this->belongsTo(User::class);
}
}
