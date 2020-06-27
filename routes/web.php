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
});

Route::get('users/table',  'UserController@dataTable')->name('users.table'); 
Route::get('books/table',  'BookController@dataTable')->name('books.table'); 


// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });