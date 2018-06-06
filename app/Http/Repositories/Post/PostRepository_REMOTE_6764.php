<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 17:24
 */

namespace App\Http\Repositories\Post;


use App\Http\Models\Post;
use App\Http\Repositories\EloquentRepository;

class PostRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }

    /**
     * Get all posts only published
     * @return mixed
     */
    public function getAllPublished()
    {
        $result = $this->_model->where('is_published', 1)->get();

        return $result;
    }

    /**
     * Get posts only published
     * @param $id int Post ID
     * @return mixed
     */
    public function findOnlyPublished($id)
    {
        $result = $this
            ->_model
            ->where('id', $id)
            ->where('is_published', 1)
            ->first();

        return $result;
    }

    /**
     * 分页
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatePosts(){
        $results = Post::orderBy("created_at", 'desc')->paginate(5);     //分页
        return $results;
    }


}