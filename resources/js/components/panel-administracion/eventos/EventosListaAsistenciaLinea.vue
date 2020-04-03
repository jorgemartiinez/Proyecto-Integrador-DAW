<template>
	
	<tr>

		<td>{{usuario.nombre}}</td>
		<td>{{usuario.apellidos}}</td>
		<td>
			<label class="switch">
				<input v-if="usuario.asistencia == true" @click="asistencia" type="checkbox" checked>
  				<input v-else @click="asistencia" type="checkbox">
  				<span class="slider round"></span>

			</label>
			
		</td>

	</tr>

</template>

<script>
	
	export default {

		name: "evento-lista-asistencia-linea",
		props: ['usuario','evento'],
		methods: {
			asistencia(){

				this.usuario.id_nivel = this.evento;
				
				axios.put('/putAssistanceUserEvent', this.usuario)
				.then((response) => {
					console.log('Asistencia modificada');
				})
				.catch((response)=> {
					alert('No se ha podido modificar la asistencia del usuario');
				})
			},
		}
	}

</script>