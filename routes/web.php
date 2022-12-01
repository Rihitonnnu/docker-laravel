<?php

use App\Http\Controllers\TagsSearchController;
use App\Http\Controllers\Visitor\ArticleController;
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

Route::get('/', [ArticleController::class, 'index'])->name('visitor.article.index');

Route::get('/show/{article}', [ArticleController::class, 'show'])->name('visitor.article.show');

Route::post('/tags/search', [TagsSearchController::class, 'search'])->name('visitor.tag.search');

Route::get('/articles/search', [ArticleController::class, 'searchArticle'])->name('visitor.article.search');
