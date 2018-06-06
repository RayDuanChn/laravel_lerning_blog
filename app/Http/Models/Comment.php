<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    public function post(){
        //一对多反向
        return $this->belongsTo(Post::class);
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
