<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="./img/sql.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Esquema de Base de Datos</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- Menu de consultas --}}
            {{-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'gestor-usuario' ? 'active' : '' }}" href="{{ route('gestor-usuario') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-database text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li> --}}



            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'gestor-consultasDDL' ? 'active' : '' }}" href="{{ route('gestor-consultasDDL') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-database text-primary text-sm opacity-10"></i>
                        {{-- <i class="fa-solid fa-database"></i> --}}
                    </div>
                    <span class="nav-link-text ms-1">Consultas DDL</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'consultas-dml' ? 'active' : '' }}" href="{{ route('consultas-dml') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-database text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Consultas DML</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'consultas-dcl' ? 'active' : '' }}" href="{{ route('consultas-dcl') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-database text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Consultas DCL</span>
                </a>
            </li>




            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tablas</h6>
                <ul style="max-height: 200px; overflow-y: auto;">

                </ul>
            </li> --}}

        </ul>
    </div>

    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-100 mx-auto" src="/img/University.jpg" alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">UNIVERSIDAD</h6>
                    <p class="text-xs font-weight-bold mb-0">ADVENTISTA DE BOLIVIA</p>
                </div>
            </div>
        </div>
        {{-- {{-- <a href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a> --}}
        <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.facebook.com/SoyUAB" target="_blank"
            type="button">Facebook</a>
    </div>

    <style>
        .sidenav-footer {
            text-align: center;
            background-color: #f8f9fa;
            /* Cambia el color de fondo según tu preferencia */
            padding: 20px;
        }

        #sidenavCard {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 0;
            /* Elimina el relleno predeterminado */
        }

        img.w-100 {
            max-width: 100%;
            /* Asegura que la imagen no se desborde del contenedor */
            border-radius: 10px;
            /* Agrega esquinas redondeadas */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            /* Agrega sombra a la imagen */
        }
    </style>




</aside>
