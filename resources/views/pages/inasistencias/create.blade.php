@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'inscripciones.create'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripciones
                    <small>Nuevo Inscrito</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('inscripciones.index')}}"><i class="fa fa-edit"></i> Inscripciones</a></li>
                    <li class="breadcrumb-item active">Nuevo Inscrito</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">ALUMNO A INSCRIBIR</h4>
                            </div>
                            <div class="box-body ">
                                <div class="form-group">
                                    <label for="documento_alumno">Buscar alumno por número de documento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" placeholder="Documento del alumno" id="documento_alumno" autofocus required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" type="button" id="buscador"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <button class="btn btn-warning" type="button" id="limpiar" onclick="javascript:limpiarCampos()"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="datosAlumno">
                    <input type="hidden" id="alumonid" value="">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">DATOS DEL ALUMNO</h4>
                            </div>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRES</th>
                                                <th>APELLIDOS</th>
                                                <th>DOCUMENTO</th>
                                            </tr>
                                        </thead>
                                        <tbody class="datos_alumno">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="tiposTalleres">
                    <input type="hidden" value="0" id="espera">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">TIPOS DE TALLERES</h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN TIPO DE TALLER</p>
                            <div class="box-body ">
                                <div class="form-group">
                                    @foreach ($tiposTalleres as $tp)
                                    <div class="radio">
                                        <input name="tipotaller" type="radio" id="Option_{{$tp->tipotallerid}}" class="tallerselec" onclick="consultaProgramas('{{ $tp->tipotallerid }}','{{$tp->tipotallerdescripcion}}');">
                                        <label for="Option_{{$tp->tipotallerid}}">{{$tp->tipotallerdescripcion}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="seccionprogramas">
                    <input type="hidden" value="" id="tallerid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">TALLERES DEL TIPO <span class="font-weight-bold" id="programaTitulo"></span></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN TALLER</p>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRE DEL TALLER</th>
                                                <th>PROGRAMA AL QUE PERTENECE</th>
                                            </tr>
                                        </thead>
                                        <tbody class="datos-programas">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group" id="radios-programas">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                {{-- <div class="row d-none" id="selecciontaller">
                    <input type="hidden" value="" id="tallerid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title font-weight-bold" id="tallerTitulo"></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCIONA UN TALLER</p>
                            <div class="box-body ">
                                <div class="form-group" id="radios-talleres">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div> --}}
                <div class="row d-none" id="ciclos">
                    <input type="hidden" value="0" id="cicloid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CICLOS RELACIONADOS A <span class="font-weight-bold" id="cicloTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN AÑO Y PERIODO</p>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" rowspan="2">#</th>
                                                <th scope="col" rowspan="2">AÑO</th>
                                                <th scope="col" rowspan="2">PERIODO</th>
                                                <th scope="col" colspan="2" class="text-center">DURACIÓN</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">INICIO</th>
                                                <th scope="col" class="text-center">FIN</th>
                                            </tr>
                                        </thead>
                                        </thead>
                                        <tbody id="radios-ciclos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="dias">
                    <input type="hidden" id="horarioid" value="">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">DIAS RELACIONADOS A <span class="font-weight-bold" id="diaTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN DÍA</p>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" rowspan="2">#</th>
                                                <th scope="col" rowspan="2">DÍA</th>
                                                <th scope="col" rowspan="2">HORA INICIO</th>
                                                <th scope="col" rowspan="2">HORA FIN</th>
                                                <th scope="col" colspan="2" class="text-center">CANTIDAD DE CUPOS</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">MÁXIMOS</th>
                                                <th scope="col" class="text-center">ACTUALES</th>
                                            </tr>
                                            <thead>
                                            </thead>
                                        </thead>
                                        <tbody id="dias-ciclo">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-info disabled" id="inscribiralumno" onclick="javascript:inscribirAlumno()">INSCRIBIR</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="inscribirespera">
                    <div class="col-12 col-lg-12 mb-4">
                        <!-- Form Element sizes -->
                        <button class="btn btn-block btn-info" id="inscribiralumnoespera" onclick="javascript:inscribirEspera()">INSCRIBIR EN LISTA DE ESPERA</button>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        @include('components.footer')
        @include('components.controls')
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('assets/js/perzonalized/inscripciones.js')}}"></script>
@endpush
