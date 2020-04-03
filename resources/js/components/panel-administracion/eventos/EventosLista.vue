<template>
	<div class="container">
	<div class="row">
	<div class="col-12">
		<h1 class="text-center">Lista de Eventos</h1>

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Nivel</th>
					<th scope="col">Fecha</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<eventos-lista-linea v-for="(evento, index) in this.arrayEventos" :key="index" :evento="evento" @borrarEvento="eliminarEvento"></eventos-lista-linea>
			</tbody>
		</table>
	</div>
	</div>
</div>
</template>

<script>
	
	import EventosListaLinea from './EventosListaLinea.vue'

	export default {

		
		name: 'eventos-lista',

		components: {

			EventosListaLinea,
		},
		created() {

			this.recibirEventos();
		},

		data () {
			return {
				arrayEventos: [],
			}
		},

		watch: {

			$route(to,from){
				this.recibirEventos();
			}
		},

		methods: {

			recibirEventos(){
				
                    axios.get('/getEvents').then((response)=>{
                        this.arrayEventos = response.data;
                    }).catch((response)=> {
                        console.log(response);
                    });
			},

			eliminarEvento(evento){

                if (confirm('Estas seguro de eliminar el evento: '+evento.nombre)) {
                    axios.delete('/deleteEvent/'+ evento.id)
                    .then((response) => { 
                    	this.arrayEventos = this.arrayEventos.filter(event => event.id != evento.id);
                        alert('Se ha eliminado el evento: ' + evento.nombre); 
                    })
                } 
            },
		},
	}

</script>