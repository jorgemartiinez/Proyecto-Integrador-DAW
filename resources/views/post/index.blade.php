@extends('layouts.master')
@section('content')

<section class="site-section py-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="my-4">Noticias
                    <small>Mantente a la última</small>
                </h1>
            </div>
        </div>
        <div class="container">
            <div class="row">

                @foreach($post as $noticia)
                <div class="col-sm-9 col-12 text-justify my-4">
                    <h4 class="card-title">
                        <a href="{{url('/post/show/'.$noticia->id)}}">{{$noticia->titulo}}</a>
                    </h4>
                    <p class="card-text">{{$noticia->descripcion}}</p>

                </div>

                <div class="col-sm-3 col-12 my-4">

                    <a href="#"><img class="card-img-top rounded-circle" src="{{asset('images/niveles/'.$noticia->id_nivel.'.png')}}" alt=""></a>

                </div>

                @endforeach
            </div>
        </div>
    </div>
</section>

@stop
