<template>
    <div class="container">
        <h1>Mostrando detalles del evento "{{evento.nombre}} {{evento.fecha}}"</h1>
        
                <div class="row">
                    <div class="col-6 text-right">
                        <span class="negrita">Niveles:</span>
                    </div>
                    <div class="col-6">
                        <span>
                            <div v-for="nivel in niveles">
                                {{nivel}}     
                            </div>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-right">
                        <span class="negrita">Fecha: </span>
                    </div>
                    <div class="col-6">
                        <span>{{evento.fecha}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-right">
                        <span class="negrita">Descripción:</span>
                    </div>
                    <div class="col-6">
                        <p>{{evento.descripcion}}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <button v-if="modificar ==false" class="btn btn-success rounded" type="button" title="Editar Evento" @click="mostrarFormulario">Modificar</button>
                        <button v-else class="btn btn-info rounded" type="button" title="Editar Evento" @click="mostrarFormulario">Cancelar</button>

                        <button class="btn btn-danger rounded" type="button" title="Eliminar Evento" @click="eliminarEvento" :disabled="modificar">Eliminar</button>
                    </div>
                </div> 
        <eventos-formulario v-if="modificar == true" :evento="this.evento"/>
    </div>
</template>

<script>

    import FormButtonAction from './../FormButtonAction';
    import EventosFormulario from './EventosFormulario.vue';

    export default {

        name: "eventos-lista-detalles",

        components: {
            FormButtonAction,
            EventosFormulario,
        },

        props: ['id'],

        data() {

            return {
                evento: {},
                modificar: false,
                niveles: [],
            }
        },

        created() {

            this.recibirEventos();
            this.nombreNivel(this.id);
    
        },

        methods: {

            recibirEventos() {

                axios.get('/getEvents/' + this.id).then((response) => {
                    this.cargaDatos(response.data);
                }).catch((response) => {
                    console.log(response);
                });
            },

            cargaDatos(evento){

                this.evento = {

                    id:evento.id,
                    fecha:evento.fecha,
                    nombre:evento.nombre,
                    descripcion:evento.descripcion,
                    created_at:evento.created_at,
                    updated_at:evento.updated_at,
                }; 
            },

            /*Metodo para mostrar u ocultar el formulario*/
            mostrarFormulario() {

                if(this.modificar){
                    this.modificar = false;
                }else {
                    this.modificar = true;
                }

            },
            /*Metodo para elimiar el evento*/
            eliminarEvento(){

                if (confirm('Estas seguro de eliminar el evento: '+this.evento.nombre)) {
                    axios.delete('/deleteEvent/'+ this.evento.id)
                    .then((response) => { 
                        alert('Se ha eliminado el evento: ' + this.evento.nombre);
                        this.evento = {};
                        this.eventoCopia = {};
                        this.eventoModificado = {};
                        this.$router.push({path:'/admin/eventos/'});
                    })
                } 
            },

            nombreNivel(id){

            axios.get('/getNivelNombres/'+id)
                .then((response)=> {
                    this.niveles = response.data; 
                }).catch((response) => {
                    console.log('No se ha podido conseguir el nombre del nivel')
                });
        },
        } 
    }

</script>

<style>
    
    .negrita {

        font-weight: bold;
        color: #000;

    }

</style>
