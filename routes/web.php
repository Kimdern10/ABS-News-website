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
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\NewsletterController;
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

         Route::get('/users', [AdminController::class, 'userList'])->name('user.list');
    Route::patch('user/{user}/ban', [AdminController::class, 'ban'])->name('user.ban');
    Route::patch('user/{user}/unban', [AdminController::class, 'unban'])->name('user.unban');

    Route::get('/users/trashed', [AdminController::class, 'trashedUsers'])->name('users.trashed');


    Route::delete('/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::patch('/users/{id}/restore', [AdminController::class, 'restoreUser'])->name('user.restore');
    Route::delete('/users/{id}/force-delete', [AdminController::class, 'forceDeleteUser'])->name('user.forceDelete');


Route::get('/admin/seo-settings', [SeoController::class, 'edit'])->name('admin.seo.edit');
Route::post('/admin/seo-settings', [SeoController::class, 'update'])->name('admin.seo.update');

  Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/admin/subscribers', [AdminController::class, 'subscribers'])->name('admin.subscribers');
    Route::delete('/admin/comments/{id}', [AdminController::class, 'destroy'])->name('admin.comments.delete');
    Route::delete('/admin/subscribers/{id}', [AdminController::class, 'destroys'])
    ->name('admin.subscribers.delete');

     Route::get('/admin/news-headlines', [PostController::class, 'headlines'])
        ->name('admin.news.headlines');
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

});