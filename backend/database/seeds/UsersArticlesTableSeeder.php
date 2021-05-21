<?php

use App\Infrastructure\DataAccess\Eloquent;
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
        factory(Eloquent\User::class, 10)->create()->each(function ($user) {
            $user->articles()->saveMany(factory(Eloquent\Article::class, 10)->make());
        });
    }
}
