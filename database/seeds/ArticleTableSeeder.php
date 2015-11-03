<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;
use App\Article;

class ArticleTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('articles')->delete();
        TestDummy::times(10)->create('App\Article');
    }

}