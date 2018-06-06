<?php
namespace App\Http\Services;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 16:08
 */
use App\Http\Repositories\Post\PostRepository;


/**
 * Class PostService
 * @package App\Services
 */
class PostService
{

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(){
        //return $this->postRepository->getAll();
        return $this->postRepository->getPaginatePosts();

    }

    public function show($id){
        return $this->postRepository->find($id);
    }

    public function createPost($params){
//        $title = $params["title"];
//        $content = $params["content"];

        $this->postRepository->create($params);
    }





}