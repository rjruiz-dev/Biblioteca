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
    Route::get('/',                         'AdminController@index')->name('dashboard');         
    Route::resource('users',                'UserController',['as' => 'admin']); 
    Route::resource('books',                'BookController',['as' => 'admin']); 
    Route::resource('music',                'MusicController',['as' => 'admin']);
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
    Route::resource('genericcopies',        'GenericCopiesController',['as' => 'admin']);
    Route::resource('requests',             'RequestsController',['as' => 'admin']);
    Route::resource('loansbydate',             'LoansbydateController',['as' => 'admin']);
    Route::resource('loansbyclassroom',             'LoansbyclassroomController',['as' => 'admin']);
    Route::resource('infoofdatabase',             'infoofdatabaseController',['as' => 'admin']);
    Route::resource('importfromrebeca',             'ImportfromrebecaController',['as' => 'admin']);
 
    //Print PDF
    Route::get('books/exportpdf/{id}',      'BookController@exportPdf')->name('libro.pdf');
    Route::get('movies/exportpdf/{id}',     'MoviesController@exportPdf')->name('cine.pdf');
    Route::get('music/exportpdf/{id}',      'MusicController@exportPdf')->name('musica.pdf');  
    Route::get('photographs/exportpdf/{id}','PhotographyController@exportPdf')->name('fotografia.pdf');  
    Route::get('multimedias/exportpdf/{id}','MultimediaController@exportPdf')->name('multimedia.pdf');        

    Route::get('loanmanual/showPartner/{id}',                   'LoanManualController@showPartner');
    Route::post('fastprocess/grabar',                           'FastPartnerProcessController@grabar')->name('fastprocess.grabar');
    Route::get('fastprocess/vista_devo_reno/{id}/{bandera}/{fecha}',    'FastPartnerProcessController@vista_devo_reno')->name('fastprocess.vista_devo_reno');
    Route::get('fastprocess/edit2/{id}',                        'FastPartnerProcessController@edit2')->name('fastprocess.edit2');
    Route::get('loanmanual/prestar/{id}',                       'LoanManualController@prestar')->name('loanmanual.prestar');
    Route::get('genericcopies/copies/{id}',                     'GenericCopiesController@copies')->name('genericcopies.copies');
    Route::get('/newcopies/{id}',                               'GenericCopiesController@newcopies')->name('genericcopies.newcopies');
    Route::get('loanmanual/abm_prestamo/{id}/{bandera}/{n_mov}','LoanManualController@abm_prestamo')->name('loanmanual.abm_prestamo');
    
    //cine    
    Route::delete('movies/desidherata/{id}',    'MoviesController@desidherata')->name('movies.desidherata');
    Route::delete('movies/baja/{id}',           'MoviesController@baja')->name('movies.baja');    
    Route::delete('movies/reactivar/{id}',      'MoviesController@reactivar')->name('movies.reactivar'); 
    Route::delete('movies/copy/{id}',           'MoviesController@copy')->name('movies.copy'); 
 
    //musica
    Route::delete('music/desidherata/{id}',     'MusicController@desidherata')->name('music.desidherata');
    Route::delete('music/baja/{id}',            'MusicController@baja')->name('music.baja');    
    Route::delete('music/reactivar/{id}',       'MusicController@reactivar')->name('music.reactivar');
    Route::delete('music/copy/{id}',            'MusicController@copy')->name('music.copy');

    //libros    
    Route::delete('books/desidherata/{id}',     'BookController@desidherata')->name('books.desidherata');
    Route::delete('books/baja/{id}',            'BookController@baja')->name('books.baja');    
    Route::delete('books/reactivar/{id}',       'BookController@reactivar')->name('books.reactivar');    
    Route::delete('books/copy/{id}',            'BookController@copy')->name('books.copy');
 
    //fotografia
    Route::delete('photographs/desidherata/{id}','PhotographyController@desidherata')->name('photographs.desidherata');
    Route::delete('photographs/baja/{id}',       'PhotographyController@baja')->name('photographs.baja');    
    Route::delete('photographs/reactivar/{id}',  'PhotographyController@reactivar')->name('photographs.reactivar');
    Route::delete('photographs/copy/{id}',       'PhotographyController@copy')->name('photographs.copy');

    //multimedias
    Route::delete('multimedias/desidherata/{id}','MultimediaController@desidherata')->name('multimedias.desidherata');
    Route::delete('multimedias/baja/{id}',       'MultimediaController@baja')->name('multimedias.baja');    
    Route::delete('multimedias/reactivar/{id}',  'MultimediaController@reactivar')->name('multimedias.reactivar');    
    Route::delete('multimedias/copy/{id}',       'MultimediaController@copy')->name('multimedias.copy');

    //desestimar en request(solicitudes desde la web)
    Route::delete('requests/desestimar/{id}',  'RequestsController@desestimar')->name('requests.desestimar');
    Route::delete('requests/solicitud/{id}',  'RequestsController@solicitud')->name('requests.solicitud');

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
Route::get('requests/table',          'RequestsController@dataTable')->name('requests.table');

Route::get('genericcopies/table/{id}',  'GenericCopiesController@dataTable')->name('genericcopies.table');

Route::get('loansbydate/table',          'LoansbydateController@dataTable')->name('loansbydate.table');

Route::get('loansbyclassroom/table',          'LoansbyclassroomController@dataTable')->name('loansbyclassroom.table');

Route::get('infoofdatabase/table',          'infoofdatabaseController@dataTable')->name('infoofdatabase.table');


// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });