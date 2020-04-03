<template>
  <div>
    <div v-if="!monitor" class="form-group">
      <label for="curso-escolar">Curso Escolar:</label>
      <select class="form-control" id="curso-escolar" v-model="user.cursoEscolar">
        <option value="Quinto Primaria">Quinto Primaria</option>
        <option value="Sexto Primaria">Sexto Primaria</option>
        <option value="Primero ESO">Primero ESO</option>
        <option value="Segundo ESO">Segundo ESO</option>
        <option value="Tercero ESO">Tercero ESO</option>
        <option value="Cuarto ESO">Cuarto ESO</option>
        <option value="Primero Bachiller">Primero Bachiller</option>
        <option value="Segundo Bachiller">Segundo Bachiller</option>
      </select>
    </div>
    <div class="form-group">
      <label for="datos-medicos">Sube aquí los datos del calendario de vacunas (PDF).</label>
      <input type="file" class="form-control-file" accept="application/pdf">
    </div>
    <div class="form-group">
      <label for="datos-medicos">Sube aquí la fotocopia del SIP.</label>
      <input type="file" class="form-control-file" accept="application/pdf">
    </div>
    <div class="form-group">
      <label for="datos-medicos">Sube aquí el documento de</label>
      <input type="file" class="form-control-file" accept="application/pdf">
    </div>
  </div>
</template>

<script>
export default {
  name: "InputsMiembro",
  props: ["monitor", "user"]
};
</script>

<style scoped>
</style>