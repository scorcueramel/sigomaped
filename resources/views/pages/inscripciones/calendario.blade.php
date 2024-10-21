@extends('layouts.app')

@section('content')
    <div class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('components.header')
            @include('components.aside', ['activePage' => 'inscripciones.calendar'])
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Inscripciones
                        <small>Calendario Inscritos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Inscripciones</a></li>
                        <li class="breadcrumb-item active">Calendario</li>
                    </ol>
                </section>

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
                            <div class="box">
                                <div class="box-header with-border d-flex justify-content-between">
                                    <h4 class="box-title">CALENDARIO DE INSCRIPCIONES</span></h4>
                                    <a href="{{ route('inscripciones.create') }}" class="text-info font-weight-bold"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                        Nuevo</a>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <select class="form-control" id="tipoprograma">
                                                    <option selected disabled value="">SELECCIONA UN TIPO DE PROGRAMA
                                                    </option>
                                                    @foreach ($tiposPorgramas as $tp)
                                                        <option value="{{ $tp->tipotallerid }}">
                                                            {{ $tp->tipotallerdescripcion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <select class="form-control" id="programa" disabled>
                                                    <option selected disabled value="">SELECCIONA UN PROGRAMA
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group" id="talleres">
                                                <select class="form-control" id="taller" disabled>
                                                    <option selected disabled value="">SELECCIONA UN TALLER</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </section>
            </div>
            @include('components.footer')
            @include('components.controls')
        </div>
    </div>
    @include('components.modal')
    <div class="modal none-border" id="my-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add Event</strong></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                        event</button>
                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade none-border" id="add-new-events">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add</strong> a category</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Category Name</label>
                                <input class="form-control form-white" placeholder="Enter name" type="text"
                                    name="category-name" />
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..."
                                    name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    <option value="inverse">Inverse</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                        data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#tipoprograma').on('change', function() {
            let id = $(this).val();
            $("#programa").attr('disabled', 'disabled');
            $("#taller").attr('disabled', 'disabled');
            $("#taller").html('');
            $("#taller").append(`
        <option selected disabled value="">SELECCIONA UN TALLER</option>
        `);
            $("#programa").html('');
            $("#programa").append(`
        <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
        `);
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-programa/${id}`,
                success: function(response) {
                    if (response.length > 0) {
                        $("#programa").removeAttr('disabled');
                        $("#programa").html('');
                        $("#programa").append(`
                    <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                    `);
                        response.forEach((e) => {
                            $("#programa").append(`
                        <option value="${e.id}">${e.nombre}</option>
                    `);
                        });
                    }
                }
            });
        });
        $('#programa').on('change', function() {
            let id = $(this).val();
            $("#taller").attr('disabled', 'disabled');
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-talleres/${id}`,
                success: function(response) {
                    if (response.length > 0) {
                        $("#taller").removeAttr('disabled');
                        $("#taller").html('');
                        $("#taller").append(`
                    <option selected disabled value="">SELECCIONA UN TALLER</option>
                    `);
                        response.forEach((e) => {
                            $("#taller").append(`
                        <option value="${e.id}">${e.nombre}</option>
                    `);
                        });
                    }
                }
            });
        });
        $('#taller').on('change', function() {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: `/inscripciones/get-ciclo-taller/${id}`,
                success: function(response) {
                    $("#aniosperiodos").removeClass('d-none');
                }
            });
        });
    </script>
    <script src="{{ asset('/assets/js/calendar.js') }}"></script>
@endpush
