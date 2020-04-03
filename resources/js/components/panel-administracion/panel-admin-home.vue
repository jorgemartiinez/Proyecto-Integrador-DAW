<template>
    <div>
    <div class="row">
        <div class="col-12 offset-md-1 col-md-5 d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <img src="images/img_2.jpg" class="card-img-top" alt="Imagen" height="250px">
                <div class="card-body">
                    <h5 class="card-title">Panel gestión de usuarios</h5>
                    <p class="card-text">Gestiona peticiones y usuarios</p>
                    <a href="/admin/users" class="btn btn-primary">Ir a Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <img src="images/img_2.jpg" class="card-img-top" alt="Imagen" height="250px">
                <div class="card-body">
                    <h5 class="card-title">Panel gestíon eventos</h5>
                    <p class="card-text">Gestiona eventos(Borrar, editar y crear)</p>
                    <a href="/admin/eventos" class="btn btn-primary">Ir a Eventos</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 offset-md-1 col-md-5 d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <img src="images/img_2.jpg" class="card-img-top" alt="Imagen" height="250px">
                <div class="card-body">
                    <h5 class="card-title">Panel gestión comisiones</h5>
                    <p class="card-text">Gestionar tareas</p>
                    <a href="/admin/comisiones/listadocomisiones" class="btn btn-primary">Ir a Comisiones</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <img src="images/img_2.jpg" class="card-img-top" alt="Imagen" height="250px">
                <div class="card-body">
                    <h5 class="card-title">Panel gestión post</h5>
                    <p class="card-text">Gestiona las entradas y noticias del CAU</p>
                    <a href="/admin/posts" class="btn btn-primary">Ir a Posts</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "panel-admin-home"
    }
</script>

<style scoped>

</style>
