<template>
    <form method="POST" @submit.prevent="validarContacto" accept-charset="UTF-8" id="form-contacto">
        <input name="_token" value="AzW6oWE2a5ZrwqUESp0Abx3a2Jl2ejPB9opcbjnN" type="hidden">
        <div class="form-group">
            <label for="nombre" class="text-info">Nombre:</label>
            <input placeholder="Introduce tu nombre" name="nombre" v-validate="'required|min:2|max:60'" id="nombre" class="form-control" type="text" v-model="contacto.nombre">
            <p class="text-danger" v-if="errors.has('nombre')">{{ errors.first('nombre') }}</p>
        </div>
        <div class="form-group">
            <label for="email" class="text-info">Email:</label>
            <input placeholder="Introduce tu correo electrónico" v-validate="'required|email'" name="email" id="email" class="form-control" type="text" v-model="contacto.email">
            <p class="text-danger" v-if="errors.has('email')">{{ errors.first('email') }}</p>
        </div>
        <div class="form-group">
            <label for="asunto" class="text-info">Asunto:</label>
            <input placeholder="Asunto" name="asunto" id="asunto" v-validate="'required|min:5|max:60'" class="form-control" type="text" v-model="contacto.asunto">
            <p class="text-danger" v-if="errors.has('asunto')">{{ errors.first('asunto') }}</p>
        </div>
        <div class="form-group"><label for="mensaje" class="text-info">Mensaje:</label>
            <textarea placeholder="Déjanos un mensaje" name="mensaje" cols="50" rows="10" id="mensaje" v-validate="'required|min:10|max:120'" class="form-control" v-model="contacto.mensaje">
            </textarea>
            <p class="text-danger" v-if="errors.has('mensaje')">{{ errors.first('mensaje') }}</p>
        </div>
        <div class="form-group">
            <button class="btn btn-success">Enviar</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "contacto",
        data(){
            return{
                contacto:{},
            }
        },
        created(){

        },
        components:{

            },
        methods:{

            validarContacto(){
                this.$validator.validateAll()
                    .then(result=>
                    {
                        if(result){
                            axios.post('/contacto', this.contacto)
                                .then((response)=>{
                                    document.getElementById('form-contacto').reset();
                                    $("#modalContacto").modal();
                                })
                        }
                    })
                    .catch(result=>console.error(result))
            }
        }
    }
</script>

<style scoped>

</style>