<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all user IDs
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 25) as $index) {
            // Choose a random user ID from the available user IDs
            $userId = $faker->randomElement($userIds);

            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'posted_by' => $userId,
                'image' => $faker->imageUrl($width = 640, $height = 480), // Generate a fake image URL
                'created_at' => now(),
                'updated_at' => now(),
                // Add other columns as necessary
            ]);
        }
    }
}
