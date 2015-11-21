<?php

use Illuminate\Http\Request;
use App\Contracts\Search;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Homepage
Route::get('/', function() {
	return view('subjects.index');
});

// Ask
Route::get('/ask', 'ArticlesController@ask');

// Subjects Controller
Route::get('/subjects','SubjectsController@index');

Route::post('/subjects/create','SubjectsController@create');

Route::post('/subjects/store','SubjectsController@store');

Route::get('/subjects/{id}/edit','SubjectController@edit');

Route::put('/subjects/{id}', 'SubjectController@update');

Route::get('/subjects/{id}','SubjectsController@show')->where(['id' => '[0-9]+']);

// 4 objects (websites, subjects, books, persons)

Route::post('/subjects/websites', 'SubjectsController@storeWebsite');
Route::post('/subjects/websites/more', 'SubjectsController@moreWebsites');
Route::post('/subjects/websites/like', 'SubjectsController@websiteLike');

Route::post('/subjects/subjects', 'SubjectsController@storeSubject');
Route::post('/subjects/subjects/more', 'SubjectsController@moreSubjects');
Route::post('/subjects/subjects/like', 'SubjectsController@subjectLike');

Route::post('/subjects/books', 'SubjectsController@storeBook');
Route::post('/subjects/books/more', 'SubjectsController@moreBooks');
Route::post('/subjects/books/like', 'SubjectsController@bookLike');

Route::post('/subjects/persons', 'SubjectsController@storePerson');
Route::post('/subjects/persons/more', 'SubjectsController@morePersons');
Route::post('/subjects/persons/like', 'SubjectsController@personLike');

Route::get('/subjects/{id}', 'SubjectsController@show');


//  Users Controller

Route::get('/users/profile', 'UsersController@show');
Route::get('/users/{id}', 'UsersController@view_profile');
Route::post('/users/books', 'UsersController@moreBooks');
Route::post('/users/websites', 'UsersController@moreWebsites');
Route::post('/users/books/remove', 'UsersController@removeBook');
Route::post('/users/websites/remove', 'UsersController@removeWebsite');


// ArticlesController

Route::post('articles/save_comment/{id}','ArticlesController@saveComment');
Route::delete('articles/{id}/delete','ArticlesController@destroy');
Route::resource('articles','ArticlesController');

// Authentication routes...
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
