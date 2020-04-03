@extends('layouts.master')

@section('content')
<div class="container">
    <form-registro-padre></form-registro-padre>
    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="ModalCookies"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="myModalTitle">Mensaje Enviado</h5>
                </div>
                <div class="modal-body">
                    Se han registrado correctamente sus datos, en breves recibirá un correo con sus credenciales
                </div>
                <div class="modal-footer">
                    <button type="button" id="aceptar" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection