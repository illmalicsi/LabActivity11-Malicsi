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
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.malicsi@bulletin.test')->first();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Happy Birthday, Kagawad Ivan Louie Malicsi!',
            'category' => 'Events',
            'body' => 'Today, June 17, we celebrate the birthday of our Kagawad Ivan Louie Malicsi. Daghang salamat sa imong serbisyo sa Purok Malicsi! Everyone is invited to a simple salo-salo at the purok hall this afternoon.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-06-17',
        ]);
    }
}
