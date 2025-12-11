<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post Pertama',
            'content' => 'Ini adalah post pertama yang dibuat oleh user 1',
            'user_id' => 1
        ]);
        
        Post::create([
            'title' => 'Post Kedua',
            'content' => 'Ini adalah post kedua yang dibuat oleh user 2',
            'user_id' => 2
        ]);
    }
}
