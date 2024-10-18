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
                                <div class="form-group">
                                    <select class="form-control" id="programas">
                                        <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                        @foreach ($tipospersonas as $tp)
                                            <option value="{{$tp->tipopersonaid}}">{{$tp->tipopersonadescripcion}}</option>
                                        @endforeach
                                    </select>
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
@endsection
