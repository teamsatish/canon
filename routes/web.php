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
    return view('welcome');
});

Route::get('/solution-query', function () {
    return view('pages.solution-query');
});

Route::post('/solution-query', 'SolutionQueryController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->get('/show-solution-queries', 'SolutionQueryController@index')->name('showSolutionQueries');
