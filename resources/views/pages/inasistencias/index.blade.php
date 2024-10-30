@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'asistencia.index'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Asistencias
                    <small>Registros</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Asistencias</a></li>
                    <li class="breadcrumb-item active">Registros</li>
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
                                <!-- <a href="{{ route('inscripciones.create') }}" class="text-info font-weight-bold"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                        Nuevo</a> -->
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
                                    <select class="form-control" id="tallerlistado">
                                        <option selected disabled value="">SELECCIONA UN TALLER</option>
                                    </select>
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
                                                <th>ESTADO INSCRIPCIÓN</th>
                                                <th>CANT. INASISTENCIAS</th>
                                                <th></th>
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
@include('components.modal',[
'idModalComponent'=> 'modalInasistencia',
'buttonId'=> 'btnRegistrarInasistencia',
'widthModal'=>'modal-lg',
'titleModal'=>'REGISTRAR INASISTENCIA',
'bodyContentModal'=>'BODY DEL MODAL CALENDARIO',
'buttonUbication'=>'d-flex justify-content-end',
'heightCancelButton'=>'btn-sm',
'colorButtonCancel'=>'danger',
'textCancelButton'=>'CERRAR',
'wideCancelButton'=>'btn-sm',
'withButtonSave'=>true,
'withSavelButton'=>'btn-sm',
'textSaveButton'=>'GUARDAR',
])
@endsection
@push('js')
<script src="{{asset('assets/js/perzonalized/inasistencias.js')}}"></script>
@endpush
