<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
 public function boot(): void
{
    // Use Bootstrap pagination
    Paginator::useBootstrapFive();

    View::composer('*', function ($view) {

        // Categories
        $categories = Category::orderBy('name')->get();

        // Popular News
        $popularPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('popular', 1)
            ->latest()
            ->take(5)
            ->get();

        // Latest News
        $latestNews = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->take(10)
            ->get();

        // Breaking News
        $breakingNews = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('breaking_news', 1)
            ->latest()
            ->take(10)
            ->get();

        // Trending News
        $trendingNews = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('trending', 1)
            ->latest()
            ->take(6)
            ->get();


            $viewMoreNews = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->take(8)
            ->get();

            // Slider News
$sliderNews = Post::with(['category','user'])
    ->where('status','published')
    ->where('slider',1)
    ->where('featured', 1)
    ->latest('published_at')
    ->take(6)
    ->get();


// Hot News (right side)
$hotNews = Post::with(['category','user'])
    ->where('status','published')
    ->where('slider',1)
    ->latest('published_at')
    ->skip(3)
    ->take(3)
    ->get();


        // Home Categories (First 4 categories with published posts)
        $homeCategories = Category::with([
            'posts' => function ($query) {
                $query->with('user')
                    ->where('status', 'published')
                    ->latest('published_at');
            }
        ])
        ->whereHas('posts', function ($query) {
            $query->where('status', 'published');
        })
        ->take(6)
        ->get();

        $firstCategory  = $homeCategories->get(0);
        $secondCategory = $homeCategories->get(1);
        $thirdCategory  = $homeCategories->get(2);
        $fourthCategory = $homeCategories->get(3);
        $fifthCategory = $homeCategories->get(4);
        $sixthCategory = $homeCategories->get(5);

        $view->with([
            'categories'       => $categories,
            'navbarCategories' => $categories->take(3),
            'pageCategories'   => $categories->skip(3),
            'popularPosts'     => $popularPosts,
            'latestNews'       => $latestNews,
            'breakingNews'     => $breakingNews,
            'trendingNews'     => $trendingNews,
            'viewMoreNews'     => $viewMoreNews,
            'sliderNews'       => $sliderNews,
            'hotNews'          => $hotNews,

            // Homepage Categories
            'firstCategory'    => $firstCategory,
            'secondCategory'   => $secondCategory,
            'thirdCategory'    => $thirdCategory,
            'fourthCategory'   => $fourthCategory,
            'fifthCategory'    => $fifthCategory,
            'sixthCategory'    => $sixthCategory,
        ]);
    });
}
    
}