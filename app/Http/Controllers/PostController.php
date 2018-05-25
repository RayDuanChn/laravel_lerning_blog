<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\RepositoryInterface
     */
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * 文章列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = [
            ["title" => "this title 1"],
            ["title" => "this title 2"],
            ["title" => "this title 3"],
        ];
        $name = [];
        return view('posts.index', compact("posts", "name"));
//        $posts = $this->postRepository->getAll();
//
//        return view('home.posts', compact('posts'));
    }

    /**
     * 文章详情页
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', ['title' => "This is a title", 'isShow' => false]);

//        $posts = $this->postRepository->find($id);
//
//        return view('home.posts', compact('posts'));
    }

    /**
     * Create single posts
     *
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->postRepository->create($data);

        return view('home.posts', compact('posts'));
    }


    public function create(){
        return view('posts.create');
    }

    public function edit(){
        return view('posts.edit');
    }

    /**
     * Update single posts
     *
     * @param $request \Illuminate\Http\Request
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->postRepository->update($id, $data);

        return view('home.posts', compact('posts'));
    }

    /**
     * Delete single posts
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return view('home.posts');
    }
}