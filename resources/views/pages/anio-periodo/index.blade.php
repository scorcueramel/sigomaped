@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'anio-periodo.index'])

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Periodos
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Periodos</a></li>
                    <li class="breadcrumb-item active">Listado de Periodos</li>
                </ol>
            </section>

            <section class="content">
                <div class="row" id="anioPeriodos">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">LISTADO DE PERIODOS</h4>
                                <a href="{{ route('anioperiodo.create') }}" class="text-info font-weight-bold">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                </a>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ACCIONES</th>
                                                <th>DESCRIPCION</th>
                                                <th>ESTADO</th>
                                                <th>FECHA CREACIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="anioperiodost">
                                        </tbody>
                                    </table>
                                </div>
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
    function getAnioPeriodo() {
        $.ajax({
            type: "GET",
            url: "{{ route('anioperiodo.getAnioPeriodo') }}",
            success: function(response) {
                $("#anioperiodost").html('');
                response.forEach((anioPeriodos) => {
                    $("#anioperiodost").append(`
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline btn-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#";"><i class="fa fa-plus"></i> Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash-o"></i>Eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td>${anioPeriodos.descripcion}</td>
                            <td>${anioPeriodos.estado == 1 ? 'Activo' : 'Inactivo'}</td>
                            <td>${new Date(anioPeriodos.createdat).toLocaleDateString()}</td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener los periodos:", error);
            }
        });
    }

    $(document).ready(function() {
        getAnioPeriodo();
    });
</script>
@endpush
