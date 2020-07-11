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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group([
    'prefix'     => 'admin',   
    'middleware' => 'auth'],   
function(){    
    Route::get('/',                 'AdminController@index')->name('dashboard');         
    Route::resource('users',        'UserController',['as' => 'admin']); 
    Route::resource('books',        'BookController',['as' => 'admin']); 
    Route::resource('movies',       'MoviesController',['as' => 'admin']);
    Route::resource('languages',    'LenguageController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('periodicals',  'PeriodicityController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('literatures',  'GenerateBookController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('adequacies',   'AdequacyController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('musicals',     'GenerateMusicController', ['except' => 'show', 'as' => 'admin']);     
    Route::resource('formats',          'GenerateFormatController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('references',       'GenerateReferenceController', ['except' => 'show', 'as' => 'admin']); 
    Route::resource('cinematographics', 'GenerateFilmController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('courses',          'CourseController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('subjects',         'GenerateSubjectsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('letters',          'GenerateLetterController', ['except' => 'show', 'as' => 'admin']);
});

Route::get('users/table',       'UserController@dataTable')->name('users.table'); 
Route::get('books/table',       'BookController@dataTable')->name('books.table');
Route::get('languages/table',   'LenguageController@dataTable')->name('languages.table'); 
Route::get('periodicals/table', 'PeriodicityController@dataTable')->name('periodicals.table'); 
Route::get('literatures/table', 'GenerateBookController@dataTable')->name('literatures.table');
Route::get('adequacies/table',  'AdequacyController@dataTable')->name('adequacies.table'); 
Route::get('musicals/table',    'GenerateMusicController@dataTable')->name('musicals.table'); 
Route::get('formats/table',         'GenerateFormatController@dataTable')->name('formats.table'); 
Route::get('references/table',      'GenerateReferenceController@dataTable')->name('references.table'); 
Route::get('cinematographics/table','GenerateFilmController@dataTable')->name('cinematographics.table');
Route::get('courses/table',         'CourseController@dataTable')->name('courses.table'); 
Route::get('subjects/table',        'GenerateSubjectsController@dataTable')->name('subjects.table'); 
Route::get('letters/table',         'GenerateLetterController@dataTable')->name('letters.table'); 


// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });