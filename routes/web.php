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
    
require __DIR__.'/auth.php';

//route for the admin dashboard
route::get('admin/dashboard',[HomeController::class,'index'])-> middleware((['auth','admin']));


