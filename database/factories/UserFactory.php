<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content;
use App\Event;
use App\EventContent;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123456'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Content::class, function (Faker $faker) {
    $title = $faker->unique()->sentence();
    $isPublished = ['1','0'];
    return [
        'uid' =>rand(1,5),
        'title' => $title,
        'detail' => str_slug($title),
        'sub_title' => $faker->sentence,
        'sub_detail' => $faker->paragraph,
        'post_type' => 'content',
        'is_published' => $isPublished[rand([0,1])],
        'created_at' => now(),
        'updated_at' => now(),

    ];
});

$factory->define(EventContent::class, function (Faker $faker) {

    return [
        'event_id' =>rand(1,5),
        'content_id' =>rand(1,00),
        'created_at' => now(),
        'updated_at' => now(),

    ];
});