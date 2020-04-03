@extends('layouts.master')
@section('content')
    <div class="mt-5" style="background-color: orange; height: 60vh; overflow: hidden; background-position: center;">

        <img src="{{ asset('images/img_2.jpg') }}" alt="foto personas" style="width: 100%; height: auto; margin-top: -200px">

    </div>

    <br />

    <div class="container">

        <div class="row">

            <main class="col-sm-8">

                <!-- Inicio del main content -->

                <section class="main-content">

                    <h1 class="mb-4">{{$post->titulo}}</h1>

                    <article class="post-content-body">

                        <div class="row mb-5">

                            <div class="col-12 text-center">

                                <img src="{{ asset('images/img_8.jpg') }}" width="500px" alt="Image placeholder vue man" class="img-fluid">

                            </div>

                            <div class="col-12 mt-5">

                                {!! $post->contenido !!}

                            </div>

                        </div>

                    </article>

                </section>

                <!-- Zona de los comentarios -->

                @if($post->comentarios==true)
                    @if(count($comentarios))

                        <section class="">

                            <h3 class="mb-5">Comentarios</h3>

                            <ul class="comment-list">
                                @foreach($comentarios as $comentario)
                                    <li class="comment">
                                        <div class="vcard">
                                            <img src="{!! $comentario->usuario->avatar() !!}" alt="Foto perfil" class="img-fluid">
                                        </div>
                                        <div class="comment-body">
                                            <h3>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellidos}}</h3>
                                            <div class="meta">{{$comentario->created_at}}</div>
                                            <p>{{$comentario->mensaje}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </section>
                    @else
                        <h4>Todavía no se han escrito comentarios para este post.</h4>
                        @endif
                    @endif
                <!-- Fin de la zona de los comentarios -->

                    <!-- Formulario para postear comentarios -->

                    @if(Auth::check())
                        @if($post->comentarios==true)
                            <section class="comment-form-wrap pt-5">
                                <h3 class="mb-2">Deja un comentario</h3>
                                {!! Form::open(['route'=>'post.sendComentario']) !!}
                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                                {!! Form::hidden('post_id', $post->id) !!}
                                <div class="form-group">
                                    {!! Form::textarea('mensaje', old('mensaje'), ['class'=>'form-control', 'placeholder'=>'Comentario...']) !!}
                                    @if ($errors->has('mensaje')) <p style="color:red;">{{ $errors->first('mensaje') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Enviar</button>
                                </div>
                                {!! Form::close() !!}
                            </section>
                        @endif
                    @else
                        <section class="comment-form-wrap pt-5">
                            <h2><a href="/register">Regístrate</a> <a href="/login">Login</a></h2>
                        </section>
                @endif
                <!-- Fin del formaulario para postear comentarios -->
            </main>
            <!-- Fin del main content -->

            <!-- Inicio del aside -->

            <aside class="col-sm-4 sidebar">

                <!-- Apartado del monitor -->

                <div class="sidebar-box">
                    <div class="bio text-center">
                        <div id="foto-creador">
                            <img src="{{ $usuario->avatar() }}" alt="Image Placeholder" class="img-fluid">
                        </div>

                        <div class="bio-body text-left">
                            <h2 class="text-center">Post escrito por:</h2>
                            <ul>
                                <li class="mt-2"><b>Nombre: <br></b>{{$usuario->nombre . ' ' . $usuario->apellidos}}</li>
                                @if($usuario->monitor!=null)
                                    <li class="mt-2"><b>Email: <br></b>{{$usuario->monitor->email}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Fin del apartado del monitor -->

            </aside>

        </div>

    </div>

    <!-- Fin del aside -->

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-3 ">Noticias más recientes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="a-block d-flex align-items-center height-md" style="background-image: url('{{ asset('images/img_2.jpg') }}'); ">
                        <div class="text">
                            <div class="post-meta">
                                <span class="category">Lifestyle</span>
                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                            <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="a-block d-flex align-items-center height-md" style="background-image: url('{{ asset('images/img_3.jpg') }}'); ">
                        <div class="text">
                            <div class="post-meta">
                                <span class="category">Travel</span>
                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                            <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="a-block d-flex align-items-center height-md" style="background-image: url('{{ asset('images/img_4.jpg') }}'); ">
                        <div class="text">
                            <div class="post-meta">
                                <span class="category">Food</span>
                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                            <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop
