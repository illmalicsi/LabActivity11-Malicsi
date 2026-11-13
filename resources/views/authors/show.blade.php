@extends('layouts.app')

@section('content')
<a href="{{ route('posts.index') }}" class="text-blue-600 text-sm">Back to posts</a>

<div class="border rounded p-4 md:p-6 mt-4">
    <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
    <p class="text-gray-600">{{ $author->position }}</p>
    <p class="text-sm text-gray-500 mt-1">{{ $author->comments_count }} comments received</p>
</div>

<h2 class="text-lg font-semibold mt-6 mb-3">Published posts</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse ($posts as $post)
    <div class="border rounded p-4">
        <span class="bg-gray-200 text-xs rounded px-2 py-1">{{ $post->category }}</span>

        <h3 class="font-bold mt-2">
            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
        </h3>

        <p class="text-sm text-gray-600 mt-1">
            By <a href="{{ route('authors.show', $author) }}" class="text-blue-600 hover:underline">{{ $author->name }}</a>
            · {{ $post->published_at->format('M d, Y') }} · {{ $post->comments_count }} comments
        </p>

        <div class="flex flex-wrap gap-1 mt-2">
            @foreach ($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->name]) }}" class="bg-green-100 text-green-800 text-xs rounded-full px-2 py-0.5">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    @empty
    <p class="text-gray-500">No published posts yet.</p>
    @endforelse
</div>
@endsection