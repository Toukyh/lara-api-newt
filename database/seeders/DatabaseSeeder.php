<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = User::factory(10)->create();
        $users->each(function($user)use($users){
            Post::factory(rand(1,5))->create([
                'user_id'=>$user->id,
            ])->each(function($post) use ($users){
                Comment::factory(rand(2,8))->create([
                    'post_id'=>$post->id,
                    'user_id'=>($users->random(1)->first())->id
                ]);
            });
        });
    }
}
