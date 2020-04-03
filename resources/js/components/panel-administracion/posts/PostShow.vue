<template>
    <div>
        <h1>Show Post {{this.id}}</h1>
        <div class="card text-center">
            <div class="panel-heading">
                <h3 class="panel-title">Titulo</h3>
            </div>
            <div class="panel-body">
                {{post.titulo}}
            </div>
            <div class="panel-heading">
                <h3 class="panel-title">Fecha</h3>
            </div>
            <div class="panel-body">
                {{post.fecha}}
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Escrito por:</h3>
            </div>
            <div class="panel-body">
                {{this.user.nombre}}
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Nivel</h3>
            </div>
            <div class="panel-body">
                {{this.nivel.nombre}}
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Descripcion</h3>
            </div>
            <div class="panel-body">
                {{post.descripcion}}
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Contenido</h3>
            </div>
            <div class="panel-body">
                {{post.contenido}}
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Comentarios</h3>
            </div>
            <div class="panel-body" v-if="post.comentarios">
                Si Acepta
            </div>
            <div class="panel-body" v-else>
                No Acepta
            </div>

            <div class="panel-body">
                <button type="button" title="Volver" @click="goBack" class="btn btn-primary">Volver</button>
            </div>

        </div>
    </div>
</template>

<script>
    import FormButtonAction from './../FormButtonAction';
    import PostShowField from "./PostShowField";

    export default {
        name: "PostShow",
        components: {PostShowField, FormButtonAction},
        props:['id'],
        data() {
            return {
                post: {},
                nivel:{},
                user:{}
            }
        },
        created(){
            this.getPost();
        },

        methods:{
            getPost(){
                axios.get('/getPost/'+this.id)
                    .then((response)=>{
                        this.post = response.data;
                        axios.get('/getNivel/'+this.post.id_nivel)
                            .then((response)=> {
                                this.nivel = response.data;
                            }).catch((response) => {
                            console.log('No se ha podido conseguir el nombre del nivel')
                        });
                        axios.get('/getUser/'+this.post.id_user)
                            .then((response)=> {
                                this.user = response.data;
                            }).catch((response) => {
                            console.log('No se ha podido conseguir el nombre del usuario')
                        })
                    })
            },

            goBack(){
                this.$router.push({ name: 'tabla.posts'})
            }
        }
    }
</script>

<style scoped>

</style>