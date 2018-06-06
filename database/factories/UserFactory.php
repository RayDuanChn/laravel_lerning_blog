<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
/**
 *  tinker中执行 ：factory(App\User::class,20)->create(); 插入到数据库
 */
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

/**
 *
 *  tinker中执行 ：factory(\App\Http\Models\Post::class,20)->make(); 显示结果到页面
 *                factory(\App\Http\Models\Post::class,20)->create();
 */
$factory->define(\App\Http\Models\Post::class, function(Faker $faker){
    return [
        'title' => $faker->sentence(6, true),   //6个单词
        'content' => $faker->text(500),
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        }
    ];
});



