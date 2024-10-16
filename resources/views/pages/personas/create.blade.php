@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'personas.create'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Personas
                    <small>Registrar Nuevo</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('personas.index')}}"><i class="fa fa-edit"></i> Personas</a></li>
                    <li class="breadcrumb-item active">Registrar Persona</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="callout callout-secondary">
                    <h4 class="text-dark">IMPORTANTE!</h4>
                    <p class="text-dark">NO OLVIDES RELLENAR TODOS LOS CAMPOS QUE CONTENGAN <span class="text-danger"><strong>(*)</strong></span> ESTOS SON OBLIGATORIOS.</p>
                </div>
                <form action="{{route('personas.store')}}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12" id="datosgenerales">
                            <!-- Form Element sizes -->
                            <div class="box">
                                <div class="box-header with-border d-flex justify-content-between">
                                    <h4 class="box-title">DATOS GENERALES DE LA PERSONA</span></h4>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="tipos-personas">TIPO <span class="text-danger">*</span></label>
                                        <select class="form-control" id="tipos-personas" required>
                                            <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                            @foreach ($tipospersonas as $tp)
                                            <option value="{{$tp->tipopersonaid}}">{{$tp->tipopersonadescripcion}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            El tipo de personas es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body form-element">
                                    <div class="form-group">
                                        <label for="documento">DOCUMENTO DE IDENTIDAD <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="documento" id="documento" class="form-control" required
                                                data-validation-required-message="El documento de identidad de la personas es obligatorio">
                                            <div class="invalid-feedback">
                                                El documento de identidad de la personas es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombres">NOMBRES <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="nombres" id="nombres" class="form-control" required
                                                data-validation-required-message="El nombre de la personas es obligatorio">
                                            <div class="invalid-feedback">
                                                El nombre de la personas es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">APELLIDOS <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="apellidos" id="apellidos" class="form-control" required
                                                data-validation-required-message="El apellido de la personas es obligatorio">
                                            <div class="invalid-feedback">
                                                El apellido de la personas es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="datosgeneralesregistrar">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-12 col-lg-6 d-none" id="formularioextend">
                            <!-- Form Element sizes -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title" id="boxheader"></h4>
                                </div>
                                <div class="box-body form-element" id="boxbody">

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </form>
            </section>
            <!-- /.content -->
        </div>
        @include('components.footer')
        @include('components.controls')
    </div>
</div>
@endsection
@push('js')
<script>
    function limpiarCampos() {
        $("#datosgeneralesregistrar").html('');
        $("#formularioextend").addClass('d-none');
        $("#boxheader").html('')
        $("#boxbody").html('')
    }
    $("#tipos-personas").on('change', function() {
        limpiarCampos();
        $("#datosgenerales").removeClass('col-lg-6');
        let tipoPersona = $(this).val();
        if (tipoPersona == 1 || tipoPersona == 2) {
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS PARA EL USUARIO');
            $("#boxbody").html(`
                		<div class="form-group">
							<label for="email">CORREO ELÉCTRONICO <span class="text-danger">*</span></label>
							<div class="controls">
								<input type="text" name="email" id="email" class="form-control" autocomplete="off" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\\.([a-z\\.]{2,6})" data-validation-regex-message="Ingresa un correo valido" required>
                                <div class="invalid-feedback">
                                    El correo eléctronico de la personas es obligatorio
                                </div>
                            </div>
						</div>
                        <div class="form-group">
                            <label for="password">CONTRASEÑA <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    La constraseña es obligatoria
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">REPETIR CONTRASEÑA</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Debes repetir la contraseña
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-info btn-block">Registar Persona</button>
                            </div>
                        </div>
            `);
        } else if (tipoPersona == 3 || tipoPersona == 4) {
            $("#datosgeneralesregistrar").html(`
                <button type="submit" class="btn btn-info btn-block">Registar Persona</button>
            `);
        } else if (tipoPersona == 5) {
            limpiarCampos();
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS PARA EL REPRESENTANTE LEGAL');
            $("#boxbody").html(`
                <div class="form-group">
                    <label for="documento_alumno">Buscar alumno por número de documento</label>
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" id="documento_alumno" autofocus>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="button" id="buscador" onclick="buscarAlumno()"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
                <div class="table-responsive d-none" id="tablaalumno">
                <input type="hidden" id="alumonid" value="" required>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>DOCUMENTO</th>
                        </tr>
                    </thead>
                    <tbody class="datos_alumno">
                    </tbody>
                </table>
                </div>
                <div class="row d-none" id="datosrepresentante"></div>
            `);
        } else if (tipoPersona == 6) {
            limpiarCampos();
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS DEL ALUMNO');
            $("#boxbody").html(`

            `);
        }
    });

    function buscarAlumno() {
        $("#tablaalumno").removeClass('d-none');
        let documento = $('#documento_alumno').val();
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-persona/${documento}`,
            success: function(response) {
                $('#alumonid').val('');
                if (response.length > 0) {
                    let data = response[0];
                    $("#alumonid").val(data.id);
                    $(".datos_alumno").html('');
                    $(".datos_alumno").append(`
                        <tr>
                            <td>
                                <input type="radio" name="alumnoid" id="alumno_${data.id}" onclick="javascript:camposRepesentanteLegal(${data.id});" required>
                                <label for="alumno_${data.id}"></label>
                            </td>
                            <td>
                                <label for="alumno_${data.id}">
                                    ${data.nombres}
                                </label>
                            </td>
                            <td>
                                <label for="alumno_${data.id}">
                                    ${data.apellidos}
                                </label>
                            </td>
                            <td>
                                <label for="alumno_${data.id}">
                                    ${data.documento}
                                </label>
                            </td>
                        </tr>
                    `);
                } else {
                    $.toast({
                        heading: 'Mensaje Informativo',
                        text: `${response.mensaje}`,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
            }
        });
    }

    function camposRepesentanteLegal(alumnoid){
        $('#alumonid').val(alumnoid);
        $("#datosrepresentante").removeClass('d-none');
        $("#datosrepresentante").html('');
        $("#datosrepresentante").html(`
            <div class="col-12">
                <div class="form-group">
                    <label for="email">CORREO ELÉCTRONICO</label>
                    <div class="controls">
                        <input type="text" name="email" id="email" class="form-control" autocomplete="off" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\\.([a-z\\.]{2,6})" data-validation-regex-message="Ingresa un correo valido">
                        <div class="invalid-feedback">
                            El correo eléctronico del representante es obligatorio
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">NRO DE CONTÁCTO</label>
                    <div class="controls">
                        <input type="number" name="telefono" id="telefono" class="form-control">
                        <div class="invalid-feedback">
                            La constraseña es obligatoria
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-info btn-block">Registar Persona</button>
            </div>
        `);
    }

    function confirmacion(title, message, icon, cancel, canceltext, confirmtext) {
        return Swal.fire({
            title: `${title}`,
            html: `${message}`,
            icon: `${icon}`,
            allowOutsideClick: false,
            showCloseButton: false,
            showConfirmButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: `${confirmtext}`,
            showCancelButton: `${cancel}`,
            cancelButtonColor: "#d33",
            cancelButtonText: `${canceltext}`,
            focusConfirm: true,
        });
    }

    function mensaje(title, message, icon, textbtnconfirm) {
        return Swal.fire({
            title: `${title}`,
            html: `${message}`,
            icon: `${icon}`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: `${textbtnconfirm}`,
            allowOutsideClick: false,
        });
    }
</script>
@endpush
