<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['id','order','name','username','email','password','about_me'];
    protected $keyType = 'string';
    public $incrementing = false;
 
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function likes(){
        return $this->hasMany(Like::class,'user_id','id');
    }
}
