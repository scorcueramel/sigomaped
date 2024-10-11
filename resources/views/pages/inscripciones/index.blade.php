@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.haeder')
        @include('components.aside', ['activePage' => 'inscripciones.index'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripciones
                    <small>Inscritos</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Inscripciones</a></li>
                    <li class="breadcrumb-item active">Inscritos</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">PROGRAMAS</span></h4>
                                <a href="{{route('inscripciones.create')}}" class="text-info font-weight-bold"><i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo</a>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <select class="form-control" id="programas">
                                        <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                                        @foreach ($programas as $programa)
                                        <option value="{{$programa->id}}">{{$programa->nombre}}</option>
                                        @endforeach
                                    </select>
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
                                <h4 class="box-title">TALLERES</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <select class="form-control" id="talleresprogramas">
                                        <option selected disabled value="">SELECCIONA UN TALLER</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="anioperiodo">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">AÑO Y PERIODO</h4>
                            </div>
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-anio-periodo">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="datosAlumnos">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">ALUMNOS INSCRITOS</h4>
                            </div>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>NOMBRES</th>
                                                <th>DIAS</th>
                                                <th>HORA INICIO</th>
                                                <th>HORA FIN</th>
                                            </tr>
                                        </thead>
                                        <tbody class="datos_alumnos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- /.row -->
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
    $('#programas').on('change', function() {
        let id = $(this).val();
        $("#talleres").addClass('d-none');
        $("#anioperiodo").addClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-talleres/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#talleresprogramas").html('');
                    $("#talleres").removeClass('d-none');
                    $("#talleresprogramas").append(`
                        <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                    `);
                    response.forEach((e) => {
                        $("#talleresprogramas").append(`
                            <option value="${e.id}">${e.nombre}</option>
                        `);
                    });
                }
            }
        });
    });
    $('#talleresprogramas').on('change', function() {
        $("#anioperiodo").addClass('d-none');
        $("#radios-anio-periodo").html('');
        $("#datosAlumnos").addClass('d-none');
        $(".datos_alumnos").html('');
        let id = $(this).val();
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-ciclo-taller/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#anioperiodo").removeClass('d-none');
                    response.forEach((e) => {
                        $("#radios-anio-periodo").append(`
                        <div class="radio">
                            <input name="taller_programa" type="radio" id="taller_programa_${e.id}" onclick="javascript:selectedRadio(${e.id})">
                            <label for="taller_programa_${e.id}">${e.anio} - ${e.periodo.periodo}</label>
                        </div>
                        `);
                    });
                }
            }
        });
    });
    function selectedRadio(id) {
        $("#datosAlumnos").addClass('d-none');
        $(".datos_alumnos").html('');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-inscritos-ciclo/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#datosAlumnos").removeClass('d-none');
                    response.forEach((e) => {
                        $(".datos_alumnos").append(`
                            <tr>
                                <td>
                                    ${e.nombres}
                                </td>
                                <td>
                                    ${e.dia}
                                </td>
                                <td>
                                    ${e.hora_inicio}
                                </td>
                                <td>
                                    ${e.hora_fin}
                                </td>
                            </tr>
                        `);
                    });
                }
            }
        });
    }
</script>
@endpush
