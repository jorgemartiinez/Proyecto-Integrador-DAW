<template>
    <div class="row">

        <div class="col-6 text-right" v-if="index!='updated_at'">
            <span class="negrita">{{index}}</span>
        </div>

        <div class="col-6">

            <div v-if="index=='estado_registro'">

                <span v-if="user==0">
                    No está validado</span>

                <span v-else>
                    Si está validado</span>

            </div>

            <div v-else-if="index!='estado_registro'&&index!='updated_at'">

                <span>{{user}}</span>

            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "UserShowField",
        props: ['user', 'index'],
    }
</script>

<style scoped>

    .negrita {

        font-weight: bold;
        color: #000;

    }

</style>