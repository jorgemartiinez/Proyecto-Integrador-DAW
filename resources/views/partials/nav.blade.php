<body>
<header role="banner">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 search-top d-flex align-items-center">
                    @if( Auth::check() != null )
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Monitor'))
                            <a id="administracion" href="/admin"><span class="fa fa-tool"></span>Administración</a>
                        @endif
                    @endif
                </div>
                <div class="col-lg-4 col-md-4 col-12 search-top text-center">
                    <a class="titulo-cau" href="/">CAU - Alcoy</a>
                </div>
                <div class="col-lg-4 col-md-4 col-12  search-top opciones-sesion">
                    @if( Auth::check() == null )
                        <a href="/login"><span class="fa fa-user"></span> Iniciar sesion</a><br>
                        <a href="/register"><span class="fa fa-edit separar"></span> Registrarse</a>
                    @else
                        <a href="/espacio-personal"><span class="fa fa-user-circle"></span> {{Auth::user()->username}} - Espacio Personal</a><br>
                        <a href="/logout"><span class="fa fa-sign-out"></span> Cerrar Sesión</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{enlaceActivo('/')}}" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{enlaceActivo('/post')}}" href="/post">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{enlaceActivo('/sobre-nosotros')}}" href="/sobre-nosotros">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link {{enlaceActivo('/contacto')}}" href="/contacto">Contacto</a>

                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header> <!-- END header -->
