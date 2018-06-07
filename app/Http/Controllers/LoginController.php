<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:37
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * 身份认证.
     *
     * @return Response
     * attempt 方法会接受一个键值对数组作为其第一个参数。这个数组的值将用来在数据库表中查找用户
     */
    public function authenticate()
    {

        if (\Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            // 认证通过...
            return redirect()->intended('dashboard');
        }
    }

    /**
     * 注销用户
     */
    public function logout(){
        \Auth::logout();
    }
}