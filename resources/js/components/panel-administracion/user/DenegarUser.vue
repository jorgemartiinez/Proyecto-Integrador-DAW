<template>
    <div>

        <div class="panel-body" v-if="this.denegar">
            <textarea  id="mensajeRechazado" name="mensajeRechazado" placeholder="Introduce el mensaje de rechazo..."></textarea>
        </div>

        <div class="panel-body">
            <button type="button" title="Denegar Usuario" @click="denegarUsuario" class="btn btn-danger rounded">Denegar Usuario</button>
        </div>

        <div class="panel-body" v-if="this.denegar">
            <button class="btn btn-info rounded" @click.prevent="cancelarRechazo">Cancelar</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DenegarUser",
        data(){
            return{
                denegar: false
            }
        },
        methods:{

            cancelarRechazo(){
                this.denegar = false;
            },

            denegarUsuario(){

                if(this.denegar!==true) {
                    alert("Procedemos al proceso de denegar usuario. Introduce el mensaje de porqué vas a rechazarlo. Se enviará un correo al usuario informándole del porqué.");
                    this.denegar = true;
                    return this.denegar;
                }

                this.$emit('denegarUsuario', document.getElementById('mensajeRechazado').value);
            }
        }
    }
</script>

<style scoped>
button.btn-success{
    width: 20px;
}

    textarea{
        resize: none;
    }
</style>