<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PostView;
use App\Models\Post;

class UserPostController extends Controller
{
    /**
     * Display posts for a category.
     */
    public function category(Category $category)
{
    // Posts for this category
    $posts = Post::with(['category', 'user'])
        ->where('category_id', $category->id)
        ->where('status', 'published')
        ->latest()
        ->paginate(10);

    // Categories
    $allCategories = Category::withCount('posts')->get();

    // // Latest Posts (checked by admin)
    // $latestPosts = Post::with(['category', 'user'])
    //     ->where('status', 'published')
    //     ->where('latest', 1)
    //     ->latest()
    //     ->take(5)
    //     ->get();

    // Trending Posts (checked by admin)
    $trendingPosts = Post::with(['category', 'user'])
        ->where('status', 'published')
        ->where('trending', 1)
        ->latest()
        ->take(5)
        ->get();

    // Popular Posts (checked by admin)
    $popularPosts = Post::with(['category', 'user'])
        ->where('status', 'published')
        ->where('popular', 1)
        ->latest()
        ->take(5)
        ->get();

    // Slider Posts (checked by admin)
    $sliderPosts = Post::with(['category', 'user'])
        ->where('status', 'published')
        ->where('slider', 1)
        ->latest()
        ->take(5)
        ->get();

  

    return view('user.posts.category', compact(
        'category',
        'posts',
        'allCategories',
        'trendingPosts',
        'popularPosts',
        'sliderPosts',
    ));
}


public function show($slug)
{
    $post = Post::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

        // Remove empty paragraphs from the content
    $post->content = preg_replace(
        '~<p>(?:\s|&nbsp;|<br\s*/?>)*</p>~i',
        '',
        $post->content
    );

  $ip = request()->ip();

$alreadyViewed = PostView::where('post_id', $post->id)
    ->where('ip_address', $ip)
    ->exists();

if (!$alreadyViewed) {

    $post->increment('views');

    PostView::create([
        'post_id'    => $post->id,
        'ip_address' => $ip,
    ]);
}

    // Previous post
    $previousPost = Post::where('status', 'published')
        ->where('id', '<', $post->id)
        ->orderBy('id', 'desc')
        ->first();

    // Next post
    $nextPost = Post::where('status', 'published')
        ->where('id', '>', $post->id)
        ->orderBy('id')
        ->first();

    $relatedPosts = Post::where('category_id', $post->category_id)
        ->where('id', '!=', $post->id)
        ->latest()
        ->take(5)
        ->get();
        

        $comments = $post->comments()
    ->with(['user','replies.user'])
    ->latest()
    ->get();

    return view('user.posts.show', compact(
        'post',
        'previousPost',
        'nextPost',
        'relatedPosts',
         'comments'
    ));
}

public function storeComment(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|string|max:2000',
    ]);

    Comment::create([
        'post_id' => $post->id,
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return back()->with('success','Comment posted successfully.');
}

public function replyComment(Request $request, Comment $comment)
{
    $request->validate([
        'content'=>'required|string|max:2000'
    ]);

    Comment::create([
        'post_id'=>$comment->post_id,
        'user_id'=>auth()->id(),
        'parent_id'=>$comment->id,
        'content'=>$request->content
    ]);

    return back()->with('success','Reply added.');
}


}