<template>
  <div class="container">
    <h1 class="text-center" v-if="this.peticiones">Peticiones pendientes. Usuarios no validados</h1>
    <h1 class="text-center" v-else>Usuarios Registrados</h1>
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellidos</th>
          <th scope="col">DNI</th>
          <th scope="col">Fecha Nacimiento</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <fila-user v-for="(usuario, index) in this.arrayUsuarios" :key="index" :usuario="usuario"></fila-user>
      </tbody>
    </table>
  </div>
</template>

<script>
import FilaUser from "./FilaUser";

export default {
  name: "TablaPeticiones",
  data() {
    return {
      arrayUsuarios: [],
      peticiones: false
    };
  },
  watch: {
    $route(to, from) {
      this.recibirUsuarios();
    }
  },
  components: {
    FilaUser
  },
  created() {
    this.recibirUsuarios();
  },
  methods: {
    recibirUsuarios() {
      if (window.location.pathname == "/admin/users/peticiones") {
        this.peticiones = true;
        axios
          .get("/getUsersPeticion")
          .then(response => {
            this.arrayUsuarios = response.data;
          })
          .catch(response => {
            console.log(response);
          });
      } else {
        this.peticiones = false;
        axios
          .get("/getUsers")
          .then(response => {
            this.arrayUsuarios = response.data;
          })
          .catch(response => {
            console.log(response);
          });
      }
    }
  }
};
</script>

<style scoped>
</style>
