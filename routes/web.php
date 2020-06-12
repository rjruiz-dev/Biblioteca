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

// Route::get('home', function () {
//     return view('admin.dashboard');
// });

Auth::routes(['register' => false]);

Route::group([
    'prefix'     => 'admin',
    // 'namespace'  => 'Admin',
    'middleware' => 'auth'],   
function(){    
    Route::get('/',             'AdminController@index')->name('dashboard');         
    Route::resource('users',    'UserController',['as' => 'admin']); 
});

Route::get('users/table',   'UserController@dataTable')->name('users.table'); 