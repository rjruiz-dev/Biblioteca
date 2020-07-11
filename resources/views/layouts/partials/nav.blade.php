<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Navegación</li> 

    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
    </li>   
    <!-- <li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li> -->
    
    <li class="treeview">
        <a href="#"><i class="fa fa-bars"></i> <span>Gestión</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    <ul class="treeview-menu">
        <li><a href="#">Proceso rápido</a></li>
        <li><a href="#">Prestamos desde la web</a></li>
    </ul>
    </li>


    
    <li class="treeview {{ setActiveRoute('admin.fastprocess.index') }}">                
        <a href="#"><i class="fa fa-users"></i> <span>Proceso rapido</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.fastprocess.index') }}">
                <a href="{{ route('admin.fastprocess.index') }}">
                    <i class="fa fa-user"></i><span> Socios</span>
                </a>
            </li> 
                               
        </ul>
    </li>


         



    <li class="treeview {{ setActiveRoute('admin.users.index') }}">                
        <a href="#"><i class="fa fa-users"></i> <span>Administrar Socios</span>
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

    <li class="treeview {{ setActiveRoute('admin.books.index') }}">                
        <a href="#"><i class="fa fa-list"></i> <span>Administrar Catálogo</span>
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
            <li class="{{ setActiveRoute('admin.music.index') }}">
                <a href="{{ route('admin.music.index') }}">
                    <i class="fa fa-book"></i><span> Musica</span> 
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.multimedias.index') }}">
                <a href="{{ route('admin.multimedias.index') }}">
                    <i class="fa fa-book"></i><span> Multimedia</span> 
                </a>
            </li>   
            <li class="{{ setActiveRoute('admin.movies.index') }}">
                <a href="{{ route('admin.movies.index') }}">
                    <i class="fa fa-book"></i><span> Cines</span> 
                </a>
            </li>
            <li class="{{ setActiveRoute('admin.photographs.index') }}">
                <a href="{{ route('admin.photographs.index') }}">
                    <i class="fa fa-book"></i><span> Fotografia</span> 
                </a>
            </li>                    
        </ul>
  
    </li>
   
</ul>
