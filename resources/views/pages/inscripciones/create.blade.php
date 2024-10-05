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
                            <p style="margin: 30px 0 0 20px">Selecciona un tipo de taller</p>
                            <div class="box-body form-element">
                                <div class="form-group">
                                    @foreach ($tiposTalleres as $tp)
                                    <div class="radio">
                                        <input name="tipotaller" type="radio" id="Option_{{$tp->id}}" class="tallerselec" onclick="javascript:consultaProgramas('{{ $tp->id }}')">
                                        <label for="Option_{{$tp->id}}">{{Str::title($tp->descripcion)}}</label>
                                    </div>
                                    @endforeach
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
                            <div class="box-body form-element">
                                <div class="form-group" id="radios-talleres">                                    
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
    function consultaProgramas(id) {
        $("#radios-talleres").html('');
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-taller/${id}`,
            success: function(response) {
                if (response.length > 0) {
                    $("#talleres").removeClass('d-none');
                    response.forEach((e) => {
                        $("#radios-talleres").append(` 
                        <div class="radio">                       
                            <input name="taller" type="radio" id="taller_${e.id}">
                            <label for="taller_${e.id}">${e.nombre}</label>       
                        </div>                 
                        `);
                    });
                }
            }
        });
    }
</script>
@endpush