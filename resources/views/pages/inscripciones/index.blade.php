@extends('layouts.app')

@section('content')
    <div class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('components.header')
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
                    @if (count($listaEspera) > 0)
                        @include('components.alerts', [
                            'type' => 'warning',
                            'icontype' => 'info',
                            'title' => 'Recuerda!',
                            'message' => 'Actualmente tu lista de espera cuenta con alumnos, te recomendamos verificarla antes de continuar con una inscripción. <br>
                                        Ve al apartado <strong><a class="text-dark font-weight-bold" href="/lista-espera/index">Lista de Espera</a></strong> para verificar.',
                            'btndismiss' => true,
                            'textcolor' => 'text-dark',
                        ])
                    @endif
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <!-- Form Element sizes -->
                            <div class="box">
                                <div class="box-header with-border d-flex justify-content-between">
                                    <h4 class="box-title">PROGRAMAS</span></h4>
                                    <a href="{{ route('inscripciones.create') }}" class="text-info font-weight-bold"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                        Nuevo</a>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <select class="form-control" id="programasAll">
                                            <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <div class="row d-none" id="talleresProgramas">
                        <div class="col-12 col-lg-12">
                            <!-- Form Element sizes -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">TALLERES</h4>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <select class="form-control" id="taller">
                                            <option selected disabled value="">SELECCIONA UN TALLER</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    {{-- <div class="row d-none" id="aniosperiodos">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">AÑO Y PERIODO</h4>
                            </div>
                            <div class="box-body ">
                                <div class="form-group" id="radios-anio-periodo">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div> --}}
                    <div class="row d-none" id="dias">
                        <div class="col-12 col-lg-12">
                            <!-- Form Element sizes -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">DIAS</h4>
                                </div>
                                <div class="box-body ">
                                    <div class="form-group" id="radios_dias">
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
                                                    <th>DOCUMENTO</th>
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
        $('#programasAll').on('change', function() {
            let id = $(this).val();
            $("#talleresProgramas").addClass('d-none');
            // $("#aniosperiodos").addClass('d-none');
            $("#datosAlumnos").addClass('d-none');
            $("#dias").addClass('d-none');
            $("#radios_dias").html('');
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-talleres-programs/${id}`,
                success: function(response) {
                    if (response.length > 0) {
                        $("#taller").html('');
                        $("#talleresProgramas").removeClass('d-none');
                        $("#taller").append(`
                        <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                    `);
                        response.forEach((e) => {
                            $("#taller").append(`
                            <option value="${e.tallerid}">${e.tallernombre}</option>
                        `);
                        });
                    }
                }
            });
        });

        $('#taller').on('change', function() {
            // $("#radios-anio-periodo").html('');
            $("#dias").addClass('d-none');
            $("#radios_dias").html('');
            $("#datosAlumnos").addClass('d-none');
            $(".datos_alumnos").html('');
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-dia-taller/${id}`,
                success: function(response) {
                    // $("#aniosperiodos").removeClass('d-none');
                    $("#dias").removeClass('d-none');
                    if (response.length > 0) {
                        response.forEach((e) => {
                            $("#radios_dias").append(`
                        <div class="radio">
                            <input name="taller_programa" type="radio" id="dias_${e.diaid}" onclick="javascript:inscritosPorDia(${e.diaid})">
                            <label for="dias_${e.diaid}">${e.dianombre}</label>
                        </div>
                        `);
                        });
                    }
                }
            });
        });

        function inscritosPorDia(diaid) {
            $("#datosAlumnos").addClass('d-none');
            $(".datos_alumnos").html('');
            let tallerid = $("#taller").val();
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-isncritos-dias/${tallerid}/${diaid}`,
                success: function(response) {
                    console.log(response);
                    if (response.length > 0) {
                        $("#datosAlumnos").removeClass('d-none');
                        response.forEach((e) => {
                            $(".datos_alumnos").append(`
                            <tr>
                                <td>
                                    ${e.personainscritanombre}
                                </td>
                                <td>
                                    ${e.personainscritadocumento}
                                </td>
                            </tr>
                        `);
                        });
                    }
                }
            });
        }

        // function alumnosPorDiaYTaller(id) {
        //     $("#datosAlumnos").addClass('d-none');
        //     $(".datos_alumnos").html('');
        //     $.ajax({
        //         type: "GET",
        //         url: `/inscripciones/get-inscritos-ciclo/${id}`,
        //         success: function(response) {
        //             if (response.length > 0) {
        //                 $("#datosAlumnos").removeClass('d-none');
        //                 response.forEach((e) => {
        //                     $(".datos_alumnos").append(`
        //                     <tr>
        //                         <td>
        //                             ${e.nombres}
        //                         </td>
        //                         <td>
        //                             ${e.dia}
        //                         </td>
        //                         <td>
        //                             ${e.hora_inicio}
        //                         </td>
        //                         <td>
        //                             ${e.hora_fin}
        //                         </td>
        //                     </tr>
        //                 `);
        //                 });
        //             }
        //         }
        //     });
        // }
    </script>
@endpush
