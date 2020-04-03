<template>
    <tr>
        <td>{{usuario.id}}</td>
        <td>{{usuario.username}}</td>
        <td>{{usuario.nombre}}</td>
        <td>{{usuario.apellidos}}</td>
        <td>{{usuario.dni}}</td>
        <td>{{usuario.fec_nac}}</td>
        <td>
            <form-button-action class="btn btn-info rounded" title="Mostrar usuario" icon="fa fa-eye" @click="showUser(usuario)"></form-button-action>
        </td>
    </tr>
</template>

<script>
    import FormButtonAction from './../FormButtonAction';
    export default {
        name: "FilaUser",
        components:{
          FormButtonAction
        },
        props:['usuario', 'peticiones'],
        created(){

        },
        methods:{
            showUser(usuario){
                this.$router.push({path:'/admin/users/peticiones/'+usuario.id});
            }
        }
    };

</script>

<style scoped>

</style>