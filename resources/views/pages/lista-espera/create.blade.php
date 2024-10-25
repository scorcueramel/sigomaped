@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'listaespera.create'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripciones
                    <small>Datos a Inscribir</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('listaespera.index')}}"><i class="fa fa-edit"></i> Inscripciones</a></li>
                    <li class="breadcrumb-item active">Proceso de inscripción</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row" id="datosAlumno">
                    <input type="hidden" id="alumonid" value="{{$data->alumnoid}}">
                    <input type="hidden" id="tallerid" value="{{$data->tallerid}}">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">INFORMACIÓN PARA LA INSCRIPCIÓN</h4>
                            </div>
                            <div class="box-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>NOMBRES</th>
                                                <th>APELLIDOS</th>
                                                <th>DOCUMENTO</th>
                                                <th>TIPO TALLER</th>
                                                <th>PROGRAMA</th>
                                                <th>TALLER</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="datos_alumno">
                                            <tr>
                                                <td>{{$data->alumnonombres}}</td>
                                                <td>{{$data->alumnoapellidos}}</td>
                                                <td>{{$data->alumnodocumento}}</td>
                                                <td>{{$data->tipotallerdescripcion}}</td>
                                                <td>{{$data->programanombre}}</td>
                                                <td>{{$data->tallernombre}}</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" onclick="javascript:consultaCiclos('{{$data->tallerid}}','{{$data->programanombre}}')">
                                                        <i class="fa fa-search mr-5" aria-hidden="true"></i>Buscar Horario
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

                <div class="row d-none" id="ciclos">
                    <input type="hidden" value="0" id="cicloid">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CICLOS RELACIONADOS A <span class="font-weight-bold" id="cicloTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN AÑO Y PERIODO</p>
                            <div class="box-body form-element">
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
                                <h4 class="box-title">DIAS RELACIONADOS AL AÑO <span class="font-weight-bold" id="anio"></span> PERIODO <span class="font-weight-bold" id="periodo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCIONA UN DÍA</p>
                            <div class="box-body form-element">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">DÍA</th>
                                                <th scope="col">HORA INICIO</th>
                                                <th scope="col">HORA FIN</th>
                                                <th scope="col">CUPOS MÁXIMOS</th>
                                                <th scope="col">CUPOS ACTUALES</th>
                                            </tr>
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
            </section>
            <!-- /.content -->
        </div>
        @include('components.footer')
        @include('components.controls')
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('assets/js/perzonalized/listaespera.js')}}"></script>
@endpush
