<?php

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

Route::get('/', function () {
    return to_route('visitor.article.index');
});

Route::prefix('visitor')->as('visitor.')->group(function () {
    Route::resource('article', ArticleController::class);
});
