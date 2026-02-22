<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('tutorial/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategoryPost']);
Route::get('tutorial/{category_slug}/{post_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewPost']);
Route::get('/posts', [App\Http\Controllers\Frontend\FrontendController::class, 'allPosts']);
Route::get('/categories', [App\Http\Controllers\Frontend\FrontendController::class, 'allCategories']);
Route::get('/search', [App\Http\Controllers\Frontend\FrontendController::class, 'globalSearch']);
Auth::routes();
Route::get('/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)
        ->where('status', 1)
        ->firstOrFail();

    return view('frontend.page', compact('page'));
});
// ADMIN ROUTES 
Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
    Route::get('category/trash', [App\Http\Controllers\Admin\CategoryController::class, 'trash']);
    Route::put('category/restore/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'restore']);
    Route::delete('category/force-delete/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'forceDelete']);

    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('posts/create', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('posts', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::delete('posts/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'destroy']);
    Route::get('posts/trash', [App\Http\Controllers\Admin\PostController::class, 'trash']);
    Route::put('posts/{post_id}/restore', [App\Http\Controllers\Admin\PostController::class, 'restore']);
    Route::delete('posts/{post_id}/force-delete', [App\Http\Controllers\Admin\PostController::class, 'forceDelete']);

    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->names('admin.pages');
    Route::resource('home-banner', App\Http\Controllers\Admin\HomeBannerController::class)->names('admin.home-banner');
});

// BLOGGER ROUTES 
Route::prefix('blogger')->middleware('auth','isAdmin')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index']);    
    Route::get('add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Admin\PostController::class, 'store']); 
    Route::get('post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'destroy']);

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
