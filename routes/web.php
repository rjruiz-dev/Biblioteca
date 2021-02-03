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

Route::get('email', function () {
    return new App\Mail\AlertClaim(App\User::first());
});
 
Route::get('/config-cache', function() {$exitCode = Artisan::call('config:cache');      return '<h1>Config Cache</h1>';  });

Route::get('/config-clear', function() {$exitCode2 = Artisan::call('config:clear');      return '<h1>Config Clear</h1>';  });

// Clear application cache:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});

Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'route cache cleared';
});

Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return 'route clear cleared';
});


Route::get('/', 'HomeController@index')->name('index');
Route::delete('cambiar{id}', 'HomeController@cambiar')->name('cambiar');

Route::auth();
// Route::get('/login', function () {
//     return view('auth.login');
// });
// Auth::routes(['register' => false]);


Route::group([
    'prefix'  => 'web'],   
function(){ 
    Route::resource('libros',           'VBooksController', ['except' => 'create','store','edit','update','delete', 'as' => 'web']);
    Route::resource('cine',             'VMoviesController',['except' => 'create','store','edit','update','delete', 'as' => 'web']);
    Route::resource('musica',           'VMusicController',['except' => 'create','store','edit','update','delete', 'as' => 'web']);
    Route::resource('fotografias',      'VPhotographyController',['except' => 'create','store','edit','update','delete', 'as' => 'web']);
    Route::resource('multimedia',       'VMultimediaController',['except' => 'create','store','edit','update','delete', 'as' => 'web']);
 
    Route::get('vusers/create',         'HomeController@create')->name('vusers.create');
    Route::post('vusers/store',         'HomeController@store')->name('vusers.store');

    // Route::get('books/indexsolo/{id}/{tipo}',                         'BookController@indexsolo')->name('books.indexsolo');
     
    Route::get('libros/indexsolo/{id}',     'VBooksController@indexsolo')->name('libros.indexsolo');
    Route::get('cines/indexsolo/{id}',     'VMoviesController@indexsolo')->name('cines.indexsolo');
    Route::get('musicas/indexsolo/{id}',     'VMusicController@indexsolo')->name('musicas.indexsolo');
    Route::get('fotografias/indexsolo/{id}',     'VPhotographyController@indexsolo')->name('fotografias.indexsolo');
    Route::get('multimedias/indexsolo/{id}',     'VMultimediaController@indexsolo')->name('multimedias.indexsolo');
    // Route::get('vusers/edit/{id}',   'HomeController@edit')->name('vusers.edit');
    // Route::post('vusers/update/{id}',   'HomeController@update')->name('vusers.update');
    Route::get('filtrarhome/{cantidad}',             'HomeController@filtrarhome');
    Route::get('filtrarhome_reservados/{cantidad}',             'HomeController@filtrarhome_reservados');
    
});

Route::get('libros/table',      'VBooksController@dataTable')->name('libros.table');
Route::get('cine/table',        'VMoviesController@dataTable')->name('cine.table');
Route::get('musica/table',      'VMusicController@dataTable')->name('musica.table');
Route::get('fotografias/table', 'VPhotographyController@dataTable')->name('fotografias.table');
Route::get('multimedia/table',  'VMultimediaController@dataTable')->name('multimedia.table');

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
    Route::resource('requestsup',           'RequestsUpController',['as' => 'admin']);
    Route::resource('loansbydate',          'LoansbydateController',['as' => 'admin']);
    Route::resource('loansbyclassroom',     'LoansbyclassroomController',['as' => 'admin']);
    Route::resource('infoofdatabase',       'infoofdatabaseController',['as' => 'admin']);
    Route::resource('importfromrebeca',     'ImportfromrebecaController',['as' => 'admin']);
    Route::resource('claimloans',           'ClaimLoansController',['as' => 'admin']);
    Route::resource('statistic',            'StatisticController',['as' => 'admin']);
    Route::resource('manylenguages',        'ManyLenguagesController',['as' => 'admin']); 
    Route::resource('setting',              'SettingController',['as' => 'admin']); 
   
    
    //Print PDF
    Route::get('books/exportpdf/{id}',      'BookController@exportPdf')->name('libro.pdf');
    Route::get('movies/exportpdf/{id}',     'MoviesController@exportPdf')->name('cine.pdf');
    Route::get('music/exportpdf/{id}',      'MusicController@exportPdf')->name('musica.pdf');  
    Route::get('photographs/exportpdf/{id}','PhotographyController@exportPdf')->name('fotografia.pdf');  
    Route::get('multimedias/exportpdf/{id}','MultimediaController@exportPdf')->name('multimedia.pdf');        
 
    Route::get('books/obtener/{id}',                            'BookController@obtener');     
    Route::get('musics/obtener/{id}',                            'MusicController@obtener');     
    Route::get('movies/obtener/{id}',                            'MoviesController@obtener');     
    Route::get('photographs/obtener/{id}',                       'PhotographyController@obtener');     
    Route::get('multimedias/obtener/{id}',                       'MultimediaController@obtener');     


    Route::get('books/obtenersweet/{id}',                            'BookController@obtenersweet');     
    Route::get('musics/obtenersweet/{id}',                            'MusicController@obtenersweet');     
    Route::get('movies/obtenersweet/{id}',                            'MoviesController@obtenersweet');     
    Route::get('photographs/obtenersweet/{id}',                       'PhotographyController@obtenersweet');     
    Route::get('multimedias/obtenersweet/{id}',                       'MultimediaController@obtenersweet');  
    
    // Route::get('books/index/{request}/{idd}',                            'BookController@index');
   
    Route::get('movies/indexsolo/{id}/{tipo}',                         'MoviesController@indexsolo')->name('movies.indexsolo');
    Route::get('books/indexsolo/{id}/{tipo}',                         'BookController@indexsolo')->name('books.indexsolo');
    Route::get('music/indexsolo/{id}/{tipo}',                         'MusicController@indexsolo')->name('music.indexsolo');
    Route::get('photographs/indexsolo/{id}/{tipo}',                         'PhotographyController@indexsolo')->name('photographs.indexsolo');
    Route::get('multimedias/indexsolo/{id}/{tipo}',                         'MultimediaController@indexsolo')->name('multimedias.indexsolo'); 
    
    Route::get('loanmanual/showPartner/{id}',                   'LoanManualController@showPartner');
    Route::get('claimloans/filtarPorFecha/{fecha}',             'ClaimLoansController@filtarPorFecha');
    Route::post('fastprocess/grabar',                           'FastPartnerProcessController@grabar')->name('fastprocess.grabar');
    Route::get('fastprocess/vista_devo_reno/{id}/{bandera}/{fecha}',    'FastPartnerProcessController@vista_devo_reno')->name('fastprocess.vista_devo_reno');
    Route::get('fastprocess/edit2/{id}',                        'FastPartnerProcessController@edit2')->name('fastprocess.edit2');
    Route::get('loanmanual/prestar/{id}',                       'LoanManualController@prestar')->name('loanmanual.prestar');
    Route::get('genericcopies/copies/{id}/{bandera}',                     'GenericCopiesController@copies')->name('genericcopies.copies');
    Route::get('/newcopies/{id}',                               'GenericCopiesController@newcopies')->name('genericcopies.newcopies');
    Route::get('loanmanual/abm_prestamo/{id}/{bandera}/{n_mov}','LoanManualController@abm_prestamo')->name('loanmanual.abm_prestamo');
    
   //rebeca
    Route::delete('importfromrebeca/baja/{id}',       'ImportfromrebecaController@baja')->name('importfromrebeca.baja');    
    Route::delete('importfromrebeca/reactivar/{id}',  'ImportfromrebecaController@reactivar')->name('importfromrebeca.reactivar');

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
    Route::delete('requests/solicitud/{id}',   'RequestsController@solicitud')->name('requests.solicitud');
 
    Route::get('statistic/filtrar/{f_desde}/{f_hasta}', 'StatisticController@filtrar');
    
    Route::get('users/edit_profile/{id}',      'UserController@edit_profile')->name('users.edit_profile');
    Route::put('users/update_profile/{id}',    'UserController@update_profile')->name('users.update_profile');

    Route::delete('requestsup/rechazar/{id}',  'RequestsUpController@rechazar')->name('requestsup.rechazar');
    
    // traduccion mantenimineto
    Route::get('manyLenguages/edit_maintenance/{id}',    'ManyLenguagesController@edit_maintenance')->name('admin.manylenguages.edit_maintenance');
    Route::put('manyLenguages/update_maintenance/{id}',  'ManyLenguagesController@update_maintenance')->name('admin.manylenguages.update_maintenance');

    // traduccion listado
    Route::get('manyLenguages/edit_list/{id}',    'ManyLenguagesController@edit_list')->name('admin.manylenguages.edit_list');
    Route::put('manyLenguages/update_list/{id}',  'ManyLenguagesController@update_list')->name('admin.manylenguages.update_list');

    // traduccion estadistica
    Route::get('manyLenguages/edit_statistic/{id}',    'ManyLenguagesController@edit_statistic')->name('admin.manylenguages.edit_statistic');
    Route::put('manyLenguages/update_statistic/{id}',  'ManyLenguagesController@update_statistic')->name('admin.manylenguages.update_statistic');

    // traduccion perfil bilbioteca
    Route::get('manyLenguages/edit_library_profile/{id}',    'ManyLenguagesController@edit_library_profile')->name('admin.manylenguages.edit_library_profile');
    Route::put('manyLenguages/update_library_profile/{id}',  'ManyLenguagesController@update_library_profile')->name('admin.manylenguages.update_library_profile');

    // traduccion gestion prestamo 
    Route::get('manyLenguages/edit_loan/{id}',    'ManyLenguagesController@edit_loan')->name('admin.manylenguages.edit_loan');
    Route::put('manyLenguages/update_loan/{id}',  'ManyLenguagesController@update_loan')->name('admin.manylenguages.update_loan');
    
    // traduccion prestamo y devoluciones
    Route::get('manyLenguages/edit_loan_repayment/{id}',    'ManyLenguagesController@edit_loan_repayment')->name('admin.manylenguages.edit_loan_repayment');
    Route::put('manyLenguages/update_loan_repayment/{id}',  'ManyLenguagesController@update_loan_repayment')->name('admin.manylenguages.update_loan_repayment');

    // traduccion correspondencia
    Route::get('manyLenguages/edit_send_letter/{id}',    'ManyLenguagesController@edit_send_letter')->name('admin.manylenguages.edit_send_letter');
    Route::put('manyLenguages/update_send_letter/{id}',  'ManyLenguagesController@update_send_letter')->name('admin.manylenguages.update_send_letter');

    // traduccion socio
    Route::get('manyLenguages/edit_partner/{id}',    'ManyLenguagesController@edit_partner')->name('admin.manylenguages.edit_partner');
    Route::put('manyLenguages/update_partner/{id}',  'ManyLenguagesController@update_partner')->name('admin.manylenguages.update_partner');

    // traduccion mantenimineto-book
    Route::get('manyLenguages/edit_book/{id}',    'ManyLenguagesController@edit_book')->name('admin.manylenguages.edit_book');
    Route::put('manyLenguages/update_book/{id}',  'ManyLenguagesController@update_book')->name('admin.manylenguages.update_book');

    // traduccion mantenimineto-music
    Route::get('manyLenguages/edit_music/{id}',    'ManyLenguagesController@edit_music')->name('admin.manylenguages.edit_music');
    Route::put('manyLenguages/update_music/{id}',  'ManyLenguagesController@update_music')->name('admin.manylenguages.update_music');

    // traduccion mantenimineto-movie
    Route::get('manyLenguages/edit_movie/{id}',    'ManyLenguagesController@edit_movie')->name('admin.manylenguages.edit_movie');
    Route::put('manyLenguages/update_movie/{id}',  'ManyLenguagesController@update_movie')->name('admin.manylenguages.update_movie');
 
    // traduccion mantenimineto-multimedia
    Route::get('manyLenguages/edit_multimedia/{id}',    'ManyLenguagesController@edit_multimedia')->name('admin.manylenguages.edit_multimedia');
    Route::put('manyLenguages/update_multimedia/{id}',  'ManyLenguagesController@update_multimedia')->name('admin.manylenguages.update_multimedia');

     // traduccion mantenimineto-fotografia
     Route::get('manyLenguages/edit_fotografia/{id}',    'ManyLenguagesController@edit_fotografia')->name('admin.manylenguages.edit_fotografia');
     Route::put('manyLenguages/update_fotografia/{id}',  'ManyLenguagesController@update_fotografia')->name('admin.manylenguages.update_fotografia');
    
     // traduccion mantenimineto-listado
     Route::get('manyLenguages/edit_listado/{id}',    'ManyLenguagesController@edit_listado')->name('admin.manylenguages.edit_listado');
     Route::put('manyLenguages/update_listado/{id}',  'ManyLenguagesController@update_listado')->name('admin.manylenguages.update_listado');
 
  
    // traduccion  login-registro-recuperar pass
    Route::get('manyLenguages/edit_credentials/{id}',    'ManyLenguagesController@edit_credentials')->name('admin.manylenguages.edit_credentials');
    Route::put('manyLenguages/update_credentials/{id}',  'ManyLenguagesController@update_credentials')->name('admin.manylenguages.update_credentials');
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
Route::get('requests/table',            'RequestsController@dataTable')->name('requests.table');
Route::get('requestsup/table',          'RequestsUpController@dataTable')->name('requestsup.table');
Route::get('genericcopies/table/{id}',  'GenericCopiesController@dataTable')->name('genericcopies.table');
Route::get('loansbydate/table',         'LoansbydateController@dataTable')->name('loansbydate.table');
Route::get('loansbyclassroom/table',    'LoansbyclassroomController@dataTable')->name('loansbyclassroom.table');
Route::get('infoofdatabase/table',      'infoofdatabaseController@dataTable')->name('infoofdatabase.table');
Route::get('importfromrebeca/table',    'ImportfromrebecaController@dataTable')->name('importfromrebeca.table');
Route::get('manylenguages/table',       'ManyLenguagesController@dataTable')->name('manylenguages.table');
Route::get('currentloan/table',         'AdminController@dataTable')->name('currentloan.table');
Route::get('overdueloan/table',         'AdminController@dataTable2')->name('overdueloan.table');
Route::get('importfromrebeca/importar',                            'ImportfromrebecaController@importar')->name('importfromrebeca.importar');
Route::get('importfromrebeca/edicion/{id}',                            'ImportfromrebecaController@edicion')->name('importfromrebeca.edicion');

// Route::get('home', function () {
//     return view('admin.dashboard');
// });

// Route::get('email', function () {
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });
