@extends('layouts.master')
@section('content')
<div class="container">
    <section class="row mt-5">
        <section class="col-12">
            <h1 class="text-center">Contáctanos</h1>
            <p>No dudes en contactarnos si tienes alguna duda sobre el CAU. Intentaremos responderte con la mayor
                brevedad posible. </p>
        </section>

        <section class="row mb-5">

            <article class="col-12 col-md-6 offset-md-1">
                <form-contacto></form-contacto>
            </article>

            <article class="col-12 col-md-4 mb-3">
                <iframe src="https://goo.gl/BXgFqN" width="500" height="450" frameborder="0" style="border:0"
                    allowfullscreen></iframe>
            </article>
        </section>
    </section>

    <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="ModalCookies"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="myModalTitle">Mensaje Enviado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Su mensaje ha sido enviado correctamente. Nos pondremos en contacto con la mayor brevedad posible.
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop