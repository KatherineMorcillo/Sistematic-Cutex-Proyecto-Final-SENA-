<ul class="menu">
    <!--Titulo descripcion -->
    <li class="menu-title">Navegación</li>
    <li class="menu-item">
        <a href="{{ route('proveedores') }}" class="menu-link">
            <span class="menu-icon"><i class="fa-solid fa-users"></i></span>
            <span class="menu-text"> Proveedores </span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('productos') }}" class="menu-link">
            <span class="menu-icon"><i class="fa-sharp fa-solid fa-bag-shopping"></i></span>
            <span class="menu-text"> Productos</span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('clientes') }}" class="menu-link">
            <span class="menu-icon"><i class="fa-solid fa-file-invoice"></i></span>
            <span class="menu-text">Clientes </span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('facturas') }}" class="menu-link">
            <span class="menu-icon"><i class="fa-solid fa-file-invoice"></i></span>
            <span class="menu-text">Facturas </span>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route("reportes") }}" class="menu-link">
            <span class="menu-icon"><i class="fa-solid fa-chart-line"></i></span>
            <span class="menu-text"> Reportes </span>
        </a>
    </li>


</ul>
