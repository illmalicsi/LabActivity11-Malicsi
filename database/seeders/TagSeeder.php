<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Purok Malicsi', 'Urgent', 'Libre', 'Schedule', 'Fiesta'];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }

        $tagIds = Tag::pluck('id');

        foreach (Post::all() as $post) {
            $post->tags()->attach($tagIds->random(rand(1, 3)));
        }

        $pinned = Post::where('is_pinned', true)->first();
        $pinned->tags()->sync(
            Tag::whereIn('name', ['Purok Malicsi', 'Urgent'])->pluck('id')
        );
    }
}
