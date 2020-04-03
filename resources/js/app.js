/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').value;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/*
    Registro de componentes
*/


//Contacto
Vue.component('form-contacto', require('./components/contacto/FormContacto').default);


//Formularios de registro
Vue.component('form-registro-padre', require('./components/registro/FormRegistroPadre.vue').default);

//Formulario de login
Vue.component('login-controller', require('./components/login/LoginController.vue').default);

//Opciones de los eventos
Vue.component('eventos-listas', require('./components/panel-administracion/eventos/EventosLista.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import showUser from './components/panel-administracion/user/ShowUser';
import TablaUsuarios from './components/panel-administracion/user/TablaUsuarios';
import EventosLista from './components/panel-administracion/eventos/EventosLista';
import EventosListaAsistencia from './components/panel-administracion/eventos/EventosListaAsistencia.vue';
import EventosListaDetalles from './components/panel-administracion/eventos/EventosListaDetalles.vue';
import EventosFormulario from './components/panel-administracion/eventos/EventosFormulario.vue';
import ComisionGeneral from './components/panel-administracion/comisiones/Comision-general.vue';
import PostsLista from './components/panel-administracion/posts/PostsLista.vue';
import PostShow from './components/panel-administracion/posts/PostShow.vue';
import ListadoComisiones from './components/panel-administracion/comisiones/Listado-Comisiones'
import AdminDefault from './components/panel-administracion/panel-admin-home.vue'
import VeeValidate, {
    Validator
} from 'vee-validate';
import es from 'vee-validate/dist/locale/es'


const Veeconfig = {
    locale: 'es_ES',
    events: 'change'
};

Validator.localize({
    es_ES: es
});

Vue.use(VeeValidate, Veeconfig);

Vue.use(VueRouter);
/*
 * Las rutas que tengan que recibir un atributo (/user/:id)
 * Siempre al final porque pueden dar conflicto
 *
 * Así NO
 * /user/:id
 * /user/new
 *
 * Así SI
 * /user/new
 * /user/:id
 */
const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/admin',
        name: 'admin.index',
        component: AdminDefault,
        props: true
        },
        {
            path: '/admin/users',
            name: 'tabla.users',
            component: TablaUsuarios,
            props: true
        },
        {
            path: '/admin/users/peticiones',
            name: 'tabla.userPeticiones',
            component: TablaUsuarios,
            props: true
        },
        {
            path: '/admin/users/peticiones/:id',
            name: 'show.users',
            component: showUser,
            props: true
        },
        {
            path: '/admin/eventos',
            name: 'tabla.eventos',
            component: EventosLista,
            props: true
        },
        {
            path: '/admin/eventos/detalles/:id',
            name: 'evento.detalles',
            component: EventosListaDetalles,
            props: true
        },
        {
            path: '/admin/eventos/asistencia/:id',
            name: 'evento.asistencia',
            component: EventosListaAsistencia,
            props: true
        },
        {
            path: '/admin/eventos/nuevo',
            name: 'evento.nuevo',
            component: EventosFormulario,
        },
        {
            path: '/admin/comisiones/show/:id',
            name: 'comision.general',
            component: ComisionGeneral,
            props: true
        },
        {
            path: '/admin/posts',
            name: 'tabla.posts',
            component: PostsLista,
            props: true
        },
        {
            path: '/admin/posts/:id',
            name: 'tabla.postShow',
            component: PostShow,
            props: true
        },
        {
            path: '/admin/comisiones/listadocomisiones',
            name: 'comision.listado',
            component: ListadoComisiones,
            props: true
        },
    ]
});

const app = new Vue({
    el: '#app',
    components: {},
    router,
});
