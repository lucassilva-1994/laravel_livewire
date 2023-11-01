<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id','post_id','created_at'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
