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
                <div class="callout callout-success">
                    <h4 class="text-dark">IMPORTANTE!</h4>
                    <p class="text-dark">NO OLVIDES RELLENAR TODOS LOS CAMPOS QUE CONTENGAN <span class="text-danger"><strong>(*)</strong></span> ESTOS SON OBLIGATORIOS.</p>
                </div>
                <!-- <form class="needs-validation" novalidate id="formulario"> -->
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
                                    <select class="form-control" name="tipopersonaid" id="tipos-personas" required>
                                        <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                        @foreach ($tipospersonas as $tp)
                                        <option class="mx-3" value="{{$tp->tipopersonaid}}">{{$tp->tipopersonadescripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-body form-element">
                                <div class="form-group">
                                    <label for="documento">DOCUMENTO DE IDENTIDAD <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="documento" maxlength="12" id="documento" class="form-control" value="{{ old('documento') }}" disabled required>
                                        <div class="d-none" id="documentoerror">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">NOMBRES <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="nombres" maxlength="50" id="nombres" class="form-control" value="{{ old('nombres') }}" disabled required>
                                        <div class="d-none" id="nombreerror">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">APELLIDOS <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="apellidos" maxlength="100" id="apellidos" class="form-control" value="{{ old('apellidos') }}" disabled required>
                                        <div class="d-none" id="apellidoerror">
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
                            <div class="box-body form-element" id="boxbodysection">
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- </form> -->
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
    function registrarPersona() {
        let tipopersonaid = $("#tipos-personas").val();
        let documento = $("#documento").val();
        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();

        Swal.fire({
            icon: 'info',
            html: "Espere un momento porfavor ...",
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        if (tipopersonaid == 1 || tipopersonaid == 2) {
            let email = $('#email').val();
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
            let data = {tipopersonaid,documento,nombres,apellidos,email,password,password_confirmation};
            guardarDatos(data)
        } else if (tipopersonaid == 3 || tipopersonaid == 4) {
            let data = {tipopersonaid,documento,nombres,apellidos};
            guardarDatos(data)
        }
    }

    function guardarDatos(data) {
        $.ajax({
            type: "POST",
            url: "{{route('personas.store')}}",
            data: data,
            success: function(response) {
                if (response.code === 200) {
                    mensaje('Persona Registrada', `${response.mensaje}`, 'success', 'Entendido')
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{route('personas.index')}}";
                            }
                        });
                }
            },
            error: function(error) {
                Swal.close();
                mostrarSeccionErroes();
                let errores = error.responseJSON.errors;
                console.log(errores);
                gestionMensajes(errores);
            }
        });
    }

    function mostrarSeccionErroes() {
        $('#documentoerror').removeClass('d-none');
        $('#nombreerror').removeClass('d-none');
        $('#apellidoerror').removeClass('d-none');
        $('#correoerror').removeClass('d-none');
        $('#passworderror').removeClass('d-none');
        $('#passwordconfirmationderror').removeClass('d-none');
    }

    function gestionMensajes(erroresresp) {
        let documentoexist = 'documento' in erroresresp;
        let nombreexist = 'nombres' in erroresresp;
        let apellidoexist = 'apellidos' in erroresresp;
        let correoeexist = 'email' in erroresresp;
        let passwordeexist = 'password' in erroresresp;
        let confirmationpasswordeexist = 'password_confirmation' in erroresresp;

        if (documentoexist) {
            $('#documentoerror').html(`<span class="text-danger">${erroresresp.documento}<span>`)
        } else {
            $('#documentoerror').addClass('d-none');
            $('#documentoerror').html('');
        }

        if (nombreexist) {
            $('#nombreerror').html(`<span class="text-danger">${erroresresp.nombres}<span>`)
        } else {
            $('#nombreerror').addClass('d-none');
            $('#nombreerror').html('');
        }

        if (apellidoexist) {
            $('#apellidoerror').html(`<span class="text-danger">${erroresresp.apellidos}<span>`)
        } else {
            $('#apellidoerror').addClass('d-none');
            $('#apellidoerror').html('');
        }

        if (correoeexist) {
            $('#correoerror').html(`<span class="text-danger">${erroresresp.email}<span>`)
        } else {
            $('#correoerror').addClass('d-none');
            $('#correoerror').html('');
        }

        if (passwordeexist) {
            $('#passworderror').html(`<span class="text-danger">${erroresresp.password}<span>`)
        } else {
            $('#passworderror').addClass('d-none');
            $('#passworderror').html('');
        }

        if (confirmationpasswordeexist) {
            $('#passwordconfirmationderror').html(`<span class="text-danger">${erroresresp.password_confirmation}<span>`)
        } else {
            $('#passwordconfirmationderror').addClass('d-none');
            $('#passwordconfirmationderror').html('');
        }
    }

    function limpiarCampos() {
        $("#datosgeneralesregistrar").html('');
        $("#formularioextend").addClass('d-none');
        $("#boxheader").html('')
        $("#boxbodysection").html('')
    }

    $("#tipos-personas").on('change', function() {
        $("#documento").removeAttr('disabled')
        $("#nombres").removeAttr('disabled')
        $("#apellidos").removeAttr('disabled')
        limpiarCampos();
        $("#datosgenerales").removeClass('col-lg-6');
        let tipoPersona = $(this).val();
        if (tipoPersona == 1 || tipoPersona == 2) {
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS PARA EL USUARIO');
            $("#boxbodysection").html(`
                		<div class="form-group">
							<label for="email">CORREO ELÉCTRONICO <span class="text-danger">*</span></label>
							<div class="controls">
								<input type="text" name="email" id="email" class="form-control" autocomplete="off" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\\.([a-z\\.]{2,6})" data-validation-regex-message="Ingresa un correo valido" required>
                                <div class="d-none" id="correoerror">
                                </div>
                            </div>
						</div>
                        <div class="form-group">
                            <label for="password">CONTRASEÑA <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="password" name="password" id="password" class="form-control" aria-describedby="descripcionpass" autocomplete="off" required>
                                <div id="descripcionpass" class="form-text"><small>Largo minimo <strong><span class="font-weight-bold">8 caracteres</span></strong></small></div>
                                <div class="d-none" id="passworderror">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">REPETIR CONTRASEÑA <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="off" required>
                                <div class="d-none" id="passwordconfirmationderror">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
                            </div>
                        </div>
            `);
        } else if (tipoPersona == 3 || tipoPersona == 4) {
            $("#datosgeneralesregistrar").html(`
                <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
            `);
        } else if (tipoPersona == 5) {
            limpiarCampos();
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS PARA EL REPRESENTANTE LEGAL');
            $("#boxbodysection").html(`
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
                    <div class="d-none" id="datosalumnoerror">
                    </div>
                </table>
                </div>
                <div class="row d-none" id="datosrepresentante"></div>
            `);
        } else if (tipoPersona == 6) {
            let generos = @json($generos);
            let seguros = @json($seguros);
            limpiarCampos();
            $("#datosgeneralesregistrar").html('');
            $("#datosgenerales").addClass('col-lg-6');
            $("#formularioextend").removeClass('d-none');
            $("#boxheader").html('DATOS DEL ALUMNO');
            $("#boxbodysection").html(`
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tipos-personas">GENERO <span class="text-danger">*</span></label>
                            <div class="c-inputs-stacked" id="radio-generos">
                            </div>
                            <div class="d-none" id="generoerror">
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="tiposseguros">
                        <div class="form-group">
                            <label abel for="radio-anios">SEGURO <span class="text-danger">*</span></label>
                            <div class="c-inputs-stacked" id="radio-seguros">
                            </div>
                            <div class="d-none" id="seguroerror">
                            </div>
                        </div>
                    </div>
                </div>
            `);
            generos.forEach((g) => {
                $("#radio-generos").append(`
                    <input name="genero" type="radio" id="genero_${g.generoid}" value="1">
                    <label for="genero_${g.generoid}" class="mr-30">${g.generotipo}</label>
                `);
            });
            seguros.forEach((s) => {
                $("#radio-seguros").append(`
                    <input name="tiposeguro" type="radio" id="tiposeguro_${s.tipoguroid}" required>
                    <label for="tiposeguro_${s.tipoguroid}" class="mr-30">${s.tiposeguro}</label>
                `);
            });
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

    function camposRepesentanteLegal(alumnoid) {
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
                <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
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
