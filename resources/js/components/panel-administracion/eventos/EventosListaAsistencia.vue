<template>
	<div class="container">
	<div class="row">
	<div class="col-8 offset-2" >
		<h1>Asistencia</h1>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Apellidos</th>
					<th scope="col">Acción</th>
				</tr>
			</thead>
			<tbody>
				<eventos-lista-asistencia-linea v-for="(usuario, index) in this.usuarios" :evento="id" :usuario="usuario" :key="index"/>
			</tbody>
		</table>
	</div>
	</div>
	</div>

</template>

<script>
	
	import EventosListaAsistenciaLinea from './EventosListaAsistenciaLinea.vue';

	export default {

		name: "eventos-lista-asistencia",
		props: ['id'],
		components: {

			EventosListaAsistenciaLinea,
		},

		data() {

			return {

				usuarios: [],
			}
		},

		created() {

			this.cargarUsuarios();
		},

		methods: {

			cargarUsuarios(){

				axios.get('/getUsersEvent/'+this.id)
				.then((response)=>{
					this.usuarios = response.data;
				}).catch((response)=>{
					console.log('No se han podido conseguir los usuarios');
				});
			},
		}
	}
	
</script>