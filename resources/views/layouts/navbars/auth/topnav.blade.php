<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
    {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">

        <!-- Tablas -->
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Tablas</h6>
            <div style="max-height: 200px; overflow-y: auto;">
                @php
                $tables = DB::select('SHOW TABLES');
                @endphp
                @foreach ($tables as $table)
                    <button class="btn btn-light my-1">{{ $table->Tables_in_sistemarestaurante }}</button>
                @endforeach
            </div>
        </li>
        <!-- Fin de Tablas -->

    </div>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

        <ul class="navbar-nav justify-content-end">
            <!-- Cerrar Sesión -->
            <li class="nav-item d-flex align-items-center">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Cerrar Sesión</span>
                    </a>
                </form>
            </li>
            <!-- Fin de Cerrar Sesión -->

            <!-- Icono Navbar Sidenav -->
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </li>
            <!-- Fin de Icono Navbar Sidenav -->

            <!-- Configuración -->
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0">
                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                </a>
            </li>
            <!-- Fin de Configuración -->
        </ul>
    </div>
</nav>

<!-- End Navbar -->
