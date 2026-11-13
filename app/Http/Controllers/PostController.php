<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%'.$request->input('q').'%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->input('category'));
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('name', $request->input('tag'));
                });
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(7)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        abort_if(! $post->is_published, 404);

        $post->views = $post->views + 1;
        $post->save();

        $post->load([
            'author',
            'tags',
            'comments' => fn ($query) => $query->latest(),
            'comments.user',
        ]);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        $categories = Post::CATEGORIES;

        return view('posts.create', compact('tags', 'categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->safe()->except('tags');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($request->validated('tags'));

        if (! $post->is_published) {
            return redirect()->route('posts.index')->with('status', 'Draft saved. It will not show on the bulletin until published.');
        }

        return redirect()->route('posts.show', $post->id)->with('status', 'Post created.');
    }
}
