<template>
    <button
            @click="clicked"
            :disabled="disabled"
            type="button"
            :title="title"
            class="btn btn-default btn-sm">
        <i :class="icon"> </i>
    </button>
</template>

<script>
    export default {
        name: "FormButtonAction",
        props: ['title', 'disabled', 'icon'],
        methods: {
            clicked() {
                this.$emit('click');
            }
        }
    };
</script>

<style scoped>

</style>