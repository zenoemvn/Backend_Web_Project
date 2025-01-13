<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TrackEventController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/edit-users', [AdminController::class, 'editUsers'])
    ->middleware('auth') // or 'admin' middleware if you have one
    ->name('admin.editusers');

Route::post('/admin/edit-users/{user}', [AdminController::class, 'updateUser'])
    ->middleware('auth') // or 'admin'
    ->name('admin.updateUser');

Route::post('/admin/create-user', [AdminController::class, 'storeUser'])
    ->middleware('auth')
    ->name('admin.storeUser');    


    Route::middleware(['auth'])->group(function () {
        Route::post('/track-events/update', [TrackEventController::class, 'update'])->name('track_events.update');
    });

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    
   

    // Admin Routes for News Management
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');
        Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
        Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
        Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    });
    
    Route::get('/news', [NewsController::class, 'publicIndex'])->name('news.public');


// Public route for viewing news

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news');
    });
    
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
  
// View Profile Route
Route::get('/users/{id}/profile', [UserController::class, 'show'])->name('profile.show');

Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    


use App\Http\Controllers\FAQController;

Route::get('/faq', [FAQController::class, 'index'])->name('faq.index'); // Public FAQ page

// Admin routes for managing FAQs (protected with admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/faq', [FAQController::class, 'manage'])->name('faq.manage');
    Route::post('/admin/faq/store', [FAQController::class, 'store'])->name('faq.store');
    Route::get('/admin/faq/edit/{id}', [FAQController::class, 'edit'])->name('faq.edit');
    Route::patch('/admin/faq/update/{id}', [FAQController::class, 'update'])->name('faq.update');
    Route::delete('/admin/faq/delete/{id}', [FAQController::class, 'destroy'])->name('faq.delete');
    Route::post('/admin/faq/category/store', [FAQController::class, 'storeCategory'])->name('faq.category.store');

});

// Admin routes for managing FAQs (requires admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/faq/manage', [FAQController::class, 'manage'])->name('faq.manage');
    Route::post('/faq/store', [FAQController::class, 'store'])->name('faq.store');
    Route::get('/faq/edit/{id}', [FAQController::class, 'edit'])->name('faq.edit');
    Route::patch('/faq/update/{id}', [FAQController::class, 'update'])->name('faq.update');
    Route::delete('/faq/delete/{id}', [FAQController::class, 'destroy'])->name('faq.delete');
});
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
















require __DIR__.'/auth.php';

//route for the admin dashboard
route::get('admin/dashboard',[HomeController::class,'index'])-> middleware((['auth','admin']));


