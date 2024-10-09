@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.haeder')
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
                                        <input type="text" class="form-control input-sm" placeholder="Documento del alumno" id="documento_alumno" required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" type="button" id="buscador"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <button class="btn btn-warning" type="button" id="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i></button>
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
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">TIPOS DE TALLERES</h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCINA UN TIPO DE TALLER</p>
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
                            <p style="margin: 25px 0 0 20px">SELECCINA UN PROGRAMA</p>
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
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title font-weight-bold" id="tallerTitulo"></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCINA UN TALLER</p>
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
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CICLOS RELACIONADOS A <span class="font-weight-bold" id="cicloTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCINA UN AÑO Y PERIODO</p>
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
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">DIAS RELACIONADOS A <span class="font-weight-bold" id="diaTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCINA UN DÍA</p>
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
                                        <button class="btn btn-block btn-info disabled" id="inscribiralumno">INSCRIBIR</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
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
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
            }
        });
    });

    function consultaProgramas(tipotallerid, descripcion) {
        let alumnoid = $("#alumonid").val();

        $("#radios-programas").html('');
        $("#talleres").addClass('d-none');
        // $.ajax({
        //     type: "GET",
        //     url: `/inscripciones/get-validacion/${tipotallerid}/${alumnoid}/inscripciones`,
        //     success: function (response) {
        //         console.log(response);
        //     }
        // });
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-programa/${tipotallerid}`,
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
                            <input name="taller" type="radio" id="taller_${e.id}" onclick="javascript:consultaCiclos(${id},'${descripcion}')">
                            <label for="taller_${e.id}">${e.nombre}</label>
                        </div>
                        `);
                    });
                }
            }
        });
    }

    function consultaCiclos(id, descripcion) {
        $("#radios-ciclos").html('');
        $("#ciclos").removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-ciclos/${id}`,
            success: function(response) {
                if (response.length > 0) {
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
                                    <label for="ciclo_${e.id}">${e.periodo}</label>
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
    }

    function consultaHorariosCiclos(id, descripcion) {
        $("#dias-ciclo").html('');
        $("#dias").removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-horarios-ciclos/${id}`,
            success: function(response) {
                $("#diaTitulo").html(`${descripcion}`);
                console.log(response);
                if(response.length > 0){
                response.forEach((e) => {
                    $("#dias-ciclo").append(`
                    <tr>
                        <td>
                            <input type="radio" name="cliclodia" id="dia_${e.id}" onclick="javascript:$('#inscribiralumno').removeClass('disabled')">
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
                }else{
                    $("#dias").addClass('d-none');
                    $.toast({
                        heading: 'Mensaje Informativo',
                        text: `${response.mensaje}`,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
            }
        });
    }

    $('#inscribiralumno').on('click',function(){
        alert('Click on inscription');

    });
</script>
@endpush
