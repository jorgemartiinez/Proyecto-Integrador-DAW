<body>
    <div class="d-flex " id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">
                Panel Administrador<br>
                <img src="{{ asset('images/cau.png') }}" class="img-fluid">
            </div>
            <div class="list-group list-group-flush">
                <a href="/admin" class="list-group-item list-group-item-action bg-light">Panel Principal</a>
            </div>
            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="m-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#usuarios" aria-expanded="false" aria-controls="usuarios">
                                Usuarios
                            </button>
                        </h5>
                    </div>

                    <div id="usuarios" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <ul class="list-group">
                            <li class="list-group-item"><router-link :to="{ name: 'tabla.users'}">Lista de Usuarios</router-link></li>
                            <li class="list-group-item"><router-link :to="{ name: 'tabla.userPeticiones'}">Gestionar Usuarios</router-link></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEvent">
                        <h5 class="m-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#eventos" aria-expanded="false" aria-controls="eventos">
                                Eventos
                            </button>
                        </h5>
                    </div>

                    <div id="eventos" class="collapse" aria-labelledby="headingEvent" data-parent="#accordion">
                        <ul class="list-group">
                            <li class="list-group-item"><router-link :to="{ name: 'tabla.eventos'}">Lista Eventos</router-link></li>

                            <li class="list-group-item"><router-link :to="{ name: 'evento.nuevo'}">Nuevo Evento</router-link></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="m-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#comisiones" aria-expanded="false" aria-controls="comisiones">
                                Comisiones
                            </button>
                        </h5>
                    </div>

                    <div id="comisiones" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <ul class="list-group">
                            @foreach($comisiones as $comision)
                                <li class="list-group-item">
                                    <router-link :to="{ name: 'comision.general' , params:{id: {{$comision->id}} }}">
                                        {{$comision->nombre}}
                                    </router-link>
                                </li>
                            @endforeach
                            <li class="list-group-item"><router-link :to="{ name: 'comision.listado'}">Ver todas las comisiones</router-link></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="m-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#herramientas" aria-expanded="false" aria-controls="herramientas">
                                Posts
                            </button>
                        </h5>
                    </div>
                    <div id="herramientas" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <ul class="list-group">
                            <li class="list-group-item"><router-link :to="{ name: 'tabla.posts'}">Lista Noticias</router-link></li>
                            <li class="list-group-item"><a href="/admin/posts/new" target="_blank">Nueva Noticia</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle" onclick="document.getElementById('wrapper').classList.toggle('toggled')">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/post">Posts</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/sobre-nosotros">Sobre Nosotros</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/logout">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>



            <!-- /#page-content-wrapper -->


            <!-- /#wrapper -->

            <!-- Menu Toggle Script -->
