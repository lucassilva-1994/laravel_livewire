<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id','order','title','content','user_id'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function getCreatedAtAttribute(){
        return date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
