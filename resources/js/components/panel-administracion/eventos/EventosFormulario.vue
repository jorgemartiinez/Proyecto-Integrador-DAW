<template>

    <div class="container">
        <div class="row">
            <div class="col-12">

                <h1 v-if="this.evento == undefined">Añadir evento</h1>

                <form id="put-event" @submit.prevent="botonAccion" @reset.prevent="botonReset">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" id="nombre" name="nombre" class="form-control" v-validate="'required|max:60'" v-model="eventoMod.nombre">
                        <p class="text-danger" v-if="errors.has('nombre')">{{ errors.first('nombre') }}</p>

                    </div>

                    <div class="form-group">
                        <label>Nivel: </label>
                        <div v-for="nivel in niveles" :key="nivel.id" >
                            <input type="checkbox" id="nivel.id" name="nivel" :value="nivel.id" v-validate="'required'" @change="cambioNivel" v-model="eventoMod.nivelesEvento">
                            <label>{{nivel.nombre}}</label>
                        </div>
                        <p class="text-danger" v-if="errors.has('nivel')">{{ errors.first('nivel') }}</p>
                    </div>

                    <div class="form-group">
                        <label for="new-name">Fecha: </label>
                        <input type="date" class="form-control" name="fecha" v-validate="'required'" v-model="eventoMod.fecha">
                        <p class="text-danger" v-if="errors.has('fecha')">{{ errors.first('fecha') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="new-name">Descripción: </label>
                        <input type="text" class="form-control" name="descripcion" v-validate="'required|max:150'" v-model="eventoMod.descripcion">
                        <p class="text-danger" v-if="errors.has('descripcion')">{{ errors.first('descripcion') }}</p>
                    </div>
                    <button v-if="this.evento == undefined" type="submit" class="btn btn-success rounded">Añadir evento</button>
                    <button v-else type="submit" class="btn btn-success rounded">Modificar</button>
                    <button v-if="this.evento == undefined" type="reset" class="btn btn-info rounded">Cancelar</button>
                    <button v-else type="reset" class="btn btn-danger rounded">Reiniciar</button>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        name: 'eventos-formulario',
        props: ['evento'],

        data () {

            return {
                eventoMod : {},
                eventoCopy: {},
                niveles: [],
            }
        },

        created() {
            this.cargarNiveles();

            if(this.evento != undefined){
                this.cargarNivelesEvento();
            }
        },

        methods : {

            //al cambiar el input checked se valida que no sea público y centro a la vez
            cambioNivel(event){
                let check = event.target;
                if (check.value == 1 || check.value == 2) {
                    Array.from(document.getElementsByName('nivel')).forEach((input)=>input.checked = false); //se desactivan todos
                } else {
                    document.getElementsByName('nivel')[0].checked = false;
                    document.getElementsByName('nivel')[1].checked = false;
                }
                check.checked = true;
            },

            cargarEvento(evento,niveles) {

                if(this.evento != undefined){

                    this.eventoMod = {

                        id:evento.id,
                        fecha:evento.fecha,
                        nombre:evento.nombre,
                        descripcion:evento.descripcion,
                        created_at:evento.created_at,
                        updated_at:evento.updated_at,
                        nivelesEvento : niveles,
                    };

                    this.eventoCopy = {

                        id:evento.id,
                        fecha:evento.fecha,
                        nombre:evento.nombre,
                        descripcion:evento.descripcion,
                        created_at:evento.created_at,
                        updated_at:evento.updated_at,
                        nivelesEvento : niveles,

                    };

                }else{

                    this.eventoMod = {

                        fecha: "",
                        nombre: "",
                        descripcion: "",
                        nivelesEvento : [],
                    };

                }

    	},

            /*Este metodo sirve para restaurar los datos del evento en caso de equivocase o bien para volver al menu*/
            botonReset(){

                if(this.evento != undefined){

                    this.eventoMod = {
                        id:this.eventoCopy.id,
                        fecha:this.eventoCopy.fecha,
                        nombre:this.eventoCopy.nombre,
                        descripcion:this.eventoCopy.descripcion,
                        created_at:this.eventoCopy.created_at,
                        updated_at:this.eventoCopy.updated_at,
                        nivelesEvento : this.eventoCopy.nivelesEvento,
                    };

                }else {
                    this.listaEventos();
                }
            },

            /*Metodo que hace el cambio de detalles del evento o bien añadir un evento nuevo*/
            botonAccion(){

                this.$validator.validateAll()
                    .then(result=>
                    {
                        if(result){
                            if(this.evento != undefined){
                                axios.put('/putEvent', this.eventoMod)
                                    .then((response) => {
                                        alert('Ha sido modificado el evento: ' + this.eventoMod.nombre);
                                        this.listaEventos();
                                    }).catch((response)=>{
                                    console.log('El evento no ha podido ser actualizado');
                                })
                            }else {
                                axios.post('/postEvent',this.eventoMod)
                                    .then((response) => {
                                        alert('Se ha añadido el evento');
                                        this.listaEventos();
                                    })
                                    .catch((response) => {
                                        alert('No se ha podido añadir el evento');

                                    })
                            }
                        }
                    })
                    .catch(result=>console.error(result))
            },


            /*Este metodo carga los niveles, en los dos casos carga todos los niveles, salvo en el caso de modificar que se cargaran los niveles del evento en el array de nivelesEvento*/
            cargarNivelesEvento(){

                //Aqui se van a meter los niveles en el array de niveles del evento
                axios.get('/getNivelesEvento/'+this.evento.id)
                    .then((response) => {
                        this.cargarEvento(this.evento, response.data);//cargamos el evento

                    })
                    .catch((response) => {
                        alert('No se han podido cargar los niveles del Evento');
                    })

            },

            cargarNiveles(){

                axios.get('/getNiveles')
                    .then((response) => {
                        this.niveles = response.data; //cargamos los niveles
                        if(this.evento == undefined){this.cargarEvento();}
                    })
                    .catch((response) => {
                        alert('No se han podido cargar los niveles');
                    })
            },

            /*Este metodo tira devuelve al usuario a la lista de eventos*/
            listaEventos(){
                this.$router.push({path:'/admin/eventos/'});
            }
        }
    }

</script>
