<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'IndexController@getIndex');

Auth::routes();

Route::post('/register', 'Auth\RegisterController@createPadre');

/*Ruta que devuelve la vista sobre nosotros*/
Route::get('/sobre-nosotros', 'IndexController@sobreNosotros');

//Contacto y mail
Route::get('/contacto', 'IndexController@getContacto');
Route::post('/contacto', 'AdminController@sendContacto');

/*Ruta single post*/
Route::get('/post/show/{id}', 'PostsController@show');

Route::group(['middleware' => 'auth'], function () {

    /*Ruta para ver las noticias de mas de nivel 1*/
    Route::get('/post', 'PostsController@getIndex');

    Route::get('/registrar-hijo', 'IndexController@getRegistroHijo')->middleware('role:Admin:Monitor');
    Route::post('/registrar-hijo', 'AdminController@createHijo')->middleware('role:Admin:Monitor');


    Route::post('/post/sendComentario', ['as' => 'post.sendComentario', 'uses' => 'PostsController@sendComentario']);

    /*Ruta para poder visualizar el contenido de mi espacio personal*/
    Route::get('/espacio-personal', 'IndexController@getEspacioPersonal');
    Route::post('/espacio-personal/changeAvatar', 'IndexController@changeAvatar');
    /*Ruta para desloguearse*/
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/home', 'IndexController@getIndex')->name('home');

    Route::get('/getDoc/{nombre}', 'AdminController@getDoc')->middleware('role:Admin:Monitor');

    /*Rutas Panel administrador*/
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@getIndex')->middleware('role:Admin:Monitor');
        Route::get('/posts/new', 'PostsController@getPostsNew')->middleware('role:Admin:Monitor');
        Route::post('/posts/new', 'PostsController@createPostsNew')->middleware('role:Admin:Monitor');
        Route::get('/posts/new/{id}', 'PostsController@getPostsUpdate')->middleware('role:Admin:Monitor');
        Route::put('/posts/new/{id}', 'PostsController@updatePost')->middleware('role:Admin:Monitor');
        Route::post('/posts/uploadImage', 'PostsController@uploadImage')->middleware('role:Admin:Monitor');
        Route::fallback('AdminController@notFound')->middleware('role:Admin:Monitor');
    });

    /*Rutas VUE AXIOS*/
    //Rutas con relación a usuarios    
    Route::get('/getUser/{id}', 'AdminController@getUsuario')->middleware('role:Admin:Monitor');
    Route::get('/getUsers', 'AdminController@getUsuarios')->middleware('role:Admin:Monitor');
    Route::get('/getUsersPeticion', 'AdminController@getUsuariosPeticion')->middleware('role:Admin:Monitor');
    Route::put('/putUser', 'AdminController@putUser')->middleware('role:Admin:Monitor');

    Route::put('/putUser', 'AdminController@putUser')->middleware('role:Admin:Monitor');
    Route::get('/getDocsUser/{id}', 'AdminController@getDocsUser')->middleware('role:Admin:Monitor');


    //Rutas con relación a posts
    Route::get('/getPosts', 'PostsController@getPosts')->middleware('role:Admin:Monitor');
    Route::get('/getPost/{id}', 'PostsController@getPost')->middleware('role:Admin:Monitor');
    Route::delete('/deletePost/{id}', 'PostsController@deletePost')->middleware('role:Admin:Monitor');


    //Rutas con relación a eventos
    Route::get('/getEvents','EventosController@getEventos')->middleware('role:Admin:Monitor');
    Route::get('/getEvents/{id}','EventosController@getEvento')->middleware('role:Admin:Monitor');
    Route::put('/putEvent','EventosController@putEvento')->middleware('role:Admin:Monitor');
    Route::delete('/deleteEvent/{id}','EventosController@deleteEvento')->middleware('role:Admin:Monitor');
    Route::post('/postEvent','EventosController@postEvento')->middleware('role:Admin:Monitor');
    Route::get('/getCategoria/{id}','PostsController@getCategoria')->middleware('role:Admin:Monitor');
    Route::get('/getUsersEvent/{id}','EventosController@getUsuarios')->middleware('role:Admin:Monitor');
    Route::put('/putAssistanceUserEvent','EventosController@putAsistenciaEvento')->middleware('role:Admin:Monitor');

    //Rutas con relacion a niveles
    Route::get('/getNivel/{id}','NivelController@getNivel')->middleware('role:Admin:Monitor');
    Route::get('/getNivelNombres/{id}','NivelController@getNivelNombres')->middleware('role:Admin:Monitor');
    Route::get('/getNiveles','NivelController@getNiveles')->middleware('role:Admin:Monitor');
    Route::get('/getNivelesEvento/{id}','NivelController@getNivelesEvento')->middleware('role:Admin:Monitor');

    /*Rutas comisiones*/
    Route::get('/getComisiones', 'ComisionController@getComisiones')->middleware('role:Admin:Monitor');
    Route::get('/getComision/{id}','ComisionController@getComision')->middleware('role:Admin:Monitor');
    Route::get('/getMonitores/{id}','ComisionController@getMonitoresComision')->middleware('role:Admin:Monitor');
    Route::get('/getMonitor/{id}', 'ComisionController@getMonitor')->middleware('role:Admin:Monitor');
    /*Rutas Tareas, se podria considerar que en su gran mayoria va dentro de comisiones */
    Route::get('/getTareas/{id}','ComisionController@getTareas')->middleware('role:Admin:Monitor');
    Route::get('/getTarea/{id}','ComisionController@getTarea')->middleware('role:Admin:Monitor');
    Route::post('/postTarea','ComisionController@postTarea')->middleware('role:Admin:Monitor');
    Route::put('/putTarea','ComisionController@putTarea')->middleware('role:Admin:Monitor');
    Route::put('/putEstado/{id}','ComisionController@putEstado')->middleware('role:Admin:Monitor');
    Route::delete('/deleteTarea/{id}','ComisionController@deleteTarea')->middleware('role:Admin:Monitor');
});

