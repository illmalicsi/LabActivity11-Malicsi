@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="mb-4 rounded bg-green-100 p-3 text-green-800">{{ session('status') }}</div>
@endif

@auth
@if (auth()->user()->author)
<div class="mb-4 flex justify-end">
    <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white rounded px-4 py-2">New post</a>
</div>
@endif
@endauth

<form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
    <input name="q" value="{{ request('q') }}" placeholder="Search title" class="border rounded px-3 py-2 flex-1">

    <select name="category" class="border rounded px-3 py-2">
        <option value="">All categories</option>
        @foreach ($categories as $c)
        <option value="{{ $c }}" @selected(request('category')===$c)>{{ $c }}</option>
        @endforeach
    </select>

    @if (request('tag'))
    <input type="hidden" name="tag" value="{{ request('tag') }}">
    @endif

    <button class="bg-blue-600 text-white rounded px-4 py-2">Filter</button>
</form>

@if (request('tag'))
<p class="text-sm text-gray-600 mb-4">
    Showing posts tagged <span class="font-semibold">{{ request('tag') }}</span> ·
    <a href="{{ route('posts.index', request()->except('tag', 'page')) }}" class="text-blue-600 hover:underline">Clear tag</a>
</p>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse ($posts as $post)
    <div class="border rounded p-4">
        @if ($post->is_pinned)
        <span class="bg-yellow-200 text-xs rounded px-2 py-1">Pinned</span>
        @endif
        <span class="bg-gray-200 text-xs rounded px-2 py-1">{{ $post->category }}</span>

        <h2 class="font-bold mt-2">
            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
        </h2>

        <p class="text-sm text-gray-600 mt-1">
            By <a href="{{ route('authors.show', $post->author) }}" class="text-blue-600 hover:underline">{{ $post->author->name }}</a>
        </p>

        <p class="text-sm text-gray-600 mt-1">
            {{ $post->published_at->format('M d, Y') }} · {{ $post->views }} views · {{ $post->comments_count }} comments
        </p>

        <div class="flex flex-wrap gap-1 mt-2">
            @foreach ($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->name]) }}" class="bg-green-100 text-green-800 text-xs rounded-full px-2 py-0.5">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    @empty
    <p>No posts match your search.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $posts->links() }}
</div>

<p class="text-sm text-gray-600 mt-2">
    Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
</p>
@endsection