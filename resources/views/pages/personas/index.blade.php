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
                                <div class="row">
                                    <div class="col-sm-12 col-md-auto">
                                        <div class="form-group">
                                            <label>Buca registros por los siguientes criterios:</label>
                                            <ul>
                                                <li>Selecciona un tipo de persona</li>
                                            </ul>
                                            <div class="input-group">
                                                <select class="form-control mr-3" name="tipopersona" id="tipopersonasbusqueda">
                                                    <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                                    @foreach ($tipospersonas as $tp)
                                                    <option value="{{$tp->tipopersonaid}}">{{$tp->tipopersonadescripcion}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info" type="button" id="buscarregistros"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </span>
                                            </div>
                                        </div> <!-- Nav tabs -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 d-none" id="resultadodebusqueda">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">RESULTADO DE TU BÚSQUEDA</span></h4>
                            </div>
                            <div class="box-body"> <!-- Nav tabs -->
                                <div class="col-12 col-lg-12 table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="tablapersonas">
                                        <thead>
                                            <tr>
                                                <th>TIPO PERSONA</th>
                                                <th>DOCUMENTO</th>
                                                <th>NOMBRES</th>
                                                <th>APELLIDOS</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        @include('components.footer')
        @include('components.controls')
    </div>

    @include('components.modal',[
    'idModalComponent'=> 'modalPersonas',
    'widthModal'=>'modal-lg',
    'heightCancelButton'=>'btn-sm',
    'colorButtonCancel'=>'danger',
    'textCancelButton'=>'CERRAR',
    'wideCancelButton'=>'btn-block'
    ])
</div>
@endsection
@push('js')
<script src="{{asset('assets/js/perzonalized/personas.js')}}"></script>
@endpush
