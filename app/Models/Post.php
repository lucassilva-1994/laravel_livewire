<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';
    protected $fillable = ['id','order','title','content','user_id','allowComments'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function getCreatedAtAttribute(){
        return date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute(){
        return date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id')->latest('order');
    }

    public function likes(){
        return $this->hasMany(Like::class,'post_id','id');
    }
}
