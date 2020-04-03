<template>
	<tr>
		<td>{{post.titulo}}</td>
		<td>{{nivel}}</td>
        <td>{{categoria}}</td>
		<td>{{autor.nombre}}</td>
		<td>{{post.fecha}}</td>
		<td>
			<form-button-action class="btn btn-info rounded" title="Mostrar detalles del post" icon="fa fa-eye" @click="mostrarPost()"></form-button-action>
			<form-button-action class="btn btn-warning rounded" title="Editar Noticia" icon="fa fa-pencil" @click="editarPost()"></form-button-action>
            <form-button-action class="btn btn-danger rounded" title="Borrar Noticia" icon="fa fa-trash" @click="$emit('borrar', post)"></form-button-action>
		</td>
	</tr>

</template>

<script>

    import FormButtonAction from './../FormButtonAction';

    export default {
        name: 'posts-lista-linea',
        props: ['post'],
        components: {FormButtonAction},
        methods: {
            getCategoria(categorias){
                categorias.forEach((cat, index)=> this.categoria += (index)? (", "+cat.nombre) : cat.nombre);
            },
            getNivel(niveles){
                niveles.forEach((niv, index)=> this.nivel += (index)? (", "+niv.nombre) : niv.nombre);
            },
            mostrarPost(){
                window.location = "/post/show/"+this.post.id;
                //this.$router.push({path:'/admin/posts/'+this.post.id});
            },
            editarPost(){
                window.location = "/admin/posts/new/"+this.post.id;
            },
        },
        data () {
            return {
                nivel:'',
                categoria:'',
                autor: this.post.usuario,
            }
        },
        created () {
            this.getNivel(this.post.niveles);
            this.getCategoria(this.post.categorias);
        }
    };

</script>