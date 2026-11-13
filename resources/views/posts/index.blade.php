@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
    <input name="q" value="{{ request('q') }}" placeholder="Search title" class="border rounded px-3 py-2 flex-1">

    <select name="category" class="border rounded px-3 py-2">
        <option value="">All categories</option>
        @foreach ($categories as $c)
        <option value="{{ $c }}" @selected(request('category')===$c)>{{ $c }}</option>
        @endforeach
    </select>

    <button class="bg-blue-600 text-white rounded px-4 py-2">Filter</button>
</form>

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
            {{ $post->published_at->format('M d, Y') }} · {{ $post->views }} views
        </p>
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