@extends('layouts.child')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Formulario Registro Hijo</h1>
                    <form id="registerChild" method="post" action="{{ action('AdminController@createHijo') }}"
                        accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id_padre" value="{{ Auth::user()->id }}">

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="nombre">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="50"
                                    required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="ape1">Apellido 1</label>
                            <div class="col-md-6">
                                <input type="text" name="apellido1" id="ape1" maxlength="49" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="ape2">Apellido 2</label>
                            <div class="col-md-6">
                                <input type="text" name="apellido2" id="ape2" maxlength="49" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="dni">DNI</label>
                            <div class="col-md-6">
                                <input type="text" name="DNI" id="dni" maxlength="50" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="fecha-nac">Fecha de Nacimiento</label>
                            <div class="col-md-6">
                                <input type="date" name="fecha_nac" id="fecha-nac" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="curso-escolar">Curso Escolar:</label>
                            <div class="col-6">
                                <select class="form-control" id="curso-escolar" name="curso escolar" required>
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
                        </div>

                        <div class="form-label-group row">
                            <h2 class="text-center col-12 mt-4 mb-2">Subida de documentos (PDF)</h2>
                            <p class="text-center col-12 mb-5">
                                A continuación deberás adjuntar los documentos demandados. Es necesario exportarlos a
                                formato PDF.
                                <br>Si utilizas Word, OpenOffice o similares podrás hacer
                                Archivo->Exportar/DescargarComo->PDF.
                                <br>Mas información
                                <a
                                    href="https://helpx.adobe.com/es/acrobat/using/exporting-pdfs-file-formats.html">aquí</a>.
                            </p>
                        </div>

                        <div class="form-label-group row">
                            <label class="col-4 text-md-right text-center" for="calendario-vacunas">Sube aquí los datos
                                del calendario de vacunas (PDF).</label>
                            <div class="col-md-6">
                                <input type="file" name="calendarioDeVacunas" class="form-control-file"
                                    id="calendario-vacunas" accept="application/pdf" required>

                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label for="fotocopia-sip" class="col-4 text-md-right text-center">Sube aquí la fotocopia
                                del SIP (PDF).</label>
                            <div class="col-md-6">
                                <input type="file" name="fotocopiaDelSIP" class="form-control-file" id="fotocopia-sip"
                                    accept="application/pdf" required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label for="image-auth" class="col-4 text-md-right text-center">Sube aquí la autorización
                                imagenes (PDF).</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="autorizacionDeImagenes"
                                    id="image-auth" accept="application/pdf" required>
                            </div>
                        </div>

                        <div class="form-label-group row">
                            <label for="func-interno" class="col-4 text-md-right text-center">Sube aquí el documento de
                                funcionamiento interno (PDF).</label>
                            <div class="col-md-6">
                                <input type="file" name="funcionamientoInterno" class="form-control-file"
                                    id="func-interno" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-center mb-3">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@stop