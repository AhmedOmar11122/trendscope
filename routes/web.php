<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;

Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('articles.admin');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // معلومات الدخول الثابتة:
    if ($username === 'admin' && $password === '123456') {
        session(['is_admin' => true]);
        return redirect()->route('articles.admin');
    }

    return redirect()->route('login')->with('error', 'Invalid credentials');
})->name('login.submit');

Route::get('/logout', function () {
    session()->forget('is_admin');
    return redirect()->route('login');
})->name('logout');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/category/{slug}', [ArticleController::class, 'category'])->name('category.show');
