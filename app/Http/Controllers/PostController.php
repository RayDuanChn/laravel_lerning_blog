<?php

namespace App\Http\Controllers;

use App\Http\Models\Post;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * 文章列表页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = $this->postService->index();
        return view('posts.index', compact("posts"));

    }

    /**
     * 文章详情页
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)    //Post模型绑定
    {
        //$post = $this->postService->show($post);
        $isShow = true;
        return view('posts.show', compact("post", "isShow"));

//        $posts = $this->postRepository->find($id);
//
//        return view('home.posts', compact('posts'));
    }

    /**
     * 保存新文章
     *
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd = dump and die
        //dd(\Request::all());          //查看传入的参数
        //dd(request());              //查看传入的参数的对象
        //dd($request->all()); //查看传入的参数
       //$name = $request->input('name', 'Sally');


//        $data = $request->all();
//
        $params = $request->all('title', 'content');

        //验证
//        $request->validate([
//            'title' => 'required|max:255|min:5|string',
//            'content' => 'required|min:10',
//        ]);

        $this->validate($request, [
            'title' => 'required|max:255|min:5|string',
            'content' => 'required|min:10',
        ]);


        //逻辑
        $this->postService->createPost($params);

        //渲染
        return redirect("/posts"); //定位到路由/posts
    }

    /**
     * 创建文章页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('posts.create');
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|max:255|min:5|string',
            'content' => 'required|min:10',
        ]);

        //逻辑
        $post->title = request("title");
        $post->content = request("content");
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}"); //跳转到详情页
    }


    public function delete(Post $post)
    {
        dd($post);
       $post->delete();
        return redirect("/posts");
    }

    public function sessionExample(Request $request){
        \Request::all();

        //处理 Session 数据有两种主要方法：
        //1. 全局辅助函数 session
            // 获取 session 中的一条数据...
            $value = session('key');
            // 指定一个默认值...
            $value = session('key', 'default');
            // 在 Session 中存储一条数据...
            session(['key' => 'value']);

        //2. 通过一个 Request 实例
            $value = $request->session()->get('key', 'default');
            //获取全部session
            $data = $request->session()->all();
            //存储数据
            $request->session()->put('key', 'value');
            // Session 中是否存在某个值
            if ($request->session()->has('users')) {
                //
            }
    }

    public function logExample(\Psr\Log\LoggerInterface $log){
        $app = app();   //获取容器
       // \Log::info("asd");    //Fa
        $log = $app->make('log');
        $log->info();


    }
}