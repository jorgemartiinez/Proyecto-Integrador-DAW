<template>
		
		<tr>

			<td>{{evento.nombre}}</td>
			<td>
				<div v-for="nivel in evento.niveles">
                    {{nivel.nombre}}
                </div>
            </td>
			<td>{{evento.fecha}}</td>
			<td>
				
				<form-button-action title="Mostrar detalles del evento" class="btn btn-info rounded" icon="fa fa-eye" @click="detalles(evento)"></form-button-action>

				<form-button-action title="Pasar lista evento" class="btn btn-warning rounded" icon="fas fa-user-check" @click="asistencia(evento)"></form-button-action>

				<form-button-action title="Borrar evento" class="btn btn-danger rounded" icon="fa fa-trash" @click="borrar"></form-button-action>

			</td>

		</tr>

</template>

<script>
	
import FormButtonAction from './../FormButtonAction';

export default {

	name: 'eventos-lista-linea',

	props: ['evento'],

	components: {FormButtonAction},

	methods: {

		asistencia(evento){

			this.$router.push({path:'/admin/eventos/asistencia/'+evento.id});
			
		},

		detalles(evento){

			this.$router.push({path:'/admin/eventos/detalles/'+evento.id});
			
		},

		borrar(){

            this.$emit('borrarEvento', this.evento);

        },

	}
}

</script>