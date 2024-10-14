@extends('layouts.app')

@section('content')
    <div class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('components.header')
            @include('components.aside', ['activePage' => 'listaespera.index'])
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Inscripciones
                        <small>Lista de espera</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Inscripciones</a></li>
                        <li class="breadcrumb-item active">Lista de Espera</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @if (count($listaFinal) > 0)
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <!-- Form Element sizes -->
                                <div class="box">
                                    <div class="box-header with-border d-flex justify-content-between">
                                        <h4 class="box-title">TALLERES CON LISTA DE ESPERA</span></h4>
                                        {{-- <a href="{{ route('inscripciones.create') }}" class="text-info font-weight-bold"><i class="fa fa-plus" aria-hidden="true"></i>
                                                                            Nuevo</a> --}}
                                    </div>
                                    <div class="box-body">
                                        <p style="margin: 25px 0 0 20px">LISTA DE TALLERES CON ALUMNOS EN ESPERA DE
                                            INSCRIPCIÓN</p>
                                        <div class="box-body form-element">
                                            <div class="form-group">
                                                @foreach ($listaFinal as $espera)
                                                    <div class="radio">
                                                        <input name="listaespera" type="radio"
                                                            id="Option_{{ $espera['taller_id'] }}"
                                                            onclick="javascript:personasPorTaller('{{ $espera['taller_id'] }}')">
                                                        <label
                                                            for="Option_{{ $espera['taller_id'] }}">{{ $espera['taller_nombre'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    @else
                        @include('components.alerts', [
                            'type' => 'success',
                            'icontype' => 'check',
                            'title' => 'Sin Espera',
                            'message' =>
                                '<span class="mt-5">Actualmente no cuentas con una lista de espera para ninguno de los talleres.</span>',
                            'btndismiss' => false,
                        ])
                    @endif
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
                                            <tbody id="datos_alumno">
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
        function personasPorTaller(id) {
            $("#datos_alumno").html('');
            $.ajax({
                type: "GET",
                url: `/lista-espera/get-personas-espera/${id}`,
                success: function(response) {
                    if (response.length > 0) {
                        $("#datosAlumno").removeClass('d-none');
                        response.forEach((e) => {
                            $("#datos_alumno").append(`
                            <tr>
                                <td>
                                    <input type="radio" name="alumnoid" id="alumno_${e.persona_id}" onclick="javascript:inscribirAlumno()">
                                    <label for="alumno_${e.persona_id}"></label>
                                </td>
                                <td>
                                    <label for="alumno_${e.persona_id}">
                                        ${e.nombres}
                                    </label>
                                </td>
                                <td>
                                    <label for="alumno_${e.persona_id}">
                                        ${e.apellidos}
                                    </label>
                                </td>
                                <td>
                                    <label for="alumno_${e.persona_id}">
                                        ${e.documento}
                                    </label>
                                </td>
                            </tr>
                        `);
                        });
                    }
                }
            });
        }

        function inscribirAlumno() {
            Swal.fire({
                title: "¿Inscribir Alumno?",
                html: "Deseas inscribir al alumno a un nuevo ciclo y periodo",
                icon: "question",
                allowOutsideClick: false,
                showCloseButton: false,
                showConfirmButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                focusConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.close();
                }
            });
        }
    </script>
@endpush
