@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'talleres.index'])

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Talleres
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Talleres</a></li>
                    <li class="breadcrumb-item active">Listado de Talleres</li>
                </ol>
            </section>

            <section class="content">
                <div class="row" id="talleres">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">LISTADO DE TALLERES</h4>
                                <a href="{{ route('talleres.create') }}" class="text-info font-weight-bold">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                </a>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ACCIONES</th>
                                                <th>TIPO TALLER</th>
                                                <th>PROGRAMA</th>
                                                <th>NOMBRE</th>
                                                <th>ESTADO</th>
                                                <th>FECHA CREACIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tallerest">
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
    function getTalleres() {
        $.ajax({
            type: "GET",
            url: "{{ route('talleres.getTalleres') }}",
            success: function(response) {
                $("#tallerest").html('');
                response.forEach((taller) => {
                    $("#tallerest").append(`
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline btn-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#";"><i class="fa fa-plus"></i> Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="eliminarTaller(${taller.id})"><i class="fa fa-trash-o"></i>Eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td>${taller.tipo}</td>
                            <td>${taller.programa}</td>
                            <td>${taller.nombre}</td>
                            <td>${taller.estado == 1 ? 'Activo' : 'Inactivo'}</td>
                            <td>${new Date(taller.fecha).toLocaleDateString()}</td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener los talleres:", error);
            }
        });
    }

    function eliminarTaller(id) {
        Swal.fire({
            title: "¿Eliminar Taller?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: `/talleres/taller/${id}`,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Taller eliminado exitosamente',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                window.location.href = "{{ route('talleres.index') }}";
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al eliminar el taller:", error);
                        Swal.fire("Error", "No se pudo eliminar el taller.", "error");
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        getTalleres();
    });
</script>
@endpush
