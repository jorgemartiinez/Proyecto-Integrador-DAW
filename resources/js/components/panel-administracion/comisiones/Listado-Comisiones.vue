<template>
    <div class="container">
        <main class="row mt-4">
            <section v-for="comision in comisionesLista" :key="comision.id" class="col-6">
                <header class="banner-comision col-12 text-center bg-comision " >
                    <h3 ><router-link :to="{ path: '/admin/comisiones/show/'+comision.id}">{{comision.nombre}}</router-link></h3>
                </header>
                <p>
                    {{comision.descripcion}}
                </p>
            </section>
        </main>

    </div>
</template>

<script>

    export default {
        name: "Listado-Comisiones",
        data(){
          return {
              comisionesLista:[]
          }
        },
        methods:{
            getComisiones(){
                axios.get('/getComisiones').then((response)=>{this.comisionesLista=response.data}).catch(error=>alert("Error al cargar comisiones"+error));
            }
        },
        created(){
            this.getComisiones();
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
</style>
