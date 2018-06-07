<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 11:13
 */

namespace App\Http\Controllers;


use App\Http\Models\Post;

class DbtestController extends Controller
{

    public function test(Post $post){
        $comments = $post->comments();
        dd($comments);
    }
}