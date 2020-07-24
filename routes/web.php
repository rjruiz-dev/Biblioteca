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
    Route::get('/',             'AdminController@index')->name('dashboard');         
    Route::resource('users',    'UserController',['as' => 'admin']); 
    Route::resource('books',    'BookController',['as' => 'admin']);
    Route::resource('music',    'MusicController',['as' => 'admin']);
    Route::resource('multimedias',    'MultimediaController',['as' => 'admin']);
    Route::resource('movies',    'MoviesController',['as' => 'admin']);
    Route::resource('photographs',    'PhotographyController',['as' => 'admin']);

    Route::resource('FPSocios',    'FPSociosController',['as' => 'admin']);

    Route::post('FPSocios/grabar',  'FPSociosController@grabar')->name('FPSocios.grabar');
    Route::get('FPSocios/vista_devo_reno/{id}/{bandera}',  'FPSociosController@vista_devo_reno')->name('FPSocios.vista_devo_reno');
    
    Route::get('FPSocios/edit2/{id}',  'FPSociosController@edit2')->name('FPSocios.edit2');
    
    
    
    
});

Route::get('users/table',  'UserController@dataTable')->name('users.table'); 
Route::get('books/table',  'BookController@dataTable')->name('books.table'); 
Route::get('music/table',  'MusicController@dataTable')->name('music.table');
Route::get('multimedias/table',  'MultimediaController@dataTable')->name('multimedias.table');
Route::get('movies/table',  'MoviesController@dataTable')->name('movies.table');
Route::get('photographs/table',  'PhotographyController@dataTable')->name('photographs.table'); 

Route::get('FPSocios/table',  'FPSociosController@dataTable')->name('FPSocios.table');
Route::get('FPSocios/table2',  'FPSociosController@dataTable2')->name('FPSocios.table2');

Route::get('FPSocios/index2',  'FPSociosController@index2')->name('FPSocios.index2');


 

// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });