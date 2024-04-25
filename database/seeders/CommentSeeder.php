<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Seed the comments table with sample data.
     */
    public function run()
    {
        // Get all post IDs
        $postIds = Post::pluck('id')->toArray();

        $userIds = User::pluck('id')->toArray();

        $faker = Faker::create();

        // Loop through each post
        foreach ($postIds as $postId) {
            // Generate a random number of comments for each post
            $numComments = rand(1, 5);

            // Loop through each comment for the current post
            for ($i = 0; $i < $numComments; $i++) {
                Comment::create([
                    'post_id' => $postId,
                    'user_id' => $faker->randomElement($userIds),
                    'content' => $faker->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
