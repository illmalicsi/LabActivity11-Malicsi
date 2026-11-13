<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn($seq) => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.malicsi@bulletin.test')->first();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Purok Malicsi Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'All residents of Purok Malicsi are invited to join the clean-up drive. Please bring your own gloves and walis.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-06-17',
        ]);
    }
}
