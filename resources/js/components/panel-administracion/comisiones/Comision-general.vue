<template>
    <div class="container">
        <div class="row">
            <header class="banner-comision col-12 text-center bg-comision" >
                <h1 class="mt-5">{{this.comision.nombre}}</h1>
            </header>
        </div>
        <main class="row mt-4">
            <section class="col-6">
                <p>{{comision.descripcion}}
                </p>
            </section>
            <section class="col-6">
                <div>
                    <h3 class="mt-2">Miembros de esta comision:</h3>
                    <miembro-comision v-for="monitor in monitores" :key="id" :id="monitor.id"></miembro-comision>
                </div>
            </section>
            <section class="col-12 ">
                <tabla-tareas :id="this.id"></tabla-tareas>
            </section>
        </main>

    </div>
</template>

<script>
    import MiembroComision from './Miembro-comision';
    import TablaTareas from './Tabla-tareas';

    export default {
        name: "Comision-general",
        props:['id'],

        data(){
            return {
                comision:{},
                monitores:{}
            }
        },
        
        components: {
            MiembroComision,
            TablaTareas
        },
        methods:{
            cargarComision(){
                axios.get('/getComision/'+this.id).then((response)=>{this.comision=response.data}).catch(error=>alert("Error al cargar la comision"+error));
            },
            cargarMonitores(){
                axios.get('/getMonitores/'+this.id).then((response)=>{this.monitores=response.data}).catch(error=>alert("Error al cargar monitores"+error));
            },
            getDatosMonitor(id){

                axios.get('/getUser/'+id).then((response)=>{console.log(response.data)})
            }

        },
        created(){
            this.cargarComision();
            this.cargarMonitores();
        }
    }
</script>

<style scoped>

.bg-comision{
    background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/intermediary/f/aeaef47d-b656-4b94-bd6a-9cac21f641f0/d6dhx8w-b9539e1a-a245-4fac-816e-8a9b1f7be1c8.png/v1/fill/w_1024,h_683,strp/its_k_by_inightfaller_d6dhx8w-fullview.png") !important;
    background-size: cover!important;
    background-position: center center!important;
    height: 30vh;
}
.bg-comision h1{
    color: white;
    }
</style>
