<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Biblioteca | Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- <link rel="stylesheet" href="/adminlte/css/main.css"> -->


  @stack('styles')

  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">  
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/adminlte/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">    
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>O</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ $idioma->biblioteca }}</b></span>  
    </a>

    <!-- Header Navbar -->
   
    <nav class="navbar navbar-static-top" role="navigation">
   
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
    
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-globe"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Elija un idioma</li>
              @foreach($idiomas as $idioma_ind)
              <li class="footer"><a href="{{ route('cambiar', $idioma_ind->id) }}" class="btn-cambiar">{{ $idioma_ind->lenguage_description }}</a></li>
              @endforeach
              </ul>
          </li>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                      <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="/adminlte/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          AdminLTE Design Team
                          <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="/adminlte/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Developers
                          <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="/adminlte/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Sales Department
                          <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="/adminlte/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Reviewers
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
    
          <!-- User Account Menu -->
          @if(Auth::user() != null )
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span id="rec_nickname" class="hidden-xs">{{ Auth::user() != null  ? Auth::user()->name : 'No logueado' }}</span>
              
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
               
                <small>Desde {{ Auth::user() != null ? Auth::user()->created_at->format('d/M/Y') : 'No logueado' }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <!-- <div class="pull-right"> -->

                  <form method="POST" action="{{ route('logout')}}">
                  {{ csrf_field() }}
                    <button class="btn btn-danger btn-flat btn-block"><i class="fa fa-power-off"></i>&nbsp;Cerrar sesión</button>
                  <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->
                <!-- </div> -->
                  </form>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{ route('users.edit_profile', Auth::user()->id) }}" class="modal-show-edicion-perfil" title="Edicion de Perfil"><i class="fa fa-user"></i></a>
          </li>
          @else
          
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="{{ route('login') }}">
              <!-- The user image in the navbar-->
              <!-- <img src="/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ $idioma->iniciar_sesion }}</span>
              
            </a>
            </li>
            <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="{{ route('vusers.create') }}" class="modal-show-solicitud-registro" title="Solicitud de Registro">
            
              <!-- The user image in the navbar-->
              <!-- <img src="/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ $idioma->registrarse }}</span>
              
            </a>
            </li>
          @endif
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <p>{{ Auth::user() != null ? Auth::user()->name : $idioma->invitado }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> {{ $idioma->en_linea }}</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
        @include('layouts.partials.nav')      
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
      @yield('header')

    </section>
      
    <!-- Main content -->
    <section class="content container-fluid">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



@stack('scripts')


<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- MODAL EXCLUSIVO PARA HACER UNA SOLICITUD -->
@include('web.users.partials._modal')
<!-- MODAL EXCLUSIVO PARA EDITAR DATOS DEL PERFIL -->
@include('admin.users.partials._modal_edicion_perfil') 
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>

<script>
// SOLICITUD DE REGISTRO DE NUEVO USUARIO - EXCLUSIVO DE FRONT-END
// MODAL CORRESPONDIENTE A LA SOLICITUD DE REGISTRO DE SOCIO
$('body').on('click', '.modal-show-solicitud-registro', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save-solicitud-registro').removeClass('hide')
    .text(me.hasClass('edit') ? 'Actualizar' : 'Enviar Solicitud');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
            
            $('#birthdate').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd-mm-yyyy',                       
                language: 'es'
            });   
                   
                 
        }
    });

    $('#modal').modal('show');
});
// BOTON PARA GUARDAR LA SOLICITUD DE REGISTRO DE UN SOCIO
// $('body').on('click', '.modal-show-solicitud', function (event) {
$('#modal-btn-save-solicitud-registro').click(function (event) {
    event.preventDefault();

    // $avatarInput = $('#user_photo');

    // var formData  = new FormData();        
    //     formData.append('user_photo', $avatarInput[0].files[0]);
        
    var form = $('#modal-body form'), 
        url = form.attr('action'),
        method =  'POST' ;
        // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    
    $.ajax({
        url : url + '?' + form.serialize(),
        method: method,
        // data : formData, 
        cache: false,  
        processData: false,
        contentType: false,
        success: function (response) {
          // var  info = response.bandera;
            form.trigger('reset');
            $('#modal').modal('hide');
            // $('#rec_nickname').DataTable().ajax.reload();
            // $("#rec_nickname").load(" #rec_nickname"); 
            // if(info == 0){
            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se ha completado su solicitud de asociamineto! Recibira la respuesta a su solicitud al mail con el cual se registro'
            });
          // }else{
          //   swal({
          //       type : 'success',
          //       title : '¡Éxito!',
          //       text : '¡Se han actualizado sus datos!'
          //   });

          // }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
})

// MODAL CORRESPONDIENTE A LA EDICION DE DATOS DEL PERFIL DE USUARIO LOGUEADO

$('body').on('click', '.modal-show-edicion-perfil', function (event) {
    event.preventDefault();
    
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title_edicion_perfil').text(title);
    $('#modal-btn-save-edicion-perfil').removeClass('hide')
    .text('Actualizar Datos');
    
    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body_edicion_perfil').html(response);
            
            $('#gender').select2({
                placeholder: 'Selecciona un Género',
                tags: true,               
                dropdownParent: $('#modal')
            });

            $('#province').select2({
                placeholder: 'Selecciona o Ingresa una Provincia',
                tags: true,       
                dropdownParent: $('#modal')                     
            });

            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd/mm/yyyy',                       
                language: 'es'
            });   
                   
                 
        }
    });

    $('#modal_edicion_perfil').modal('show');
});

// BOTON PARA GUARDAR LA SOLICITUD DE REGISTRO DE UN SOCIO
// $('body').on('click', '.modal-show-solicitud', function (event) {
$('#modal-btn-save-edicion-perfil').click(function (event) {
    event.preventDefault();

    $avatarInput = $('#user_photo');

    var formData  = new FormData();        
        formData.append('user_photo', $avatarInput[0].files[0]);
        
    var form = $('#modal-body_edicion_perfil form'), 
        url = form.attr('action'),
        method =  'POST';
        // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    
    $.ajax({
        url : url + '?' + form.serialize(),
        method: method, 
        data : formData,       
        cache: false,  
        processData: false,
        contentType: false,
        success: function (response) {
          // var  info = response.bandera;
            form.trigger('reset');
            $('#modal_edicion_perfil').modal('hide');
            // $('#rec_nickname').DataTable().ajax.reload();
            $("#rec_nickname").load(" #rec_nickname"); 
            // if(info == 0){
            swal({
                    type : 'success',
                    title : '¡Éxito!',
                    text : '¡Se han actualizado sus datos!'
            });
          // }else{
          //   swal({
          //       type : 'success',
          //       title : '¡Éxito!',
          //       text : '¡Se han actualizado sus datos!'
          //   });

          // }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
})

// SIRVE PARA CMABIAR EL IDIOMA 
$('body').on('click', '.btn-cambiar', function (event) {
    event.preventDefault();
   
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
       
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                  window.location.reload(); 
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Ups...',
                        text: '¡Algo salió mal!'
                    });
                }
            });
});

</script>

</body>
</html>