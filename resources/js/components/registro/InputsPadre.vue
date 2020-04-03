<template>
  <div class="form-group">
    <div class="form-group">
      <label class="col-form-label" for="domicilio">Domicilio:</label>
      <input
        type="text"
        name="domicilio"
        id="domicilio"
        required
        maxlength="100"
        v-model="usuarios[0].domicilio"
      >
    </div>
    <div class="form-group">
      <label class="col-form-label" for="email">Email:</label>
      <input
        type="email"
        name="email"
        id="email"
        required
        maxlength="250"
        v-model="usuarios[0].email"
      >
    </div>

    <div class="form-group">
      <label class="col-form-label" for="telefono">Teléfono:</label>
      <input
        type="number"
        name="telefono"
        id="telefono"
        required
        pattern="[0-9]{9}"
        v-model="usuarios[0].telefono"
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "InputsPadre",
  props: ["user"]
};
</script>

<style>
</style>