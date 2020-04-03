<template>
	<div class="container">
		<h1 class="text-center">Lista de Noticias</h1>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Niveles</th>
					<th scope="col">Categorias</th>
					<th scope="col">Autor</th>
					<th scope="col">Fecha</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<posts-lista-linea v-for="(post, index) in this.arrayPosts" :key="index" :post="post" @borrar="borrarPost" ></posts-lista-linea>
			</tbody>
		</table>
	</div>
</template>

<script>
	
	import PostsListaLinea from './PostsListaLinea.vue'

	export default {
		name: 'posts-lista',
		components: {
			PostsListaLinea,
		},
		watch: {
			$route(to,from){
				this.recibirPosts();
			}
		},
		methods: {
			recibirPosts(){
                axios.get('/getPosts').then((response)=>{
                    this.arrayPosts = response.data;
                }).catch((response)=> {
                    console.log(response);
                });
			},
			borrarPost(post){
                if (confirm("¿Borrar el Post \""+post.titulo+"\"?")) {
                    axios.delete('/deletePost/'+post.id)
                        .then((response)=> {
                            alert(response.data);
                            this.arrayPosts = this.arrayPosts.filter((noticia)=>noticia.id != post.id)
                        }).catch((resonse) => {
                        console.log('No se ha podido borrar el post')
                    });
                }
            }
		},
		created() {
			this.recibirPosts();
		},
		data () {
			return {
				arrayPosts: []
			}
		}
	};

</script>