<template>
  <div class="container">
    <h1>Show User {{this.id}}</h1>

    <user-show-field v-for="(user,index) in this.usuario" :key="index" :index="index" :user="user"></user-show-field>

    <div id="documentos" class="mb-4">
      <h1>Documentos</h1>
      <div v-for="documento in documentos">
        <div class="col-12 mb-2">
          <h2>{{documento.tipo.nombre}}</h2>
          <button
            class="btn-info rounded"
            @click="getDoc(documento.ruta)"
          >Comprobar documento {{documento.tipo.nombre}}</button>
        </div>
      </div>
    </div>

    <div v-if="this.usuario.estado_registro!==1">
      <div class="panel-body">
        <button
          type="button"
          title="Aceptar Usuario"
          @click="aceptarUsuario"
          class="btn btn-success rounded"
        >Aceptar Usuario</button>
      </div>
      <div class="panel-body">
        <denegar-user @denegarUsuario="denegarUsuario"></denegar-user>
      </div>
    </div>

    <div class="panel-body">
      <br>
      <button type="button" title="Volver" @click="goBack" class="btn btn-primary rounded">Volver</button>
    </div>
  </div>
</template>

<script>
import UserShowField from "./UserShowField";
import FormButtonAction from "./../FormButtonAction";
import DenegarUser from "./DenegarUser";

export default {
  name: "showUser",
  components: { DenegarUser, UserShowField, FormButtonAction },
  props: ["id"],
  data() {
    return {
      usuario: {},
      documentos: []
    };
  },
  created() {
    this.getUser();
    this.getDocumentos();
  },
  methods: {
    getUser() {
      axios.get("/getUser/" + this.id).then(response => {
        this.usuario = response.data;
      });
    },

    aceptarUsuario() {
      if (
        confirm(
          "Estas seguro de que quieres aceptar al usuario " +
            this.usuario.username +
            "?"
        )
      ) {
        this.usuario.estado_registro = 1;
        axios.put("/putUser", this.usuario).then(response => {});
      }
    },

    denegarUsuario(mensajeRechazado) {
      if (
        confirm(
          "Estas seguro de que quieres denegar al usuario " +
            this.usuario.username +
            "?"
        )
      ) {
        this.usuario.mensajeRechazado = mensajeRechazado;
        this.usuario.estado_registro = 0;
        axios.put("/putUser", this.usuario).then(response => {
          this.$router.push({
            name: "tabla.userPeticiones",
            params: { peticiones: true }
          });
        });
      }
    },

    goBack() {
      this.$router.push({
        name: "tabla.userPeticiones",
        params: { peticiones: true }
      });
    },

    getDoc(nombre) {
      axios
        .get("/getDoc/" + nombre, { responseType: "blob" })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", nombre);
          document.body.appendChild(link);
          link.click();
        });
    },

    getDocumentos() {
      axios.get("/getDocsUser/" + this.id).then(response => {
        this.documentos = response.data;
      });
    }
  }
};
</script>

<style scoped>
</style>