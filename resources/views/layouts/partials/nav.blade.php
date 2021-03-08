<ul class="sidebar-menu" data-widget="tree">
    <li class="header">{{ $idioma->navegacion }}</li>     

    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>{{ $idioma->inicio }}</span>
        </a>
    </li>    

    <li class="treeview {{ setActiveRoute(['admin.requests.index','admin.loanmanual.index', ]) }}">                
        <a href="#"><i class="fa fa-th-large"></i> <span>{{ $idioma->gestion }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">     
            <li class="{{ setActiveRoute('admin.requests.index') }}">
                <a href="{{ route('admin.requests.index') }}">
                    <i class="fa fa-globe"></i> <span>{{ $idioma->prestamos_web }}</span>
                </a>
            </li>        
            <li class="{{ setActiveRoute('admin.loanmanual.index') }}">
                <a href="{{ route('admin.loanmanual.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>{{ $idioma->prestamos_manuales }}</span>
                </a>
            </li>           
        </ul>
    </li>     

    <li class="treeview {{ setActiveRoute(['admin.fastprocess.index', 'fastprocess.index2']) }}">                
        <a href="#"><i class="fa fa-retweet"></i> <span>{{ $idioma->prest_y_dev }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.fastprocess.index') }}">
                <a href="{{ route('admin.fastprocess.index') }}">
                    <i class="fa fa-users"></i><span>{{ $idioma->pyd_por_socio }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('fastprocess.index2') }}">
                <a href="{{ route('fastprocess.index2') }}">
                    <i class="fa fa-folder-open"></i><span>{{ $idioma->pyd_por_doc }}</span>
                </a>
            </li>                                     
        </ul>
    </li>

    <li class="treeview {{ setActiveRoute(['admin.claimloans.index']) }}">                
        <a href="#"><i class="fa fa-envelope"></i> <span>{{ $idioma->correspondencia }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">     
            <li class="{{ setActiveRoute('admin.claimloans.index') }}">
                <a href="{{ route('admin.claimloans.index') }}">
                    <i class="fa fa-warning"></i> <span>{{ $idioma->reclamar_prestamos }}</span>
                </a>
            </li>          
        </ul>
    </li>     
   
    <li class="treeview {{ setActiveRoute(['admin.users.index','admin.requestsup.index']) }}">                
        <a href="#"><i class="fa fa-users"></i> <span>{{ $idioma->socios }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">     
            <li class="{{ setActiveRoute('admin.users.index') }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i><span> {{ $idioma->socios_alta_manual }}</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.requestsup.index') }}">
                <a href="{{ route('admin.requestsup.index') }}">
                    <i class="fa fa-inbox"></i> <span>{{ $idioma->socios_solicitudes }}</span>
                </a>
            </li>          
        </ul>
    </li>     

    <li class="treeview {{ setActiveRoute([
                                            'admin.books.index', 'admin.movies.index',
                                            'admin.music.index', 'admin.photographs.index',
                                            'admin.multimedias.index','importfromrebeca.importar','admin.importfromrebeca.index'                                           
                                        ]) }}">                
        <a href="#"><i class="fa fa-list"></i> <span>{{ $idioma->catalogo }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.books.index') }}">
                <a href="{{ route('admin.books.index') }}">
                    <i class="fa fa-book"></i><span> {{ $idioma->libros }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.movies.index') }}">
                <a href="{{ route('admin.movies.index') }}">
                    <i class="fa fa-video-camera"></i><span> {{ $idioma->cines }}</span> 
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.music.index') }}">
                <a href="{{ route('admin.music.index') }}">
                    <i class="fa fa-music"></i><span> {{ $idioma->musica }}</span> 
                </a>
            </li>   
            <li class="{{ setActiveRoute('admin.photographs.index') }}">
                <a href="{{ route('admin.photographs.index') }}">
                    <i class="fa fa-photo"></i><span> {{ $idioma->fotografia }}</span> 
                </a> 
            </li> 
            <li class="{{ setActiveRoute('admin.multimedias.index') }}">
                <a href="{{ route('admin.multimedias.index') }}">
                    <i class="fa fa-youtube-play"></i><span> {{ $idioma->multimedia }}</span> 
                </a>
            </li>  
            <li class="{{ setActiveRoute('importfromrebeca.importar') }}">
                <a href="{{ route('importfromrebeca.importar') }}"> 
                    <i class="fa fa-share-square-o"></i> <span>Importar desde Rebecca</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.importfromrebeca.index') }}">
                <a href="{{ route('admin.importfromrebeca.index') }}"> 
                    <i class="fa fa-share-square-o"></i> <span>Importaciones Rebecca</span>
                </a>
            </li>                    
        </ul>
    </li>
    
    <li class="treeview {{ setActiveRoute([
                                            'admin.languages.index', 'admin.periodicals.index',
                                            'admin.literatures.index', 'admin.adequacies.index',
                                            'admin.musicals.index', 'admin.cinematographics.index',
                                            'admin.formats.index',  'admin.references.index',
                                            'admin.courses.index', 'admin.subjects.index',
                                            'admin.letters.index'
                                        ]) }}">                
        <a href="#"><i class="fa fa-wrench"></i> <span>{{ $idioma->mantenimiento }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu"> 
            <li class="{{ setActiveRoute('admin.courses.index') }}">
                <a href="{{ route('admin.courses.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_cursos }}</span>
                </a>
            </li>   
            <li class="{{ setActiveRoute('admin.references.index') }}">
                <a href="{{ route('admin.references.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_maestros }}</span>
                </a>
            </li>             
            <li class="{{ setActiveRoute('admin.formats.index') }}">
                <a href="{{ route('admin.formats.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_formatos }}</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.languages.index') }}">
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_idiomas }}</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.periodicals.index') }}">
                <a href="{{ route('admin.periodicals.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_public_period }}</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.literatures.index') }}">
                <a href="{{ route('admin.literatures.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_generos_lit }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.musicals.index') }}">
                <a href="{{ route('admin.musicals.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_generos_musicales }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.cinematographics.index') }}">
                <a href="{{ route('admin.cinematographics.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_generos_cinemato }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.adequacies.index') }}">
                <a href="{{ route('admin.adequacies.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_personas_adecuadas }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.subjects.index') }}">
                <a href="{{ route('admin.subjects.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_materias }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.letters.index') }}">
                <a href="{{ route('admin.letters.index') }}">
                    <i class="fa fa-check-square"></i><span> {{ $idioma->mant_modelos_carta }}</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ setActiveRoute(['admin.loansbydate.index','admin.loansbyclassroom.index', 'admin.infoofdatabase.index']) }}">                
        <a href="#"><i class="fa fa-list"></i> <span> {{ $idioma->listados }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">     
            <li class="{{ setActiveRoute('admin.loansbydate.index') }}">
                <a href="{{ route('admin.loansbydate.index') }}">
                    <i class="fa fa-calendar"></i> <span> {{ $idioma->prestamos_por_fecha }}</span>
                </a>
            </li>      
            <li class="{{ setActiveRoute('admin.loansbyclassroom.index') }}">
                <a href="{{ route('admin.loansbyclassroom.index') }}">
                    <i class="fa fa-search"></i> <span> {{ $idioma->prestamos_por_aula }}</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.infoofdatabase.index') }}">
                <a href="{{ route('admin.infoofdatabase.index') }}">
                    <i class="fa fa-database"></i> <span> {{ $idioma->registros_db }}</span>
                </a>
            </li>             
        </ul>
    </li>  

    <li class="{{ setActiveRoute('admin.statistic.index') }}">
        <a href="{{ route('admin.statistic.index') }}">
            <i class="fa fa-bar-chart"></i> <span> {{ $idioma->estadisticas }}</span>
        </a>
    </li>  

    <li class="{{ setActiveRoute('admin.manylenguages.index') }}">
        <a href="{{ route('admin.manylenguages.index') }}">
            <i class="fa fa-globe"></i> <span> {{ $idioma->gestion_multi_idioma }}</span>
        </a>
    </li>

    <li class="treeview {{ setActiveRoute('admin.setting.index') }}">                
        <a href="#"><i class="fa fa-gears"></i> <span>Configuración</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.setting.index') }}">
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-suitcase"></i><span>Perfil de la Biblioteca</span>
                </a>
            </li>                                           
        </ul>
    </li>
      
    

    @if(Auth::user() != null && Auth::user()->getRoleNames() == 'Partner')
    <!-- aca se cambio web.libros.index -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">{{ $idioma->navegacion }}</li> 
        <li class="{{ setActiveRoute('index') }}">
            <a href="{{ route('index') }}">
                <i class="fa fa-dashboard"></i> <span>{{ $idioma->inicio }}</span>
            </a>
        </li>
        <li class="{{ setActiveRoute('admin.books.index') }}">
            <a href="{{ route('admin.books.index') }}">
                <i class="fa fa-book"></i><span> {{ $idioma->libros }}</span>
            </a>
        </li>
        <li class="{{ setActiveRoute('admin.movies.index') }}">
            <a href="{{ route('admin.movies.index') }}">
                <i class="fa fa-video-camera"></i><span> {{ $idioma->cines }}</span> 
            </a>
        </li>        
        <li class="{{ setActiveRoute('admin.music.index') }}">
            <a href="{{ route('admin.music.index') }}">
                <i class="fa fa-music"></i><span> {{ $idioma->musica }}</span> 
            </a>
        </li>   
        <li class="{{ setActiveRoute('admin.photographs.index') }}">
            <a href="{{ route('admin.photographs.index') }}">
                <i class="fa fa-photo"></i><span> {{ $idioma->fotografia }}</span> 
            </a>
        </li> 
        <li class="{{ setActiveRoute('admin.multimedias.index') }}">
            <a href="{{ route('admin.multimedias.index') }}">
                <i class="fa fa-youtube-play"></i><span>{{ $idioma->multimedia }}</span> 
            </a>
        </li>         
    </ul>
    @endif   

    @if(Auth::user() == null )
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">{{ $idioma->navegacion }}</li> 
        <li class="{{ setActiveRoute('index') }}">
            <a href="{{ route('index') }}">
                <i class="fa fa-dashboard"></i> <span>{{ $idioma->inicio }}</span>
            </a>
        </li>
        <li class="{{ setActiveRoute('web.libros.index') }}">
            <a href="{{ route('web.libros.index') }}">
                <i class="fa fa-book"></i><span>{{ $idioma->libros }}</span>
            </a>
        </li>
        <li class="{{ setActiveRoute('web.cine.index') }}">
            <a href="{{ route('web.cine.index') }}">
                <i class="fa fa-video-camera"></i><span>{{ $idioma->cines }}</span> 
            </a>
        </li>        
        <li class="{{ setActiveRoute('web.musica.index') }}">
            <a href="{{ route('web.musica.index') }}">
                <i class="fa fa-music"></i><span>{{ $idioma->musica }}</span> 
            </a>
        </li>   
        <li class="{{ setActiveRoute('web.fotografias.index') }}">
            <a href="{{ route('web.fotografias.index') }}">
                <i class="fa fa-photo"></i><span>{{ $idioma->fotografia }}</span> 
            </a>
        </li> 
        <li class="{{ setActiveRoute('web.multimedia.index') }}"> 
            <a href="{{ route('web.multimedia.index') }}">
                <i class="fa fa-youtube-play"></i><span>{{ $idioma->multimedia }}</span> 
            </a>
        </li>         
    </ul>
    @endif   
</ul>