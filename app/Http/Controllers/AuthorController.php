<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        $author->loadCount('comments');

        $posts = $author->posts()
            ->with('tags')
            ->withCount('comments')
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        return view('authors.show', compact('author', 'posts'));
    }
}
