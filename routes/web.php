<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sample', ['title' => 'Index']);
});

Route::get('/dummy_auth', function () {
    if (auth()->check()) {
        auth()->logout();
    } else {
        auth()->loginUsingId(1);
    }

    return redirect('/');
})->name('dummy_auth');

$sampleRoutes = collect([
    'about' => ['about', 'About'],
    'news.index' => ['news', 'News'],
    'users.index' => ['users', 'Users'],
    'articles.index' => ['articles', 'Articles'],
    'quotes.index' => ['quotes', 'Quotes'],
    'quotes.create' => ['quotes/create', 'Create quote'],
    'login' => ['login', 'Login'],
    'register' => ['register', 'Register'],
    'logout' => ['logout', 'Logout'],
]);

$sampleRoutes->each(function ($values, $routeName) {
    [$uri, $title] = $values;

    Route::get($uri, function () use ($title) {
        return view('sample', compact('title'));
    })->name($routeName);
});
