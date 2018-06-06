<?php
namespace App\Repositories\Post;

interface PostRepositoryInterface
{
    /**
     * 得到所有已发布的文章
     * @return mixed
     */
    public function getAllPublished();

    /**
     * 得到单个已发布的文章
     * @return mixed
     */
    public function findOnlyPublished($id);
}