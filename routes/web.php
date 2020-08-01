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
    Route::resource('music',        'MusicController',['as' => 'admin']);
    Route::resource('movies',               'MoviesController',['as' => 'admin']);
    Route::resource('photographs',          'PhotographyController',['as' => 'admin']);
    Route::resource('multimedias',          'MultimediaController',['as' => 'admin']);
    Route::resource('languages',            'LenguageController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('periodicals',          'PeriodicityController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('literatures',          'GenerateBookController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('adequacies',           'AdequacyController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('musicals',             'GenerateMusicController', ['except' => 'show', 'as' => 'admin']);     
    Route::resource('formats',              'GenerateFormatController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('references',           'GenerateReferenceController', ['except' => 'show', 'as' => 'admin']); 
    Route::resource('cinematographics',     'GenerateFilmController', ['except' => 'show', 'as' => 'admin']);  
    Route::resource('courses',              'CourseController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('subjects',             'GenerateSubjectsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('letters',              'GenerateLetterController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('fastprocess',          'FastPartnerProcessController',['as' => 'admin']);
    Route::resource('loanmanual',           'LoanManualController',['as' => 'admin']);
    Route::resource('genericcopies',           'GenericCopiesController',['as' => 'admin']);
    // Route::post('users/photos',             'UserController@photo')->name('admin.posts.photo');

    Route::post('fastprocess/grabar',       'FastPartnerProcessController@grabar')->name('fastprocess.grabar');
    Route::get('fastprocess/vista_devo_reno/{id}/{bandera}',  'FastPartnerProcessController@vista_devo_reno')->name('fastprocess.vista_devo_reno');
    Route::get('fastprocess/edit2/{id}',       'FastPartnerProcessController@edit2')->name('fastprocess.edit2');

    Route::get('loanmanual/prestar/{id}',       'LoanManualController@prestar')->name('loanmanual.prestar');

    Route::get('genericcopies/copies/{id}',         'GenericCopiesController@copies')->name('genericcopies.copies');

    Route::get('/newcopies/{id}',         'GenericCopiesController@newcopies')->name('genericcopies.newcopies');

});

Route::get('users/table',               'UserController@dataTable')->name('users.table'); 
Route::get('books/table',               'BookController@dataTable')->name('books.table');
Route::get('languages/table',           'LenguageController@dataTable')->name('languages.table'); 
Route::get('periodicals/table',         'PeriodicityController@dataTable')->name('periodicals.table'); 
Route::get('literatures/table',         'GenerateBookController@dataTable')->name('literatures.table');
Route::get('adequacies/table',          'AdequacyController@dataTable')->name('adequacies.table'); 
Route::get('musicals/table',            'GenerateMusicController@dataTable')->name('musicals.table'); 
Route::get('formats/table',             'GenerateFormatController@dataTable')->name('formats.table'); 
Route::get('references/table',          'GenerateReferenceController@dataTable')->name('references.table'); 
Route::get('cinematographics/table',    'GenerateFilmController@dataTable')->name('cinematographics.table');
Route::get('courses/table',             'CourseController@dataTable')->name('courses.table'); 
Route::get('subjects/table',            'GenerateSubjectsController@dataTable')->name('subjects.table'); 
Route::get('letters/table',             'GenerateLetterController@dataTable')->name('letters.table'); 
Route::get('movies/table',              'MoviesController@dataTable')->name('movies.table');
Route::get('music/table',               'MusicController@dataTable')->name('music.table');
Route::get('photographs/table',         'PhotographyController@dataTable')->name('photographs.table');
Route::get('multimedias/table',         'MultimediaController@dataTable')->name('multimedias.table');
Route::get('fastprocess/table',         'FastPartnerProcessController@dataTable')->name('fastprocess.table');
Route::get('fastprocess/table2',        'FastPartnerProcessController@dataTable2')->name('fastprocess.table2');
Route::get('fastprocess/index2',        'FastPartnerProcessController@index2')->name('fastprocess.index2');
Route::get('loanmanual/table',          'LoanManualController@dataTable')->name('loanmanual.table');

Route::get('genericcopies/table/{id}',         'GenericCopiesController@dataTable')->name('genericcopies.table');




// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });