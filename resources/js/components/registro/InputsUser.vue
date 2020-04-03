<template>
  <div class="form-group">
    <div class="form-group">
      <label class="col-form-label" for="username">Nombre de usuario</label>
      <input type="text" name="username" id="username" maxlength="50" v-model="user.username">
    </div>
    <div class="form-group">
      <label class="col-form-label" for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" maxlength="50" v-model="user.nombre">
    </div>

    <div class="form-group">
      <label class="col-form-label" for="ape1">Apellido 1</label>
      <input type="text" name="ape1" id="ape1" maxlength="49" v-model="user.apellido1">
    </div>
    <div class="form-group">
      <label class="col-form-label" for="ape2">Apellido 2</label>
      <input type="text" name="ape2" id="ape2" maxlength="49" v-model="user.apellido2">
    </div>

    <div class="form-group">
      <label class="col-form-label" for="dni">DNI</label>
      <input type="text" name="dni" id="dni" maxlength="50" v-model="user.dni">
    </div>

    <div class="form-group">
      <label class="col-form-label" for="fecha-nac">Fecha de Nacimiento</label>
      <input type="date" name="fecha-nac" id="fecha-nac" v-model="user.fec_nac">
    </div>
  </div>
</template>

<script>
export default {
  name: "InputsUser",
  props: ["user"]
};
</script>

<style>
</style>
