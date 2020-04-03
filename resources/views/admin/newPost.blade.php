@extends('layouts.newPost')
@section('content')
	<header class="jumbotron text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12"><h1>Nueva Noticia</h1></div>
			</div>
		</div>
	</header>
	@if($alert)
		<div class="container">
		    <div class="alert alert-success">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>¡Atención!</strong> La noticia se ha publicado/actualizado sin problemas.
		    </div>
		</div>
	@endif
	<main class="container">
		<div class="row">
			<a id="volver" href="/admin/posts" class="btn btn-lg btn-primary"><strong>Volver</strong></a>
		    <div class="col-md-12">
		        <form novalidate id="newPost" action="{{(($post)? '/admin/posts/new/'.$post->id : '/admin/posts/new')}}" method="POST" class="row">
		        	@csrf
		        	@if($post)
		        		<input name="_method" type="hidden" value="PUT">
		        	@endif
		            <div class="col-md-6 col-md-offset-3 form-group text-center">
		                <h2><label for="titulo" class="text-info">Título</label></h2>
		                <input type="text" name="titulo" class="form-control input-lg" placeholder="Escribe el título de la noticia" value="{{(($post)? $post->titulo : '')}}" required>
		                <small class="form-text text-muted">El título es importante ya que será mostrado con frecuencia.</small>
		            </div>
		            <div class="col-md-8 col-md-offset-2 form-group text-center">
		                <h2><label for="descripcion" class="text-info">Descripción</label></h2>
		                <textarea name="descripcion" class="form-control" rows="5" maxlength="240" required>{{(($post)? $post->descripcion : '')}}</textarea>
		                <small class="form-text text-muted">Descripción corta que explique de que habla esta noticia.</small>
		            </div>
		            <div class="col-md-4 col-md-offset-2 form-group">
		            	<div class="row">
			                <h2 class="text-center"><label for="nivel" class="text-info">Nivel</label></h2>
			                <h5 class="col-md-4"><input required type="checkbox" name="nivel[]" value="1" {{($post && in_array(1, $post->nivelesID()))? 'checked' : ''}}>Publico</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="2" {{($post && in_array(2, $post->nivelesID()))? 'checked' : ''}}>Centro</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="3" {{($post && in_array(3, $post->nivelesID()))? 'checked' : ''}}>Inici</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="4" {{($post && in_array(4, $post->nivelesID()))? 'checked' : ''}}>Unió 1</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="5" {{($post && in_array(5, $post->nivelesID()))? 'checked' : ''}}>Unió 2</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="6" {{($post && in_array(6, $post->nivelesID()))? 'checked' : ''}}>Compromis</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="7" {{($post && in_array(7, $post->nivelesID()))? 'checked' : ''}}>Decisió</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="8" {{($post && in_array(8, $post->nivelesID()))? 'checked' : ''}}>Acció 1</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="nivel[]" value="9" {{($post && in_array(9, $post->nivelesID()))? 'checked' : ''}}>Acció 2</h5>
			                <small class="form-text text-muted col-md-12">Nivel al que pertenece esta noticia, solo los usuarios del nivel elegido podran verla.</small>
		                </div>
		            </div>
		            <div class="col-md-4 form-group text-center">
		            	<div class="row">
			                <h2 class="text-center"><label for="categoria" class="text-info">Categoria</label></h2>
			                <h5 class="col-md-4"><input required type="checkbox" name="categoria[]" value="1" {{($post && in_array(1, $post->categoriasID()))? 'checked' : ''}}>Banner</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="categoria[]" value="2" {{($post && in_array(2, $post->categoriasID()))? 'checked' : ''}}>Reunión</h5>
			                <h5 class="col-md-4"><input type="checkbox" name="categoria[]" value="3" {{($post && in_array(3, $post->categoriasID()))? 'checked' : ''}}>Acampada</h5>
			                <h5 class="col-md-6"><input type="checkbox" name="categoria[]" value="4" {{($post && in_array(4, $post->categoriasID()))? 'checked' : ''}}>Campamento</h5>
			                <h5 class="col-md-6"><input type="checkbox" name="categoria[]" value="5" {{($post && in_array(5, $post->categoriasID()))? 'checked' : ''}}>Noticia</h5>
			                <small class="form-text text-muted col-md-12">Categoria a la que pertenece esta noticia.</small>
		                </div>
		            </div>
		            <div class="col-md-6 col-md-offset-3 form-group text-center">
		            	<h2><label for="comentarios" class="text-info">Comentarios</label></h2>
		            	<input type="checkbox" name="comentarios" class="form-control" {{(($post && $post->comentarios)? 'checked' : '')}}>
		            	<small class="form-text text-muted">Marcar para permitir comentarios en esta noticia.</small>
		            </div>
		            <div class="col-md-12">
		            	<h2 class="text-center"><label for="editordata" class="text-info">Contenido</label></h2>
		            	<textarea id="summernote" name="editordata" required>{{(($post)? $post->contenido : '')}}</textarea>
		            </div>
		            <div class="col-md-4 col-md-offset-4">
		                <button type="submit" class="btn btn-lg btn-success btn-block"><strong>Publicar</strong></button>
		                <a href="/admin/posts" class="btn btn-lg btn-block btn-primary"><strong>Volver</strong></a>
		            </div>
		        </form>
		    </div>
		</div>
	</main>
@stop
