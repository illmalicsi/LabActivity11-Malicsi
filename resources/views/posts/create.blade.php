@extends('layouts.app')

@section('title', 'New post')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('posts.index') }}" class="text-sm text-orange-700 hover:underline">← Back to posts</a>

    <div class="mt-4 rounded-lg bg-white p-5 shadow sm:p-8">
        <h1 class="text-2xl font-bold text-slate-900">New post</h1>
        <p class="mt-1 text-sm text-slate-500">Share an announcement with Purok Malicsi.</p>

        @if ($errors->any())
        <div class="mt-5 rounded-md border border-red-200 bg-red-50 p-4">
            <p class="text-sm font-semibold text-red-800">Please fix the following:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="title" class="mb-1 block text-sm font-medium text-slate-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full rounded-md border border-slate-300 p-2.5 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200">
                @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="mb-1 block text-sm font-medium text-slate-700">Body</label>
                <textarea id="body" name="body" rows="6"
                    class="w-full rounded-md border border-slate-300 p-2.5 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200">{{ old('body') }}</textarea>
                @error('body')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="mb-1 block text-sm font-medium text-slate-700">Category</label>
                <select id="category" name="category"
                    class="w-full rounded-md border border-slate-300 bg-white p-2.5 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category')===$category)>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <span class="mb-2 block text-sm font-medium text-slate-700">Tags</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="peer sr-only"
                            @checked(in_array($tag->id, old('tags', [])))>
                        <span class="inline-block rounded-full border border-slate-300 px-3 py-1 text-sm text-slate-700 transition peer-checked:border-orange-600 peer-checked:bg-orange-600 peer-checked:text-white hover:border-orange-400">
                            {{ $tag->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
                @error('tags')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('tags.*')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))
                        class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                    Publish now
                </label>
                @error('is_published')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
                <a href="{{ route('posts.index') }}" class="rounded-md px-4 py-2 text-sm text-slate-600 hover:bg-slate-100">Cancel</a>
                <button type="submit" class="rounded-md bg-orange-600 px-5 py-2 text-sm font-medium text-white hover:bg-orange-700">Save post</button>
            </div>
        </form>
    </div>
</div>
@endsection