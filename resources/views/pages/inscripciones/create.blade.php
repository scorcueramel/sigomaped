@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.haeder')
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
                                <h4 class="box-title">TIPOS DE TALLERES</h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCINA UN TIPO DE TALLER</p>
                            <div class="box-body form-element">
                                <div class="form-group">
                                    @foreach ($tiposTalleres as $tp)
                                    <div class="radio">
                                        <input name="tipotaller" type="radio" id="Option_{{$tp->id}}" class="tallerselec" onclick="javascript:consultaProgramas('{{ $tp->id }}','{{$tp->descripcion}}')">
                                        <label for="Option_{{$tp->id}}">{{$tp->descripcion}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="programas">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">PROGRAMAS ASOCIADOS AL TIPO DE TALLER <span class="font-weight-bold" id="programaTitulo"></span></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCINA UN PROGRAMA</p>
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-programas">
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
                                <h4 class="box-title font-weight-bold" id="tallerTitulo"></h4>
                            </div>
                            <p style="margin: 25px 0 0 20px">SELECCINA UN TALLER</p>
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-talleres">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row d-none" id="ciclos">
                    <div class="col-12 col-lg-12">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CICLOS RELACIONADOS A <span class="font-weight-bold" id="cicloTitulo"></span></h4>
                            </div>
                            <p style="margin: 20px 0 0 20px">SELECCINA UN AÑO Y PERIODO</p>
                            <div class="box-body form-element">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Año</th>
                                                <th scope="col">Periodo</th>
                                                <th scope="col">Inicio / Fin</th>
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
    function consultaProgramas(id, descripcion) {
        $("#radios-programas").html('');
        $("#talleres").addClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-programa/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#programas").removeClass('d-none');
                    $("#programaTitulo").html(descripcion);
                    response.forEach((e) => {
                        $("#radios-programas").append(` 
                        <div class="radio">                       
                            <input name="programa" type="radio" id="programa_${e.id}" onclick="javascript:consultaTalleres(${e.id},'${e.nombre}')">
                            <label for="programa_${e.id}">${e.nombre}</label>       
                        </div>                 
                        `);
                    });
                }
            }
        });
    }

    function consultaTalleres(id, descripcion) {
        let titulo = descripcion.includes("TALLER") ? descripcion.substring(6, descripcion.length, -1) : '';
        $("#radios-talleres").html('');
        $("#ciclos").addClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-talleres/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#talleres").removeClass('d-none');
                    $("#tallerTitulo").html(`TALLERES ${titulo}`);
                    response.forEach((e) => {
                        $("#radios-talleres").append(` 
                        <div class="radio">                       
                            <input name="taller" type="radio" id="taller_${e.id}" onclick="javascript:consultaCiclos(${id},'${descripcion}')">
                            <label for="taller_${e.id}">${e.nombre}</label>       
                        </div>                 
                        `);
                    });
                }
            }
        });
    }

    function consultaCiclos(id, descripcion) {
        $("#radios-ciclos").html('');
        $("#ciclos").removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-ciclos/${id}`,
            success: function(response) {
                if (response.length > 0) {                    
                    $("#cicloTitulo").html(`${descripcion}`);
                    response.forEach((e) => {
                        console.log(e);
                        $("#radios-ciclos").append(`                        
                            <tr>                            
                                <td>
                                    <input type="radio" name="ciclos" id="ciclo_${e.id}">
                                    <label></label>
                                </td>
                                <td>
                                    <label for="ciclo_${e.id}">${e.anio}</label>
                                </td>
                                <td>
                                    ${e.periodo}
                                </td>
                                <td>
                                    ${e.fecha_inicio} / ${e.fecha_fin}
                                </td>
                            </tr>                            
                        `);
                    });
                }
            }
        });
    }
</script>
@endpush