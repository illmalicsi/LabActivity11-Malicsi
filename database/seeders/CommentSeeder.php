<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id');

        foreach (Post::where('is_published', true)->get() as $post) {
            Comment::factory()->count(rand(0, 5))->create([
                'post_id' => $post->id,
                'user_id' => fn () => $userIds->random(),
            ]);
        }

        $pinned = Post::where('is_pinned', true)->first();
        $lola = User::where('email', 'lola.malicsi@bulletin.test')->first();
        $others = User::where('id', '!=', $lola->id)->inRandomOrder()->take(2)->get();

        $pinned->comments()->create([
            'user_id' => $lola->id,
            'body' => 'Happy birthday! Daghang salamat sa imong serbisyo sa purok.',
        ]);

        foreach ($others as $user) {
            $pinned->comments()->create([
                'user_id' => $user->id,
                'body' => 'Happy birthday! God bless.',
            ]);
        }
    }
}
