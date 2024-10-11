@extends('layouts.app', ['activePage' => 'home'])

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'home'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Panel de Control</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="breadcrumb-item active">Panel de Control</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box box-body">
                            <h6 class="text-uppercase">Unactivated Ads</h6>
                            <div class="flexbox mt-2">
                                <span class="fa fa-warning text-danger font-size-40"></span>
                                <span class=" font-size-30">553</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box box-body">
                            <h6 class="text-uppercase">Activated Ads</h6>
                            <div class="flexbox mt-2">
                                <span class="fa fa-picture-o text-info font-size-40"></span>
                                <span class=" font-size-30">4105</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box box-body">
                            <h6 class="text-uppercase">User registration</h6>
                            <div class="flexbox mt-2">
                                <span class="fa fa-user-plus font-size-40 text-primary"></span>
                                <span class=" font-size-30">1250</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box box-body">
                            <h6 class="text-uppercase">Listed Companies</h6>
                            <div class="flexbox mt-2">
                                <span class="fa fa-building font-size-40 text-success"></span>
                                <span class=" font-size-30">2150</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Talleres Activos</h4>
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
