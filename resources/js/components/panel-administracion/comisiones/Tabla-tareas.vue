<template>
    <div>
        <button type="button" class="btn btn-success col-md-6 mt-4 mb-4 rounded" data-toggle="modal" data-target="#formularioTarea" @click="vaciarTarea">Añadir tarea</button>

        <!-- The Modal -->
        <div class="modal" id="formularioTarea">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 v-if="tareaManage.id==''">Nueva Tarea</h4>
                        <h4 v-else>Editar tarea</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="new-prod">
                            <fieldset>
                                <div class="form-group">
                                    <label for="nombreTarea">Nombre Tarea:</label>
                                    <input name="nombreTarea" type="text" class="form-control" id="nombreTarea" v-model="tareaManage.nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input name="descripcion" type="text" class="form-control" id="descripcion" v-model="tareaManage.descripcion" >
                                </div>
                                <div class="form-group">
                                    <label for="fechaVencimiento">Fecha de vencimiento:</label>
                                    <input name="fechaVencimiento" type="date" class="form-control" id="fechaVencimiento" v-model="tareaManage.vencimiento" required>
                                </div>
                                <div class="form-group">
                                    <input hidden name="idComision" type="number" class="form-control" id="idComision" v-model="tareaManage.comision_id">
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button v-if="tareaManage.id==''"  type="submit" class="btn btn-success rounded" data-dismiss="modal" @click="addTarea">Añadir</button>
                        <button v-else  type="submit" class="btn btn-info rounded" data-dismiss="modal" @click="editarTarea">Guardar</button>
                        <button type="reset" class="btn btn-warning rounded" @click.prevent="manageReset">Reset</button>
                        <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <th>Nombre de la tares</th>
            <th>Descripción</th>
            <th>Fecha de vencimiento</th>
            <th>Estado</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            <tr v-for="tarea in tareas" :key="tarea.id">
                <td>{{tarea.nombre}}</td>
                <td>{{tarea.descripcion}}</td>
                <td>{{tarea.vencimiento}}</td>
                <td v-if="tarea.completada==false"><span class="btn btn-warning">Pendiente</span></td>
                <td v-else><span class="btn btn-success">Completada</span></td>
                <td>
                    <button v-if="tarea.completada==false" type="button" title="Marcar como resuelta" class="btn btn-success btn-sm rounded" @click="manageEstado(tarea.id)">
                        <i class="fas fa-clipboard-check"></i>
                    </button>
                    <button v-else type="button" title="Marcar como pendiente" class="btn btn-warning btn-sm rounded" @click="manageEstado(tarea.id)">
                        <i class="fas fa-clipboard"></i>
                    </button>
                    <button type="button" title="Editar tarea" class="btn btn-info btn-sm rounded" data-toggle="modal" data-target="#formularioTarea" @click="cargarTarea(tarea.id)">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" title="Eliminar tarea" class="btn btn-danger btn-sm rounded" @click="deleteTarea(tarea.id)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Tabla-tareas",
        props:['id'],
        data(){
            return {
                tareas: [],
                dialog: false,
                tareaManage:{
                    id:'',
                    nombre:'',
                    descripcion:'',
                    vencimiento:'',
                    comision_id:this.id,
                }
            }
        },
        methods:{
            cargarTareas(id){
                axios.get('/getTareas/'+id).then((response)=>{this.tareas=response.data}).catch(error=>alert("Error al cargar tareas"+error));
            },
            cargarTarea(id){
                axios.get('/getTarea/'+id).then((response)=>{this.tareaManage=response.data}).catch(error=>alert("Error al cargar la tarea"+error));
            },
            addTarea(){
                axios.post('/postTarea',this.tareaManage).
                then(response=>this.cargarTareas(this.id))

                    .catch(error=>alert("No se ha podido añadir la tarea "+error));
            },
            editarTarea(){
                axios.put('/putTarea',this.tareaManage).then(response=>this.cargarTareas(this.id))
                    .catch(error=>alert("No se ha podido editar la tarea "+error));
            },
            manageReset(){
                if(this.tareaManage.id!=''){
                    this.cargarTarea(this.tareaManage.id);
                }else{
                    this.vaciarTarea();
                }
            },
            vaciarTarea(){
                this.tareaManage.id='';
                this.tareaManage.nombre='';
                this.tareaManage.descripcion='';
                this.tareaManage.vencimiento='';
            },
            deleteTarea(id){
                axios.delete('/deleteTarea/'+id).then(response=>this.cargarTareas(this.id))
                    .catch(error=>alert("Error al eliminar la tarea"+error));
            },

            manageEstado(id){
                axios.put('/putEstado/'+id).then(response=>this.cargarTareas(this.id))
                    .catch(error=>alert("No se ha podido modificar el estado de la tarea "+error));
            }
        },
        created(){
            this.cargarTareas(this.id);
        }

    }
</script>

<style scoped>

</style>
