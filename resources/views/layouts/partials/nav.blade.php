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

    <li class="treeview {{ setActiveRoute('admin.books.index') }}">                
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
        </ul>
    </li>
    
    <li class="treeview {{ setActiveRoute(['admin.languages.index', 'admin.times.index']) }}">                
        <a href="#"><i class="fa fa-list"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.languages.index') }}">
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fa fa-globe"></i><span> Idiomas</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.languages.index') }}">
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fa fa-globe"></i><span> Publicaciónes Periodicas</span>
                </a>
            </li>                     
        </ul>
    </li>
   
</ul>
