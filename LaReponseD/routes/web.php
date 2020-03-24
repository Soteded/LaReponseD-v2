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

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth','role:Admin');

Route::resource('profile', 'ProfileController');
Route::get('/profile/create', 'ProfileController@create');

Route::get('/quiz/createQuiz', 'QuizController@create')->name('createQuiz');
Route::get('/quiz/createQuestion', 'QuestionController@create')->name('createQuestion');
Route::get('/quiz/show', 'QuizController@show')->name('show');
Route::get('/test', function (){
    return view('test');
});

Route::get('/user/invalidUsername/{id}', 'UserController@invalidUsername')->name('invalidUsername');
Route::get('/user/edit/{id}', 'UserController@edit')->name('editUser');

Route::resource('quiz', 'QuizController');
Route::resource('user', 'UserController');
Route::resource('question', 'QuestionController');
Route::resource('choix', 'ChoixController');
