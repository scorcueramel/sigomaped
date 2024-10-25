@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'talleres.create'])

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Crear Taller
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Talleres</a></li>
                    <li class="breadcrumb-item active">Crear taller</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CREAR NUEVO TALLER</h4>
                            </div>
                            <div class="box-body">
                                <form id="crearTallerForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tipos-taller">TIPO <span class="text-danger">*</span></label>
                                        <select class="form-control" name="tipotallerid" id="tipos-taller" required>
                                            <option selected disabled value="">SELECCIONA UN TIPO DE TALLER</option>
                                            @foreach ($tipostalleres as $tp)
                                            <option class="mx-3" value="{{$tp->tipotallerid}}">{{$tp->tipotallerdescripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="programa">PROGRAMA</label>
                                        <select class="form-control" id="programa" name="programa" disabled required>
                                            <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre">Nombre del Taller</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del taller" disabled required>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado</label><br>
                                        <input type="checkbox" id="estado" name="estado" value="1">
                                        <label for="estado">Activo</label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="{{ route('talleres.index') }}" class="btn btn-secondary">Cancelar</a>
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
        $('#tipos-taller').on('change', function() {
            $('#nombre').attr('disabled', 'disabled');
            $.ajax({
                url: `/programas/get-programas`,
                type: 'GET',
                success: function(response) {
                    $('#programa').removeAttr('disabled');
                    $('#programa').html('<option selected disabled value="">SELECCIONA UN PROGRAMA</option>');
                    response.forEach(function(programa) {
                        $('#programa').append(`<option value="${programa.id}">${programa.nombre}</option>`);
                    });
                },
                error: function() {
                    console.log('Error al obtener los programas.');
                }
            });
        });

        $('#programa').on('change', function() {
            $('#nombre').removeAttr('disabled');
        });

        $('#crearTallerForm').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres crear este taller?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, crear taller',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = {
                        tipo_taller_id: parseInt($('#tipos-taller').val()),
                        programa_id: parseInt($('#programa').val()),
                        nombre: $('#nombre').val(),
                        estado: $('#estado').is(':checked') ? 1 : 0
                    };
                    $.ajax({
                        url: "{{ route('talleres.store') }}",
                        type: "POST",
                        dataType: "json",
                        contentType: "application/json",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Taller creado exitosamente',
                                text: response.taller.nombre,
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                window.location.href = "{{ route('talleres.index') }}";
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al crear el taller',
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
