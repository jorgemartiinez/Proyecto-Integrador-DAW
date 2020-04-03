<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Formulario Registro Primer Progenitor</h5>
            <form>
              <div class="form-label-group row">
                <label for="nombre1" class="col-md-4 text-md-right">Nombre</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="nombre 1º progenitor"
                    id="nombre1"
                    maxlength="50"
                    v-validate="'required|min:2'"
                    v-model="usuarios[0].nombre"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('nombre 1º progenitor')"
                  >{{ errors.first('nombre 1º progenitor') }}</p>
                </div>
              </div>
              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="ape1-1">Apellido 1</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="primer apellido 1º progenitor"
                    id="ape1-1"
                    maxlength="49"
                    v-validate="'required|max:49'"
                    v-model="usuarios[0].apellido1"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('primer apellido 1º progenitor')"
                  >{{ errors.first('primer apellido 1º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="ape2-1">Apellido 2</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="segundo apellido 1º progenitor"
                    id="ape2-1"
                    maxlength="49"
                    v-validate="'required|max:49'"
                    v-model="usuarios[0].apellido2"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('segundo apellido 1º progenitor')"
                  >{{ errors.first('segundo apellido 1º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="dni1">DNI</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="DNI 1º progenitor"
                    id="dni1"
                    class="form-control"
                    v-validate="{ required: true, regex:/^[0-9]{8,8}[A-Za-z]$/}"
                    v-model="usuarios[0].dni"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('DNI 1º progenitor')"
                  >{{ errors.first('DNI 1º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="fecha-nac1">Fecha de Nacimiento</label>
                <div class="col-md-6">
                  <input
                    type="date"
                    name="fecha nacimiento 1º progenitor"
                    class="form-control"
                    id="fecha-nac1"
                    v-validate="'required'"
                    v-model="usuarios[0].fec_nac"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('fecha nacimiento 1º progenitor')"
                  >{{ errors.first('fecha nacimiento 1º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="domicilio1">Domicilio:</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="domicilio 1º progenitor"
                    id="domicilio1"
                    required
                    maxlength="100"
                    v-model="usuarios[0].domicilio"
                    v-validate="'required|max:100'"
                    class="form-control"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('domicilio 1º progenitor')"
                  >{{ errors.first('domicilio 1º progenitor') }}</p>
                </div>
              </div>
              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="email1">Email:</label>
                <div class="col-md-6">
                  <input
                    type="email"
                    name="email 1º progenitor"
                    id="email1"
                    required
                    maxlength="250"
                    v-model="usuarios[0].email"
                    class="form-control"
                    v-validate="'required|email'"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('email 1º progenitor')"
                  >{{ errors.first('email 1º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="telefono1">Teléfono:</label>
                <div class="col-md-6">
                  <input
                    type="number"
                    name="teléfono 1º progenitor"
                    id="telefono1"
                    required
                    pattern="[0-9]{9}"
                    v-model="usuarios[0].telefono"
                    class="form-control"
                    v-validate="{required:true, regex:/^(0034|\+34)?(\d{3})-? ?(\d{2})-? ?(\d)-? ?(\d)-? ?(\d{2})$/}"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('teléfono 1º progenitor')"
                  >{{ errors.first('teléfono 1º progenitor') }}</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div v-if="dosTut" class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Formulario Registro Segundo Progenitor</h5>
            <form>
              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="nombre2">Nombre</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="nombre 2º progenitor"
                    id="nombre2"
                    maxlength="50"
                    v-validate="'required|min:2'"
                    v-model="usuarios[1].nombre"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('nombre 2º progenitor')"
                  >{{ errors.first('nombre 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="ape1-2">Apellido 1</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="primer apellido 2º progenitor"
                    id="ape1-2"
                    v-validate="'required|max:49'"
                    maxlength="49"
                    v-model="usuarios[1].apellido1"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('primer apellido 2º progenitor')"
                  >{{ errors.first('primer apellido 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="ape2-2">Apellido 2</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="segundo apellido 2º progenitor"
                    id="ape2-2"
                    class="form-control"
                    maxlength="49"
                    v-validate="'required|max:49'"
                    v-model="usuarios[1].apellido2"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('segundo apellido 2º progenitor')"
                  >{{ errors.first('segundo apellido 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="dni2">DNI</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="DNI 2º progenitor"
                    id="dni2"
                    class="form-control"
                    v-validate="{ required: true, regex:/^[0-9]{8,8}[A-Za-z]$/}"
                    maxlength="50"
                    v-model="usuarios[1].dni"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('DNI 2º progenitor')"
                  >{{ errors.first('DNI 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="fecha-nac2">Fecha de Nacimiento</label>
                <div class="col-md-6">
                  <input
                    type="date"
                    name="fecha nacimiento 2º progenitor"
                    class="form-control"
                    id="fecha-nac2"
                    v-validate="'required'"
                    v-model="usuarios[1].fec_nac"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('fecha nacimiento 2º progenitor')"
                  >{{ errors.first('fecha nacimiento 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="domicilio2">Domicilio:</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="domicilio 2º progenitor"
                    id="domicilio2"
                    required
                    maxlength="100"
                    v-model="usuarios[1].domicilio"
                    class="form-control"
                    v-validate="'required|max:100'"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('domicilio 2º progenitor')"
                  >{{ errors.first('domicilio 2º progenitor') }}</p>
                </div>
              </div>
              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="email2">Email:</label>
                <div class="col-md-6">
                  <input
                    type="email"
                    name="email 2º progenitor"
                    id="email2"
                    required
                    maxlength="250"
                    v-model="usuarios[1].email"
                    class="form-control"
                    v-validate="'required|email'"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('email 2º progenitor')"
                  >{{ errors.first('email 2º progenitor') }}</p>
                </div>
              </div>

              <div class="form-label-group row">
                <label class="col-md-4 text-md-right" for="telefono2">Teléfono:</label>
                <div class="col-md-6">
                  <input
                    type="number"
                    name="teléfono 2º progenitor"
                    id="telefono2"
                    required
                    pattern="[0-9]{9}"
                    class="form-control"
                    v-model="usuarios[1].telefono"
                    v-validate="{required:true, regex:/^(0034|\+34)?(\d{3})-? ?(\d{2})-? ?(\d)-? ?(\d)-? ?(\d{2})$/}"
                  >
                  <p
                    class="text-danger"
                    v-if="errors.has('teléfono 2º progenitor')"
                  >{{ errors.first('teléfono 2º progenitor') }}</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row m-4">
      <button
        v-if="dosTut"
        @click="toggleSecondForm()"
        class="btn btn-danger col-12 col-md-4 offset-md-1"
      >Volver a solo 1 progenitor</button>
      
      <button
        v-else
        @click="toggleSecondForm()"
        class="btn btn-success col-12 col-md-4 offset-md-1"
      >Añadir datos del otro progenitor</button>
      
      <button @click="enviarDatos()" class="btn btn-primary col-12 col-md-4 offset-md-1">Registrarse</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "FormRegistroPadre",
  data() {
    return {
      dosTut: false, //true = 2 tutore    false = 1 tutor
      usuarios: [{}, {}]
    };
  },
  methods: {
    toggleSecondForm() {
      if (this.dosTut) {
        this.usuarios[1] = {};
      }
      this.dosTut = !this.dosTut;
    },

    enviarDatos() {
      this.$validator
        .validateAll()
        .then(result => {
          if (result) {
            //si no hay errores
            axios.post("/register", this.usuarios).then(response => {
              $("#modalRegistro").modal();

              $("#modalRegistro").click(function(e) {
                window.location = "/";
              });
            });
          }
        })
        .catch(result => console.error(result));
    }
  }
};
</script>

<style scoped>
</style>