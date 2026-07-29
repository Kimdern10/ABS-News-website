<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Subscriber;
use App\Models\Comment;
use App\Models\Category;
use App\Models\LiveNews;
use App\Models\YoutubeLive;
use App\Models\Eyewitness;
use App\Models\RadioStream;
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
        Paginator::useBootstrapFive();

        /*
        |--------------------------------------------------------------------------
        | Frontend Global Data
        |--------------------------------------------------------------------------
        */
        View::composer('*', function ($view) {

            $categories = Category::orderBy('name')->get();

            $popularPosts = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->where('popular', 1)
                ->latest()
                ->take(5)
                ->get();

            $latestNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->latest('published_at')
                ->take(10)
                ->get();

            $breakingNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->where('breaking_news', 1)
                ->latest()
                ->take(6)
                ->get();

            $trendingNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->where('trending', 1)
                ->latest()
                ->take(6)
                ->get();

            $viewMoreNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();

            $sliderNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->where('slider', 1)
                ->where('featured', 1)
                ->latest('published_at')
                ->take(6)
                ->get();

            $liveNews = LiveNews::where('status', 1)
                ->where('is_live', 1)
                ->latest()
                ->first();

            $youtubeLive = YoutubeLive::where('status', 1)
                ->where('is_live', 1)
                ->latest()
                ->first();

            $radioStream = RadioStream::where('status', 1)
                ->where('is_live', 1)
                ->latest()
                ->first();

            $latestEyewitnessHeader = Eyewitness::with('user')
                ->where('status', 'approved')
                ->latest()
                ->first();

            $hotNews = Post::with(['category', 'user'])
                ->where('status', 'published')
                ->where('slider', 1)
                ->latest('published_at')
                ->skip(3)
                ->take(3)
                ->get();

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
            $fifthCategory  = $homeCategories->get(4);
            $sixthCategory  = $homeCategories->get(5);

            $view->with([
                'categories' => $categories,
                'navbarCategories' => $categories->take(3),
                'pageCategories' => $categories->skip(3),

                'popularPosts' => $popularPosts,
                'latestNews' => $latestNews,
                'breakingNews' => $breakingNews,
                'trendingNews' => $trendingNews,
                'viewMoreNews' => $viewMoreNews,

                'sliderNews' => $sliderNews,
                'hotNews' => $hotNews,

                'liveNews' => $liveNews,
                'youtubeLive' => $youtubeLive,
                'radioStream' => $radioStream,

                'latestEyewitnessHeader' => $latestEyewitnessHeader,

                'firstCategory' => $firstCategory,
                'secondCategory' => $secondCategory,
                'thirdCategory' => $thirdCategory,
                'fourthCategory' => $fourthCategory,
                'fifthCategory' => $fifthCategory,
                'sixthCategory' => $sixthCategory,
            ]);
        });

       /*
|--------------------------------------------------------------------------
| Admin Dashboard Analytics
|--------------------------------------------------------------------------
*/
View::composer('admin.index', function ($view) {

    $totalPosts = Post::count();

    $publishedPosts = Post::where('status', 'published')->count();

    $draftPosts = Post::where('status', 'draft')->count();

    $totalCategories = Category::count();

    $subscribers = Subscriber::count();

    $totalComments = Comment::count();

    $views = Post::sum('views');

    $todayViews = Post::whereDate(
        'created_at',
        now()->toDateString()
    )->sum('views');

    $liveNewsCount = LiveNews::count();

    $youtubeStreams = YoutubeLive::count();

    $eyewitnessReports = Eyewitness::count();

    $latestPosts = Post::with('category')
        ->latest()
        ->take(10)
        ->get();

    $mostViewedPosts = Post::orderByDesc('views')
        ->take(10)
        ->get();

    $topCategories = Category::withCount('posts')
        ->orderByDesc('posts_count')
        ->take(10)
        ->get();

    $postsPerMonth = Post::selectRaw(
        'MONTH(created_at) as month, COUNT(*) as total'
    )
    ->groupBy('month')
    ->pluck('total', 'month');

    $viewsPerDay = Post::selectRaw(
        'DATE(created_at) as date, SUM(views) as total'
    )
    ->whereDate(
        'created_at',
        '>=',
        now()->subDays(30)
    )
    ->groupBy('date')
    ->orderBy('date')
    ->get();

    $subscriberGrowth = Subscriber::selectRaw(
        'DATE(created_at) as date, COUNT(*) as total'
    )
    ->groupBy('date')
    ->orderBy('date')
    ->get();

    $view->with([
        'totalPosts' => $totalPosts,
        'publishedPosts' => $publishedPosts,
        'draftPosts' => $draftPosts,
        'totalCategories' => $totalCategories,

        'subscribers' => $subscribers,
        'totalComments' => $totalComments,

        'views' => $views,
        'todayViews' => $todayViews,

        'liveNewsCount' => $liveNewsCount,
        'youtubeStreams' => $youtubeStreams,
        'eyewitnessReports' => $eyewitnessReports,

        'latestPosts' => $latestPosts,
        'mostViewedPosts' => $mostViewedPosts,
        'topCategories' => $topCategories,

        'postsPerMonth' => $postsPerMonth,
        'viewsPerDay' => $viewsPerDay,
        'subscriberGrowth' => $subscriberGrowth,
    ]);
});
    }
}