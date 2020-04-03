<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{index}}</h3>
        </div>
        <div class="panel-body">
            {{post}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostShowField",
        props: ['post', 'index'],
    }
</script>

<style scoped>

</style>