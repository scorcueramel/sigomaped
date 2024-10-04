@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.haeder')
        @include('components.aside', ['activePage' => 'inscripciones.index'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripciones
                    <small>Inscritos</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-edit"></i> Inscripciones</a></li>
                    <li class="breadcrumb-item active">Inscritos</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">Lista de Inscritos</h4>
                                <a href="{{route('inscripciones.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
                            </div>
                            <div class="box-body px-0 pt-0 pb-30">
                                <div class="media-list media-list-hover media-list-divided">
                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">New Applicants</span>
                                        <span class="badge badge-lg badge-secondary">3259</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">Active Applicants</span>
                                        <span class="badge badge-lg badge-primary">12458</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">Active Postings</span>
                                        <span class="badge badge-lg badge-info">9658</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">Postings Expiring Expired</span>
                                        <span class="badge badge-lg badge-success">1524</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">Totle Job Opening</span>
                                        <span class="badge badge-lg badge-danger">41582</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title font-size-16 text-fade">Active Job Seekar</span>
                                        <span class="badge badge-lg badge-warning">1548</span>
                                    </a>

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