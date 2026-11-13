@extends('layouts.app')

@section('content')
<a href="{{ route('posts.index') }}" class="text-blue-600 text-sm">Back to posts</a>

<div class="border rounded p-4 md:p-6 mt-4">
    @if ($post->is_pinned)
    <span class="bg-yellow-200 text-xs rounded px-2 py-1">Pinned</span>
    @endif
    <span class="bg-gray-200 text-xs rounded px-2 py-1">{{ $post->category }}</span>

    <h1 class="text-2xl font-bold mt-2">{{ $post->title }}</h1>

    <p class="text-sm text-gray-600 mt-1">
        {{ $post->published_at->format('M d, Y') }} · {{ $post->views }} views · Author ID: {{ $post->author_id }}
    </p>

    <p class="mt-4 whitespace-pre-line">{{ $post->body }}</p>
</div>
@endsection