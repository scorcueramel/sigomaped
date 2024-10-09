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
                                    <label for="programa">PROGRAMAS</label>
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
                                    <label for="programa">TALLERES</label>
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
                <div class="row d-none">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">Lista de Inscritos</h4>
                                <a href="{{route('inscripciones.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
                            </div>
                            <div class="box-body px-0 pt-0 pb-30">
                                <div class="media-list media-list-hover media-list-divided">
                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">New Applicants</span>
                                        <span class="badge badge-lg badge-secondary">3259</span>
                                    </a>
                                </div>
                            </div>
                        </div>
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
</script>
@endpush
