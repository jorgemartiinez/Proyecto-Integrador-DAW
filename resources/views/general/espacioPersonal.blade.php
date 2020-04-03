@extends('layouts.master')
@section('content')
<div class="container">

    <div class="row">
        @if($error)
        <div class="container">
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>¡Atención!</strong> No se ha podido cambiar la imagen.
            </div>
        </div>
        @endif
        <main class="col-12">

            <section class="row mt-5 mb-5 bg-light">
                <article class="col-4 text-center">
                    <form id="change-avatar" action="/espacio-personal/changeAvatar" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label id="img-personal" for="avatar">
                            <img src="{{Auth::user()->avatar()}}" height="270px" alt="foto-personal" ><br/>
                            Click para cambiar
                        </label> 
                        <input id="input-file" type="file" name="avatar" accept=".png,.jpg,.jpeg" hidden>
                    </form>
                </article>

                <article class="col-8 mt-5">

                    <h2>Nombre: <small style="color: grey;">{{Auth::user()->nombre}} {{Auth::user()->apellidos}}</small>
                    </h2>

                    @if(Auth::user()->miembro != null)
                    <h2>Nivel: <small style="color: grey;">{{Auth::user()->miembro->nivel->nombre}}</small></h2>
                    @endif
                </article>

            </section>

            <section class="row mt-5 mb-5 bg-light">

                <div class="col-12">

                    @if(Auth::user()->miembro != null)
                    <h1 align="center">Eventos</h1>
                    @else
                    <h1 align="center">Hijos</h1>
                    @endif

                    @if(Auth::user()->miembro != null)

                    <article class="row mb-4">

                        <div class="col-12">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre Evento</th>
                                        <th scope="col">Fecha Evento</th>
                                        <th scope="col">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datos as $evento)
                                    <tr>
                                        <td>{{$evento->nombre}}</td>
                                        <td>{{$evento->fecha}}</td>
                                        <td>{{$evento->descripcion}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </article>

                    @else

                    @foreach($datos as $nino)

                    <h2>Nombre: {{$nino[0]->nombre}}</h2>

                    <h4 class="ml-2">Datos personales </h4>

                    <article class="row mb-4 hijo">

                        <div id="{{'datosPersonales'.$nino[0]->id}}" class="col-12 d-none">

                            <ul>
                                <li>Nombre: {{$nino[0]->nombre}}</li>
                                <li>Apellidos: {{$nino[0]->apellidos}}</li>
                                <li>DNI: {{$nino[0]->dni}}</li>
                            </ul>

                        </div>

                        <button id="{{'datosPersonales'.$nino[0]->id.'_boton'}}"
                            class="btn rounded ml-4">Mostrar</button>

                    </article>

                    <h4 class="ml-3">Eventos</h4>

                    <article class="row mb-4 hijo">

                        <div id="{{'eventos'.$nino[0]->id}}" class="col-12 d-none">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre Evento</th>
                                        <th scope="col">Fecha Evento</th>
                                        <th scope="col">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nino[1] as $evento)
                                    <tr>
                                        <td>{{$evento->nombre}}</td>
                                        <td>{{$evento->fecha}}</td>
                                        <td>{{$evento->descripcion}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <button id="{{'eventos'.$nino[0]->id.'_boton'}}" class="btn rounded ml-4">Mostrar</button>

                    </article>

                    <h4 class="ml-3">Acciones disponibles</h4>

                    <article class="row mb-4 hijo">

                        <div id="{{'acciones'.$nino[0]->id}}" class="col-12 d-none mb-3">

                            <button>Eliminar niño muy fuerte</button>
                            <button>Cambiar la contraseña</button>
                            <button>Otra opción que no está contemplada</button>

                        </div>

                        <button id="{{'acciones'.$nino[0]->id.'_boton'}}" class="btn rounded ml-4">Mostrar</button>

                    </article>

                    @endforeach

                    <a type="button" class="btn btn-info rounded" href="/registrar-hijo">Registrar un niño</a>

                    @endif

                </div>

            </section>

            <!-- Proximamente modificar con los card de bootstrap -->

            <section class="row mt-5 mb-5 bg-light">

                <article class="col-12">

                    <div class="row text-center">

                        <div class="col-6 text-justify">

                            <h1>Actas</h1>

                            <p>

                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi beatae quae laborum
                                nostrum esse assumenda illo, deleniti obcaecati cupiditate dolorum. A quae veritatis
                                aliquid modi unde soluta veniam provident necessitatibus.

                            </p>

                        </div>

                        <div class="col-6 text-justify">

                            <h1>Tareas</h1>

                            <ul class="list-group">
                                @foreach($comisiones as $comision)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href={{"/admin/comisiones/show/".$comision->id}}>
                                        {{$comision->nombre}}
                                    </a>
                                    <span class="badge badge-primary badge-pill">{{count($comision->tareas)}}</span>
                                </li>
                                @endforeach
                            </ul>

                        </div>

                    </div>

                </article>

            </section>

        </main>

    </div>

</div>
@stop