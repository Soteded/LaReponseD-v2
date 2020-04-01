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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth','role:Admin');

Route::get('/profile/create', 'ProfileController@create');

Route::get('/quiz', 'QuizController@index')->name('quiz');

Route::get('/user/invalidUsername/{id}', 'UserController@invalidUsername')->name('invalidUsername');
Route::get('/user/edit/{id}', 'UserController@edit')->name('editUser');

Route::get('/user/role/{id}', 'RoleController@viewRole')->name('editRole')->middleware('auth','role:Admin');
Route::get('/user/role/{id}/{roleId}', 'RoleController@updateRole')->name('updateRole')->middleware('auth','role:Admin');

Route::resource('profile', 'ProfileController');
Route::resource('quiz', 'QuizController');
Route::resource('user', 'UserController');
Route::resource('question', 'QuestionController');
Route::resource('choix', 'ChoixController');
Route::resource('category', 'CategoryController');
Route::resource('userNote', 'UserNoteQuizController');



Route::group(['middleware' => ['auth']], function () { 
    Route::get('/quiz/create', 'QuizController@create')->name('createQuiz');
    Route::get('/quiz/createQuestion', 'QuestionController@create')->name('createQuestion');
    Route::get('/quiz/show/{id}', 'QuizController@show')->name('show');
    Route::post('/quiz/results', 'QuizController@verify')->name('verify');
    Route::get('/quiz/edit/{id}', 'QuizController@edit')->name('edit');
});


Route::get('image-upload', 'ImageUploadController@imageUpload')->name('image.upload');
Route::post('image-upload', 'ImageUploadController@imageUploadPost')->name('image.upload.post');