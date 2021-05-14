<?php

use App\Infrastructure\DataAccess\Eloquent\Article;
use App\Infrastructure\DataAccess\Eloquent\User;
use Illuminate\Database\Seeder;

class UsersArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $user->articles()->saveMany(factory(Article::class, 10)->make());
        });
    }
}
