<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authors', 'AuthorController@authors')->name('authors');
Route::post('/authors', 'AuthorController@addAuthor');

// Should be a post, not a get. Get requests shouldn't alter server data
Route::post('/authors/delete', 'AuthorController@deleteAuthor');

Route::get('/books', 'BookController@books')->name('books');
Route::post('/books', 'BookController@addBook');

// Should be a post, not a get. Get requests shouldn't alter server data
Route::post('/books/delete', 'BookController@deleteBook');
