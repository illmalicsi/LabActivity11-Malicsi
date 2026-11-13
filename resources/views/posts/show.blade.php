@extends('layouts.app')

@section('content')
<a href="{{ route('posts.index') }}" class="text-blue-600 text-sm">Back to posts</a>

@if (session('status'))
<div class="mt-4 rounded bg-green-100 p-3 text-green-800">{{ session('status') }}</div>
@endif

<div class="border rounded p-4 md:p-6 mt-4">
    @if ($post->is_pinned)
    <span class="bg-yellow-200 text-xs rounded px-2 py-1">Pinned</span>
    @endif
    <span class="bg-gray-200 text-xs rounded px-2 py-1">{{ $post->category }}</span>

    <h1 class="text-2xl font-bold mt-2">{{ $post->title }}</h1>

    <p class="text-sm text-gray-600 mt-1">
        {{ $post->published_at->format('M d, Y') }} · {{ $post->views }} views ·
        By <a href="{{ route('authors.show', $post->author) }}" class="text-blue-600 hover:underline">{{ $post->author->name }}</a>
    </p>

    <div class="flex flex-wrap gap-1 mt-2">
        @foreach ($post->tags as $tag)
        <a href="{{ route('posts.index', ['tag' => $tag->name]) }}" class="bg-green-100 text-green-800 text-xs rounded-full px-2 py-0.5">{{ $tag->name }}</a>
        @endforeach
    </div>

    <p class="mt-4 whitespace-pre-line">{{ $post->body }}</p>
</div>

<section class="mt-8">
    <h2 class="text-lg font-semibold mb-3">Comments ({{ $post->comments->count() }})</h2>

    @auth
    @if ($errors->any())
    <div class="mb-3 rounded border border-red-300 bg-red-50 p-3 text-sm text-red-700">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
        @csrf
        <textarea name="body" rows="3" placeholder="Write a comment..." class="w-full border rounded p-2">{{ old('body') }}</textarea>
        @error('body')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="mt-2 bg-blue-600 text-white rounded px-4 py-2">Post comment</button>
    </form>
    @else
    <p class="mb-6">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in to comment</a>
    </p>
    @endauth

    @forelse ($post->comments as $comment)
    <div class="border rounded p-3 mb-3">
        <p class="font-semibold">{{ $comment->user->name }}</p>
        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
        <p class="mt-1">{{ $comment->body }}</p>
    </div>
    @empty
    <p class="text-gray-500">No comments yet.</p>
    @endforelse
</section>
@endsection