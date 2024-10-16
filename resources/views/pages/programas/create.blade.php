@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'programas.create'])

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Crear Programa
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Programas</a></li>
                    <li class="breadcrumb-item active">Crear Programa</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">CREAR NUEVO PROGRAMA</h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('programas.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Programa</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del programa" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado</label><br>
                                        <input type="checkbox" id="estado" name="estado" value="1">
                                        <label for="estado">Activo</label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="{{ route('programas.index') }}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('components.footer')
        @include('components.controls')
    </div>
</div>
@endsection
