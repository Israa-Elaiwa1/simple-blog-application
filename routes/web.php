<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });    
    //Admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
        Route::get('posts/create', [PostController::class, 'create'])->name('create');
    });
    // Dashboard
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    // Single post
    Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');
    // Profile routes 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Comments routes
    Route::post('posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::prefix('posts')->group(function() {   
            Route::delete('/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
            Route::patch('/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

            //generate all CRUD routes        
            Route::resource('/', PostController::class)
            ->parameters(['' => 'id'])
            ->names([
                'index' => 'posts.index',
                'store' => 'posts.store',
                'edit' => 'posts.edit',
                'update' => 'posts.update',
                'destroy' => 'posts.destroy',
            ]);
        });
    });
});

require __DIR__.'/auth.php';
