<template>
    <figure class="col-4 text-center mt-2">
        <h4>{{monitor.rango_monitor}}</h4>
        <img src="https://banner2.kisspng.com/20180616/sxr/kisspng-avatar-computer-icons-avatar-icon-5b254abb7cf344.7556131215291706195118.jpg" alt="user1" height="50px" width="50px">
        <p>{{usuario.nombre}}</p>
    </figure>
</template>

<script>
    export default {
        name: "Miembro-comision",
        props:['id'],
        data(){
            return {
                monitor:{},
                usuario: {}
            }
        },
        methods:{
            cargarDatosMonitor(){
                axios.get('/getMonitor/'+this.id).then((response)=>{this.monitor=response.data}).catch(error=>alert("Error al cargar los datos del monitor"+error));
            },
            cargarDatosUsuario(){
                axios.get('/getUser/'+this.id).then((response)=>{this.usuario=response.data}).catch(error=>alert("Error al cargar los datos del usuario"+error));
            }
        },
        created(){
            this.cargarDatosMonitor();
            this.cargarDatosUsuario();
        }
    }
</script>

<style scoped>

</style>
