<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table("users")->truncate();
        DB::table("posts")->truncate();
        Schema::enableForeignKeyConstraints();
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(30)->create();
    }
}
