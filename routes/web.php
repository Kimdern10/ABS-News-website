<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\EyewitnessController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\NewsletterController;
// use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BackupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Registration
|--------------------------------------------------------------------------
*/
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');

Route::get('/contact-us', [UserController::class, 'contact'])->name('contactus');
Route::get('/about-us', [UserController::class, 'about'])->name('aboutus');

Route::get('/sign-up', [UserController::class, 'signUp'])->name('sign-up');
Route::post('/create-user', [UserController::class, 'createUser'])->name('create-user');


Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/search', [UserController::class, 'search'])->name('search');

      Route::get('/eyewitness-news', [UserController::class, 'eyewitnessNews'])
    ->name('eyewitness.news');

      Route::get('/eyewitness-news/{id}', [UserController::class, 'eyewitnessShow'])
    ->name('eyewitness.show');
/*
|--------------------------------------------------------------------------
| Email Verification OTP
|--------------------------------------------------------------------------
*/

Route::get('/verify.otp/{email}', [UserController::class, 'showOtpForm'])->name('verify.otp');

Route::post('/verify.otp/{email}/submit', [UserController::class, 'submitOtp'])
    ->name('verify.otp.submit');

Route::get('/resend.otp/{email}/resend', [UserController::class, 'resendOtp'])
    ->name('resend.otp');

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/

Route::get('forget-password', [ForgotPasswordController::class, 'forgetPassword'])
    ->name('forgetPassword');

Route::post('forgotpassword', [ForgotPasswordController::class, 'forgotPassword'])
    ->name('forgotPassword.email');

Route::get('confirm-code', [ForgotPasswordController::class, 'confirmCode'])
    ->name('confirmCode.email');

Route::post('submit-password-reset-code', [ForgotPasswordController::class, 'submitPasswordResetCode'])
    ->name('submitPasswordResetCode');

Route::get('/password-reset', [ForgotPasswordController::class, 'passwordReset'])
    ->name('password-reset');

Route::post('/create-new-password', [ForgotPasswordController::class, 'createNewPassword'])
    ->name('create.new-password');

Route::get('/resend.code/{email}/resend', [ForgotPasswordController::class, 'resendCode'])
    ->name('resend.code');



Route::get('/category/{category:slug}', [UserPostController::class, 'category'])
    ->name('category.page');

Route::get('/categories', [UserPostController::class, 'categories'])
    ->name('categories.index');

Route::get('/posts/{slug}', [UserPostController::class, 'show'])
    ->name('posts.show');

Route::get('/live-news', [UserController::class, 'index'])
    ->name('live-news.index');

Route::get('/live-news/{slug}', [UserController::class, 'liveNewsShow'])
    ->name('live-news.show');

Route::get(
    '/youtube-live/{id}',
    [UserController::class, 'youtubeLiveShow']
)
    ->name('youtube-live.show');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
| Super Admin, Admin and Editor all use the same dashboard.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super-admin|admin|editor'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');


    // Posts List
    Route::get('/admin/posts', [PostController::class, 'index'])
        ->name('posts.index');

    // Trashed Posts
    Route::get('/admin/posts/trash', [PostController::class, 'trash'])
        ->name('posts.trash');

    // Create Post
    Route::get('/admin/posts/create', [PostController::class, 'create'])
        ->name('posts.create');

    // Store Post
    Route::post('/admin/posts/store', [PostController::class, 'store'])
        ->name('posts.store');

    // Restore Post
    Route::post('/admin/posts/{id}/restore', [PostController::class, 'restore'])
        ->name('posts.restore');

    // Permanently Delete Post
    Route::delete('/admin/posts/{id}/force-delete', [PostController::class, 'forceDelete'])
        ->name('posts.forceDelete');

    // Edit Post
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    // Update Post
    Route::put('/admin/posts/{post}/update', [PostController::class, 'update'])
        ->name('posts.update');

    // Toggle Status
    Route::patch('/admin/posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])
        ->name('posts.toggle-status');

    // Soft Delete
    Route::delete('/admin/posts/{post}/delete', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    // View Single Post


});

/*
|--------------------------------------------------------------------------
| Super Admin Only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super-admin'])->group(function () {

    Route::get('/admin/users/create', [AdminController::class, 'createUser'])
        ->name('admin.users.create');

    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])
        ->name('admin.users.store');

    // ================= Activity Logs =================
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])
        ->name('admin.activity-logs');

    // ================= Database Backup =================
    Route::get('/admin/database-backup', [BackupController::class, 'index'])
        ->name('admin.database-backup');

    Route::post('/admin/database-backup/run', [BackupController::class, 'runBackup'])
        ->name('admin.backup.run');

    Route::get('/admin/system/backup/download/{file}', [BackupController::class, 'downloadBackup'])
        ->name('admin.backup.download');

    Route::delete('/admin/system/backup/delete/{file}', [BackupController::class, 'deleteBackup'])
        ->name('admin.backup.delete');

    Route::post('/admin/{user}/role', [AdminController::class, 'updateRole'])
        ->name('users.update.role')
        ->middleware(['auth', 'role:super-admin']);
});

/*
|--------------------------------------------------------------------------
| Categories (Super Admin & Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super-admin|admin'])->group(function () {

    Route::get('/admin/categories/trash', [CategoryController::class, 'trash'])
        ->name('admin.categories.trash');

    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('admin.categories.edit');

    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');

    Route::post('/admin/categories/{id}/restore', [CategoryController::class, 'restore'])
        ->name('admin.categories.restore');

    Route::delete('/admin/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
        ->name('admin.categories.forceDelete');

    Route::get('/admin/users', [AdminController::class, 'userList'])->name('user.list');
    Route::patch('/admin/user/{user}/ban', [AdminController::class, 'ban'])->name('user.ban');
    Route::patch('/admin/user/{user}/unban', [AdminController::class, 'unban'])->name('user.unban');

    Route::get('/admin/users/trashed', [AdminController::class, 'trashedUsers'])->name('users.trashed');


    Route::delete('/admin/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::patch('/admin/users/{id}/restore', [AdminController::class, 'restoreUser'])->name('user.restore');
    Route::delete('/admin/users/{id}/force-delete', [AdminController::class, 'forceDeleteUser'])->name('user.forceDelete');


    Route::get('/admin/seo-settings', [SeoController::class, 'edit'])->name('admin.seo.edit');
    Route::post('/admin/seo-settings', [SeoController::class, 'update'])->name('admin.seo.update');

    Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/admin/subscribers', [AdminController::class, 'subscribers'])->name('admin.subscribers');
    Route::delete('/admin/comments/{id}', [AdminController::class, 'destroy'])->name('admin.comments.delete');
    Route::delete('/admin/subscribers/{id}', [AdminController::class, 'destroys'])
        ->name('admin.subscribers.delete');

    Route::get('/admin/news-headlines', [PostController::class, 'headlines'])
        ->name('admin.news.headlines');

    Route::get('/admin/live-news', [AdminController::class, 'liveNewsIndex'])
        ->name('admin.live-news.index');

    Route::get('/admin/live-news/create', [AdminController::class, 'liveNewsCreate'])
        ->name('live-news.create');

    Route::post('/admin/live-news/store', [AdminController::class, 'liveNewsStore'])
        ->name('live-news.store');

    Route::get('/admin/live-news/edit/{id}', [AdminController::class, 'liveNewsEdit'])
        ->name('live-news.edit');

    Route::put('/admin/live-news/update/{id}', [AdminController::class, 'liveNewsUpdate'])
        ->name('admin.live-news.update');

    Route::delete('/admin/live-news/destroy/{id}', [AdminController::class, 'liveNewsDestroy'])
        ->name('live-news.destroy');

    Route::delete('/admin/live-news/delete/{id}', [AdminController::class, 'liveNewsDelete'])
        ->name('admin.live-news.delete');


    Route::get('/admin/youtube-live', [AdminController::class, 'youtubeLiveIndex'])
        ->name('admin.youtube-live.index');

    Route::get('/admin/youtube-live/create', [AdminController::class, 'youtubeLiveCreate'])
        ->name('admin.youtube-live.create');

    Route::post('/admin/youtube-live/store', [AdminController::class, 'youtubeLiveStore'])
        ->name('admin.youtube-live.store');

    Route::get('/admin/youtube-live/edit/{id}', [AdminController::class, 'youtubeLiveEdit'])
        ->name('admin.youtube-live.edit');

    Route::put('/admin/youtube-live/update/{id}', [AdminController::class, 'youtubeLiveUpdate'])
        ->name('admin.youtube-live.update');

    Route::delete('/admin/youtube-live/delete/{id}', [AdminController::class, 'youtubeLiveDelete'])
        ->name('admin.youtube-live.delete');

    Route::get('/admin/radio', [AdminController::class, 'radioIndex'])
        ->name('admin.radio.index');

    Route::get('/admin/radio/create', [AdminController::class, 'radioCreate'])
        ->name('admin.radio.create');

    Route::post('/admin/radio/store', [AdminController::class, 'radioStore'])
        ->name('admin.radio.store');

    Route::get(
        '/admin/radio-streams/edit/{id}',
        [AdminController::class, 'radioEdit']
    )
        ->name('admin.radio.edit');

    Route::put(
        '/admin/radio-streams/update/{id}',
        [AdminController::class, 'radioUpdate']
    )
        ->name('admin.radio.update');

    Route::delete(
        '/admin/radio-streams/delete/{id}',
        [AdminController::class, 'radioDelete']
    )
        ->name('admin.radio.delete');

    Route::post(
        '/admin/radio/toggle/{id}',
        [AdminController::class, 'radioToggle']
    )
        ->name('admin.radio.toggle');

            Route::get('/eyewitness',
    [EyewitnessController::class,'index'])
    ->name('admin.eyewitness.index');


    Route::get('/eyewitness/edit/{id}',
    [EyewitnessController::class,'edit'])
    ->name('admin.eyewitness.edit');


    Route::put('/eyewitness/update/{id}',
    [EyewitnessController::class,'update'])
    ->name('admin.eyewitness.update');


    Route::post('/eyewitness/status/{id}',
    [EyewitnessController::class,'status'])
    ->name('admin.eyewitness.status');

         Route::delete('/eyewitness/delete/{id}',
[EyewitnessController::class,'destroy'])
->name('admin.eyewitness.delete');

Route::get('/eyewitness/restore/{id}',
[EyewitnessController::class,'restore'])
->name('admin.eyewitness.restore');

Route::get('/eyewitness/trash',
[EyewitnessController::class,'trash'])
->name('admin.eyewitness.trash');

    // Route::get('/dashboard', [DashboardController::class, 'index'])
    //         ->name('dashboard');


});

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'user_dashboard'])
        ->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::put('/update', [ProfileController::class, 'update'])->name('update');

    Route::post('/update/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

    Route::post('/update/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo');

    // Comments
    Route::post('/posts/{post}/comments', [UserPostController::class, 'storeComment'])
        ->name('comments.store');

    // Replies
    Route::post('/comments/{comment}/reply', [UserPostController::class, 'replyComment'])
        ->name('comments.reply');

          // Eyewitness create page
    Route::get('/eyewitness/create', 
        [UserController::class, 'createEyewitness'])
        ->name('user.eyewitness.create');


    // Save eyewitness news
    Route::post('/eyewitness/store', 
        [UserController::class, 'storeEyewitness'])
        ->name('user.eyewitness.store');

  

  
   
});
