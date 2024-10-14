@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'inscripciones.create'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripciones
                    <small>Nuevo Inscrito</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('inscripciones.index')}}"><i class="fa fa-edit"></i> Inscripciones</a></li>
                    <li class="breadcrumb-item active">Nuevo Inscrito</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">ALUMNO A INSCRIBIR</h4>
                            </div>
                            <div class="box-body form-element">
                                <div class="form-group">
                                    <label for="documento_alumno">Buscar alumno por número de documento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" placeholder="Documento del alumno" id="documento_alumno" autofocus required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" type="button" id="buscador"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <button class="btn btn-warning" type="button" id="limpiar" onclick="javascript:limpiarCampos()"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="datosAlumno">
                    <input type="hidden" id="alumonid" value="">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">DATOS DEL ALUMNO</h4>
                            </div>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRES</th>
                                                <th>APELLIDOS</th>
                                                <th>DOCUMENTO</th>
                                            </tr>
                                        </thead>
                                        <tbody class="datos_alumno">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="tiposTalleres">
                    <input type="hidden" value="0" id="espera">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">TIPOS DE TALLERES</h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN TIPO DE TALLER</p>
                            <div class="box-body form-element">
                                <div class="form-group">
                                    @foreach ($tiposTalleres as $tp)
                                    <div class="radio">
                                        <input name="tipotaller" type="radio" id="Option_{{$tp->id}}" class="tallerselec" onclick="javascript:consultaProgramas('{{ $tp->id }}','{{$tp->descripcion}}')">
                                        <label for="Option_{{$tp->id}}">{{$tp->descripcion}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="programas">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">PROGRAMAS ASOCIADOS AL TIPO DE TALLER <span class="font-weight-bold" id="programaTitulo"></span></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN PROGRAMA</p>
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-programas">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="talleres">
                    <input type="hidden" value="" id="tallerid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title font-weight-bold" id="tallerTitulo"></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN TALLER</p>
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-talleres">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="ciclos">
                    <input type="hidden" value="0" id="cicloid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CICLOS RELACIONADOS A <span class="font-weight-bold" id="cicloTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN AÑO Y PERIODO</p>
                            <div class="box-body form-element">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">AÑO</th>
                                                <th scope="col">PERIODO</th>
                                                <th scope="col">DURACIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="radios-ciclos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="dias">
                    <input type="hidden" id="horarioid" value="">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">DIAS RELACIONADOS A <span class="font-weight-bold" id="diaTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN DÍA</p>
                            <div class="box-body form-element">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">DÍA</th>
                                                <th scope="col">HORA INICIO</th>
                                                <th scope="col">HORA FIN</th>
                                                <th scope="col">CUPOS MÁXIMOS</th>
                                                <th scope="col">CUPOS ACTUALES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dias-ciclo">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-info disabled" id="inscribiralumno" onclick="javascript:inscribirAlumno()">INSCRIBIR</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="inscribirespera">
                    <div class="col-12 col-lg-12 mb-4">
                        <!-- Form Element sizes -->
                        <button class="btn btn-block btn-info" id="inscribiralumnoespera" onclick="javascript:inscribirAlumno()">INSCRIBIR EN LISTA DE ESPERA</button>
                    </div>
                </div>
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
    $("#buscador").on('click', function() {
        $("#tiposTalleres").addClass('d-none');
        $("#programas").addClass('d-none');
        $("#radios-programas").html('');
        $("#talleres").addClass('d-none');
        $("#radios-talleres").html('');
        $("#ciclos").addClass('d-none');
        $("#radios-ciclos").html('');
        $("#dias").addClass('d-none');
        $("#dias-ciclo").html('');
        $("#tallerid").html('');
        $("#inscribirespera").addClass('d-none');
        $(".tallerselec").removeAttr('checked');

        let documento = $('#documento_alumno').val();
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-persona/${documento}`,
            success: function(response) {
                if (response.length > 0) {
                    let data = response[0];
                    $("#alumonid").val(data.id);
                    $("#datosAlumno").removeClass('d-none');
                    $(".datos_alumno").html('');
                    $(".datos_alumno").append(`
                        <tr>
                            <td>
                                <input type="radio" name="alumnoid" id="alumno_${data.id}" onclick="javascript:$('#tiposTalleres').removeClass('d-none')">
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
                    $("#datosAlumno").addClass('d-none');
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
    });

    function inscribirAlumno() {
        let alumnoId = $("#alumonid").val();
        let horarioId = $("#horarioid").val();
        let listaEspera = $("#espera").val();
        let tallerId = $("#tallerid").val();
        let cicloId = $("#cicloid").val();

        Swal.fire({
            icon: 'info',
            html: "Espere un momento porfavor ...",
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            type: "POST",
            url: "{{route('inscripciones.store')}}",
            data: {
                alumnoId,
                horarioId,
                listaEspera,
                cicloId,
                tallerId,
            },
            success: function(response) {
                if (response.code === 100)
                    mensaje("Ops", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                        if (result.isConfirmed) {
                            Swal.close();
                        }
                    });
                else if (response.code === 200)
                    mensaje("Alumno Inscrito", `${response.mensaje}`, "success", "Entendido!").then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{route('inscripciones.index')}}";
                        }
                    });
                else if (response.code === 300)
                    mensaje("Alumno en Espera", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                        if (result.isConfirmed) {
                            Swal.close();
                        }
                    });
                else if (response.code === 400)
                    mensaje("Oops!", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                        if (result.isConfirmed) {
                            Swal.close();
                        }
                    });
                else if (response.code === 500)
                    mensaje("Ops", `${response.mensaje}`, "error", "Entendido!").then((result) => {
                        if (result.isConfirmed) {
                            Swal.close();
                        }
                    });
                console.log(`alumno : ${alumnoId}, taller: ${tallerId}`);
            }
        });

    };

    function limpiarCampos() {
        $("#documento_alumno").val('');
        $("#documento_alumno").focus();
        $("#datosAlumno").addClass('d-none');
        $(".datos_alumno").html('');
        $("#tiposTalleres").addClass('d-none');
        $("#programas").addClass('d-none');
        $("#radios-programas").html('');
        $("#talleres").addClass('d-none');
        $("#radios-talleres").html('');
        $("#ciclos").addClass('d-none');
        $("#radios-ciclos").html('');
        $("#dias").addClass('d-none');
        $("#dias-ciclo").html('');
        $("#tallerid").html('');
        $("#inscribirespera").addClass('d-none');
    }

    function consultaProgramas(tipotallerid, descripcion) {
        let alumnoid = $("#alumonid").val();
        let contadorIndividuales = 0;
        let contadorGrupales = 0;
        let contadorRecreativas = 0;
        $("#talleres").addClass('d-none');
        $("#programas").addClass('d-none');
        $("#radios-programas").html('');
        // pendiente para la validacion sobre la cantidad de talleres al que se encuentra inscrito el alumno
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-validacion/${tipotallerid}/${alumnoid}/inscripciones`,
            success: function(response) {
                response.forEach((e) => {
                    if (alumnoid == e.persona_id && e.tipo_taller == 2) contadorIndividuales++;
                    if (alumnoid == e.persona_id && e.tipo_taller == 1) contadorGrupales++;
                    if (alumnoid == e.persona_id && e.tipo_taller == 3) contadorRecreativas++;
                });
                if (contadorIndividuales == 1) {
                    confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>una</strong> clase <strong>INDIVIDUAL</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                        if (result.isConfirmed) {
                            $('#espera').val('1');
                            continuarInscripcion(tipotallerid, descripcion);
                        } else if (result.dismiss) {
                            $('#espera').val('0');
                            mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!", );
                        }
                    });
                } else if (contadorGrupales == 2) {
                    confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>dos</strong> clases <strong>GRUPALES</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                        if (result.isConfirmed) {
                            $('#espera').val('1');
                            continuarInscripcion(tipotallerid, descripcion);
                        } else if (result.dismiss) {
                            $('#espera').val('0');
                            mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!", );
                        }
                    });
                } else if (contadorRecreativas == 3) {
                    confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>tres</strong> clases <strong>RECREATIVAS</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                        if (result.isConfirmed) {
                            $('#espera').val('1');
                            continuarInscripcion(tipotallerid, descripcion);
                        } else if (result.dismiss) {
                            $('#espera').val('0');
                            mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!", );
                        }
                    });
                } else {
                    $('#espera').val('0');
                    continuarInscripcion(tipotallerid, descripcion);
                }
            }
        });
    }

    function continuarInscripcion(id, descripcion) {
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-programa/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#dias").addClass('d-none');
                    $("#ciclos").addClass('d-none');
                    $("#talleres").addClass('d-none');
                    $("#programas").removeClass('d-none');
                    $("#programaTitulo").html(descripcion);
                    response.forEach((e) => {
                        $("#radios-programas").append(`
                            <div class="radio">
                                <input name="programa" type="radio" id="programa_${e.id}" onclick="javascript:consultaTalleres(${e.id},'${e.nombre}')">
                                <label for="programa_${e.id}">${e.nombre}</label>
                            </div>
                        `);
                    });
                }
            }
        });
    }

    function consultaTalleres(id, descripcion) {
        let titulo = descripcion.includes("TALLER") ? descripcion.substring(6, descripcion.length, -1) : '';
        $("#radios-talleres").html('');
        $("#ciclos").addClass('d-none');
        $("#talleres").addClass('d-none');
        $("#dias").addClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-talleres/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#talleres").removeClass('d-none');
                    $("#tallerTitulo").html(`TALLERES ${titulo}`);
                    response.forEach((e) => {
                        $("#radios-talleres").append(`
                        <div class="radio">
                            <input name="taller" type="radio" id="taller_${e.id}" onclick="javascript:consultaCiclos(${e.id},'${descripcion}');$('#tallerid').val(${e.id})">
                            <label for="taller_${e.id}">${e.nombre}</label>
                        </div>
                        `);
                    });
                }
            }
        });
    }

    function consultaCiclos(id, descripcion) {
        let espera = $("#espera").val();

        if (espera == 0) {
            $('#tallerid').val(id);
            $("#radios-ciclos").html("");
            $("#ciclos").addClass("d-none");
            $("#dias").addClass("d-none");
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-ciclos/${id}`,
                success: function(response) {
                    if (response.length > 0) {
                        $("#ciclos").removeClass("d-none");
                        $("#cicloTitulo").html(`${descripcion}`);
                        response.forEach((e) => {
                            $("#radios-ciclos").append(`
                            <tr>
                                <td>
                                    <input type="radio" name="ciclos" id="ciclo_${e.id}" onclick="javascript:consultaHorariosCiclos(${e.id},'${e.anio}')">
                                    <label for="ciclo_${e.id}"></label>
                                </td>
                                <td>
                                    <label for="ciclo_${e.id}">${e.anio}</label>
                                </td>
                                <td>
                                    <label for="ciclo_${e.id}">${e.periodo.periodo}</label>
                                </td>
                                <td>
                                    <label for="ciclo_${e.id}">${e.fecha_inicio} / ${e.fecha_fin}</label>
                                </td>
                            </tr>
                        `);
                        });
                    }
                }
            });
        } else {
            $('#inscribirespera').removeClass('d-none');
        }
    }

    function consultaHorariosCiclos(id, descripcion) {
        $("#cicloid").val(id);
        $("#dias-ciclo").html("");
        $("#dias").addClass("d-none");
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-horarios-ciclos/${id}`,
            success: function(response) {
                $("#diaTitulo").html(`${descripcion}`);
                if (response.length > 0) {
                    $("#dias").removeClass("d-none");
                    response.forEach((e) => {
                        $("#dias-ciclo").append(`
                            <tr>
                                <td>
                                    <input type="radio" name="cliclodia" id="dia_${e.id}" onclick="javascript:activaInscripcionAsignaDiaId(${e.id})">
                                    <label for="dia_${e.id}"></label>
                                </td>
                                <td>
                                    <label for="dia_${e.id}">${e.dia}</label>
                                </td>
                                <td>
                                    <label for="dia_${e.id}">${e.hora_inicio}</label>
                                </td>
                                <td>
                                    <label for="dia_${e.id}">${e.hora_fin}</label>
                                </td>
                                <td>
                                    <label for="dia_${e.id}">${e.cupo_maximo}</label>
                                </td>
                                <td>
                                    <label for="dia_${e.id}">${e.cupo_actual}</label>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $("#dias").addClass("d-none");
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

    function activaInscripcionAsignaDiaId(diaid) {
        $("#inscribiralumno").removeClass("disabled");
        $("#horarioid").val(diaid);
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