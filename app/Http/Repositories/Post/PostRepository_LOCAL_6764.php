<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 17:24
 */

namespace App\Repositories;


use App\Models\Post;
use Illuminate\Support\Facades\DB;

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
     * 原生SQL查询
     * 返回一个数组，数组中的每个结果都是一个 StdClass 对象
     */

    public function originSQLQuery()
    {
        //两种select方法
        //1. ?插入符
        $users = DB::select('select * from users where active = ?', [1]);
        //2. 命名绑定
        $results = DB::select('select * from users where id = :id', ['id' => 1]);

       //插入
        DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        //更新
        $affected = DB::update('update users set votes = 100 where name = ?', ['John']);

        //事务
        DB::transaction(function () {
            DB::table('users')->update(['votes' => 1]);

            DB::table('posts')->delete();
        });
    }

    /**
     * 查询构造器
     * 查询构造器使用PDO参数绑定来保护您的应用程序免受 SQL 注入攻击
     * 返回一个包含 Collection 的结果，其中每个结果都是 PHP StdClass 对象的一个实例
     */
    public function queryBuilder(){
        //查询
        $users = DB::table('users')->get();

        //获取第一行
        $user = DB::table('users')->where('name', 'John')->first();

        //where
        $users = DB::table('users')->where('name', '=', 'John')->get();
        $users = DB::table('users')
            ->where('name', 'like', 'T%')
            ->get();
        //多条件时，传递数组where函数
        $users = DB::table('users')->where([
            ['status', '=', '1'],
            ['name', '<>', 'John'],
        ])->get();
        //whereIn
        $users = DB::table('users')
            ->whereIn('id', [1, 2, 3])
            ->get();

        //查询构造器还提供了各种聚合方法，例如 count， max， min， avg， 和 sum
        $users = DB::table('users')->count();
        $price = DB::table('t_order')->max('price');

        //原生方法
        $orders = DB::table('orders')
            ->selectRaw('price * ? as price_with_tax', [1.0825])
            ->get();

        $orders = DB::table('orders')
            ->whereRaw('price > IF(state = "TX", ?, 100)', [200])
            ->get();

        //Joins
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();

        //子查询
        DB::table('users')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereRaw('orders.user_id = users.id');
            })
            ->get();

        //插入
        DB::table('users')->insert(
            ['email' => 'john@example.com', 'votes' => 0]
        );

    }
}