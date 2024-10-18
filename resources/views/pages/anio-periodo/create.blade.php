@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'anio-periodo.create'])

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Crear Periodo
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Periodos</a></li>
                    <li class="breadcrumb-item active">Crear Periodo</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CREAR NUEVO PERIODO</h4>
                            </div>
                            <div class="box-body">
                                <form id="crearAnioPeriodoForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="descripcion">Descripción del Periodo</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese el descripción del periodo" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado</label><br>
                                        <input type="checkbox" id="estado" name="estado" value="1">
                                        <label for="estado">Activo</label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="{{ route('anioperiodo.index') }}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('components.footer')
        @include('components.controls')
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#crearAnioPeriodoForm').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres crear este periodo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, crear periodo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var descripcion = $('#descripcion').val();
                    var estado = $('#estado').is(':checked') ? 1 : 0;

                    $.ajax({
                        url: "{{ route('anioperiodo.store') }}",
                        type: "POST",
                        dataType: "json",
                        contentType: "application/json",
                        data: JSON.stringify({
                            descripcion: descripcion,
                            estado: estado
                        }),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Periodo creado exitosamente',
                                text: response.anioPeriodo.nombre,
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                window.location.href = "{{ route('anioperiodo.index') }}";
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al crear el Periodo',
                                text: xhr.responseText,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
