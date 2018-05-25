<?php
namespace App\Services;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 16:08
 */

use App\Repositories\PostRepository;

/**
 * Class PostService
 * @package App\Services
 */
class PostService
{

    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * PostService constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }




}