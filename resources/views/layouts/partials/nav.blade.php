<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Navegación</li> 

    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
    </li>  
    <li class="{{ setActiveRoute('admin.loanmanual.index') }}">
        <a href="{{ route('admin.loanmanual.index') }}">
            <i class="fa fa-pencil"></i> <span>Prestamos Manuales</span>
        </a>
    </li>
    <li class="{{ setActiveRoute('admin.requests.index') }}">
        <a href="{{ route('admin.requests.index') }}">
            <i class="fa fa-pencil"></i> <span>Solicitudes desde la web</span>
        </a>
    </li> 
    <li class="{{ setActiveRoute('admin.loansbydate.index') }}">
        <a href="{{ route('admin.loansbydate.index') }}">
            <i class="fa fa-pencil"></i> <span>Prestamos por rango de fecha</span>
        </a>
    </li>
    <li class="{{ setActiveRoute('admin.loansbyclassroom.index') }}">
        <a href="{{ route('admin.loansbyclassroom.index') }}">
            <i class="fa fa-pencil"></i> <span>Prestamos por datos del aula</span>
        </a>
    </li>
    <!-- <li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li> -->
    
    <li class="treeview {{ setActiveRoute(['admin.fastprocess.index', 'fastprocess.index2']) }}">                
        <a href="#"><i class="fa fa-th-large"></i> <span>Prestamos y Devoluciónes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.fastprocess.index') }}">
                <a href="{{ route('admin.fastprocess.index') }}">
                    <i class="fa fa-users"></i><span> Socios</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('fastprocess.index2') }}">
                <a href="{{ route('fastprocess.index2') }}">
                    <i class="fa fa-folder-open"></i><span> Documentos</span>
                </a>
            </li>
                                     
        </ul>
    </li>

    <!-- <li class="treeview">
        <a href="#"><i class="fa fa-bars"></i> <span>Gestión</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    <ul class="treeview-menu">
        <li><a href="#">Proceso rápido</a></li>
        <li><a href="#">Prestamos desde la web</a></li>
    </ul>
    </li> -->

    <li class="treeview {{ setActiveRoute('admin.users.index') }}">                
        <a href="#"><i class="fa fa-users"></i> <span>Socios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.users.index') }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i><span> Alta manual de socios</span>
                </a>
            </li>                     
        </ul>
    </li>

    <li class="treeview {{ setActiveRoute([
                                            'admin.books.index', 'admin.movies.index',
                                            'admin.music.index', 'admin.photographs.index',
                                            'admin.multimedias.index'                                           
                                        ]) }}">                
        <a href="#"><i class="fa fa-list"></i> <span>Catálogo</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.books.index') }}">
                <a href="{{ route('admin.books.index') }}">
                    <i class="fa fa-book"></i><span> Libros</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.movies.index') }}">
                <a href="{{ route('admin.movies.index') }}">
                    <i class="fa fa-video-camera"></i><span> Cines</span> 
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.music.index') }}">
                <a href="{{ route('admin.music.index') }}">
                    <i class="fa fa-music"></i><span> Musica</span> 
                </a>
            </li>   
            <li class="{{ setActiveRoute('admin.photographs.index') }}">
                <a href="{{ route('admin.photographs.index') }}">
                    <i class="fa fa-photo"></i><span> Fotografias</span> 
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.multimedias.index') }}">
                <a href="{{ route('admin.multimedias.index') }}">
                    <i class="fa fa-youtube-play"></i><span> Multimedias</span> 
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
        <a href="#"><i class="fa fa-wrench"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu"> 
            <li class="{{ setActiveRoute('admin.courses.index') }}">
                <a href="{{ route('admin.courses.index') }}">
                    <i class="fa fa-check-square"></i><span> Cursos</span>
                </a>
            </li>   
            <li class="{{ setActiveRoute('admin.references.index') }}">
                <a href="{{ route('admin.references.index') }}">
                    <i class="fa fa-check-square"></i><span> Maestros de Referencias</span>
                </a>
            </li>             
            <li class="{{ setActiveRoute('admin.formats.index') }}">
                <a href="{{ route('admin.formats.index') }}">
                    <i class="fa fa-check-square"></i><span> Formatos Gráficos</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.languages.index') }}">
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fa fa-check-square"></i><span> Idiomas</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.periodicals.index') }}">
                <a href="{{ route('admin.periodicals.index') }}">
                    <i class="fa fa-check-square"></i><span> Publicaciónes Periodicas</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.literatures.index') }}">
                <a href="{{ route('admin.literatures.index') }}">
                    <i class="fa fa-check-square"></i><span> Géneros Literarios</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.musicals.index') }}">
                <a href="{{ route('admin.musicals.index') }}">
                    <i class="fa fa-check-square"></i><span> Géneros Musicales</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.cinematographics.index') }}">
                <a href="{{ route('admin.cinematographics.index') }}">
                    <i class="fa fa-check-square"></i><span> Géneros Cinematográficos</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.adequacies.index') }}">
                <a href="{{ route('admin.adequacies.index') }}">
                    <i class="fa fa-check-square"></i><span> Personas Adecuadas</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.subjects.index') }}">
                <a href="{{ route('admin.subjects.index') }}">
                    <i class="fa fa-check-square"></i><span> Materias</span>
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.letters.index') }}">
                <a href="{{ route('admin.letters.index') }}">
                    <i class="fa fa-check-square"></i><span> Modelos de Cartas</span>
                </a>
            </li>
        </ul>
    </li>
   
</ul>
