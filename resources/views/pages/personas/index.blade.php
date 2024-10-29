@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'personas.index'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Personas
                    <small>Lista de Personas</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Personas</a></li>
                    <li class="breadcrumb-item active">Lista de personas</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                @if (Session::has('message'))
                @include('components.alerts',['type'=>'success','icontype'=>'check','title'=>'Persona Creada','withTag'=>false,'message'=>"{{ Seesion::get('message') }}",'btndismiss'=>true,'textcolor'=>'text-primary'])
                @endif
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">BÚSCADOR DE PERSONAS REGISTRADAS</span></h4>
                                <a href="{{route('personas.create')}}" class="text-info font-weight-bold"><i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo</a>
                            </div>
                            <div class="box-body">
                                <div class="tab-pane pad" id="profile7" role="tabpanel">
                                    <div class="form-group">
                                        <label>Buca registros por los siguientes criterios:</label>
                                        <ul>
                                            <li>Número de documento de identidad</li>
                                            <li>Apellidos</li>
                                            <li>Nombres</li>
                                        </ul>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name="busqueda" id="buscador" autofocus required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                <button class="btn btn-warning" type="button" id="limpiar" onclick="javascript:limpiarCampos()"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                            </span>
                                        </div>
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
