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
                                <h4 class="box-title">PERSONAS REGISTRADAS</span></h4>
                                <a href="{{route('personas.create')}}" class="text-info font-weight-bold"><i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo</a>
                            </div>
                            <div class="box-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                                                class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                                class="hidden-xs-down">BÚSQUEDA POR TIPO</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                                class="hidden-xs-down">BÚSQUEDA POR DATOS</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <div class="pad">
                                            <div class="form-group">
                                                <label>Buca registros por los siguientes criterios:</label>
                                                <ul>
                                                    <li>Selecciona un tipo</li>
                                                </ul>
                                                <div class="input-group">
                                                    <select class="form-control" name="tipopersona" id="tipopersonasbusqueda">
                                                        <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                                        @foreach ($tipospersonas as $tp)
                                                        <option value="{{$tp->tipopersonaid}}" {{ $tp->tipopersonaid == old('tipopersona') ? 'selected' : '' }}>{{$tp->tipopersonadescripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-info" type="button" onclick="javascript:getPersonasByTipo()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane pad" id="profile7" role="tabpanel">
                                        <div class="form-group">
                                            <label>Buca registros por los siguientes criterios:</label>
                                            <ul>
                                                <li>Número de documento de identidad</li>
                                                <li>Apellidos</li>
                                                <li>Nombres</li>
                                            </ul>
                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm" id="buscador" autofocus required>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info" type="button" id="buscardatospersonales"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    <button class="btn btn-warning" type="button" id="limpiar" onclick="javascript:limpiarCampos()"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-12 col-lg-12 d-none" id="resultadodebusqueda">
                        <div class="box">
                            <div class="box-header with-border">
                                <h5 class="box-title">RESULTADOS DE TU BÚSQUEDA</h5>
                            </div>
                            <div class="box-body p-0">
                                <div class="media-list media-list-hover">
                                    <div class="table-responsive">
                                        <table id="personaatable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>TIPO DE PERSONA</th>
                                                    <th>NOMBRES Y APELLIDOS</th>
                                                    <th>DOCUMENTO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodytablepersonas">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>TIPO DE PERSONA</th>
                                                    <th>NOMBRES Y APELLIDOS</th>
                                                    <th>DOCUMENTO</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
<script src="{{asset('assets/js/perzonalized/personas.js')}}"></script>
@endpush
