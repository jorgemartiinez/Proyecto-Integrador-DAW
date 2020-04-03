@extends('layouts.master')
@section('content')

<section class="py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div class="owl-carousel owl-theme home-slider">
                    <div > <!-- Este div se puede repetir -->
                        <a href="{{url('/post/show/'.$banner->post_id)}}" class="a-block d-flex align-items-center height-lg" style="background-image: url('images/img_1.jpg'); ">
                            <div class="text half-to-full">
                                <div class="post-meta">
                                    <span class="mr-2">{{$banner->fecha}} </span> &bullet;
                                    <span class="ml-2"><span class="fa fa-comments"></span> {{($numComentarios)?$numComentarios:0}}</span>
                                </div>

                                <h3 style="color:white;">{{$banner->titulo}}</h3>
                                <div style="color:white;">{!! $banner->descripcion !!}</div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

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
                @foreach($noticias as $noticia)
                <div class="col-sm-9 col-12 text-justify my-4">
                    <h4 class="card-title">
                        <a href="{{url('/post/show/'.$noticia->id_post)}}">{{$noticia->titulo}}</a>
                    </h4>
                    <p class="card-text">{{$noticia->descripcion}}</p>

                </div>

                <div class="col-sm-3 col-12  my-4">

                    <a href="#"><img class="card-img-top" src="{{asset('images/niveles/'.$noticia->id_nivel.'.png')}}" alt="Foto de soporte para la noticia"></a>

                </div>

                @endforeach
            </div>
            {{ $noticias->render() }}
        </div>
    </div>
</section>
@stop
