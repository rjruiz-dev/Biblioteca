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

    <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>Socios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    <ul class="treeview-menu">
        <li><a href="#">Alta manual de socios</a></li>   
    </ul>
    </li>
</ul>
