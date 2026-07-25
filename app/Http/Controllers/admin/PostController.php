<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index()
    {
        $posts = Post::with(['category', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store new post
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'category_id' => 'required|exists:categories,id',

            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',

            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',

            'author_name' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',

            'reading_time' => 'nullable|integer|min:1',

            'status' => 'required|in:draft,published',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            
        ]);

        $post = new Post();

        $post->user_id = Auth::id();

        $post->category_id = $request->category_id;

        $post->title = $request->title;

        $post->slug = Str::slug($request->title);

        $post->excerpt = $request->excerpt;

        $post->content = $request->content;

        /*
        |--------------------------------------------------------------------------
        | Upload Images
        |--------------------------------------------------------------------------
        */

       if ($request->hasFile('images')) {

    foreach ($request->file('images') as $index => $image) {

        if ($index >= 5) {
            break;
        }

        $post->{'image' . ($index + 1)} =
            $image->store('posts', 'public');
    }
}

        /*
        |--------------------------------------------------------------------------
        | News Options
        |--------------------------------------------------------------------------
        */

        $post->featured = $request->boolean('featured');

        $post->breaking_news = $request->boolean('breaking_news');

        $post->trending = $request->boolean('trending');

        $post->headline = $request->boolean('headline');

        $post->slider = $request->boolean('slider');

        $post->popular = $request->boolean('popular');

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $post->status = $request->status;

        if ($request->status == 'published') {

            $post->published_at = now();

            $post->published_by = Auth::id();

        }

        /*
        |--------------------------------------------------------------------------
        | Reporter
        |--------------------------------------------------------------------------
        */

        $post->author_name = $request->author_name;

        $post->source = $request->source;

        $post->reading_time = $request->reading_time ?? 1;

        /*
        |--------------------------------------------------------------------------
        | Comments
        |--------------------------------------------------------------------------
        */

        $post->allow_comments = $request->boolean('allow_comments');

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        $post->meta_title = $request->meta_title;

        $post->meta_description = $request->meta_description;

        $post->meta_keywords = $request->meta_keywords;

        /*
        |--------------------------------------------------------------------------
        | Active
        |--------------------------------------------------------------------------
        */

        $post->active = $request->boolean('active', true);

        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Edit post
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update post
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'content' => 'required',

            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $post->category_id = $request->category_id;

        $post->title = $request->title;

        $post->slug = Str::slug($request->title);

        $post->excerpt = $request->excerpt;

        $post->content = $request->content;

       if ($request->hasFile('images')) {

    for ($i = 1; $i <= 5; $i++) {

        if ($post->{'image'.$i}) {

            Storage::disk('public')->delete($post->{'image'.$i});

            $post->{'image'.$i} = null;
        }
    }

    foreach ($request->file('images') as $index => $image) {

        if ($index >= 5) {
            break;
        }

        $post->{'image'.($index + 1)} =
            $image->store('posts', 'public');
    }
}

        $post->featured = $request->boolean('featured');
        $post->breaking_news = $request->boolean('breaking_news');
        $post->trending = $request->boolean('trending');
        $post->headline = $request->boolean('headline');
        $post->slider = $request->boolean('slider');
        $post->popular = $request->boolean('popular');

        $post->status = $request->status;

        if ($request->status == 'published' && !$post->published_at) {

            $post->published_at = now();

            $post->published_by = Auth::id();

        }

        $post->author_name = $request->author_name;

        $post->source = $request->source;

        $post->reading_time = $request->reading_time;

        $post->allow_comments = $request->boolean('allow_comments');

        $post->meta_title = $request->meta_title;

        $post->meta_description = $request->meta_description;

        $post->meta_keywords = $request->meta_keywords;

        $post->active = $request->boolean('active');

        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Delete post
     */
 public function destroy(Post $post)
{
    for ($i = 1; $i <= 5; $i++) {

        $image = $post->{'image' . $i};

        if ($image) {
            Storage::disk('public')->delete($image);
        }
    }

    $post->delete();

    return back()->with('success', 'Post deleted successfully.');
}

    public function toggleStatus(Post $post)
{
    if ($post->status == 'published') {

        $post->status = 'draft';
        $post->published_at = null;

    } else {

        $post->status = 'published';
        $post->published_at = now();
        $post->published_by = auth()->id();

    }

    $post->save();

    return back()->with('success', 'Post status updated successfully.');
}

public function trash()
{
    $posts = Post::onlyTrashed()
        ->with(['category', 'user'])
        ->latest()
        ->paginate(10);

    return view('admin.posts.trash', compact('posts'));
}

public function restore($id)
{
    $post = Post::onlyTrashed()->findOrFail($id);

    $post->restore();

    return redirect()
        ->route('posts.trash')
        ->with('success', 'Post restored successfully.');
}


public function headlines()
{
    $posts = Post::latest()
        ->where('status', 'published')
        ->take(5)
        ->get();

    $message = "*ABS News Headlines For " . now()->format('jS F Y') . "*\n\n";

    foreach ($posts as $post) {
        $message .= "🔹 " . $post->title . "\n";
        $message .= route('posts.show', $post->slug) . "\n\n";
    }

    $message .= "Visit www.absradiotelevision.com for more news stories.";

    return view('admin.news.headlines', compact('message'));
}



}