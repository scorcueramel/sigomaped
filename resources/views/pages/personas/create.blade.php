@extends('layouts.app')

@section('content')
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('components.header')
        @include('components.aside', ['activePage' => 'personas.create'])
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Personas
                    <small>Registrar Nuevo</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('personas.index')}}"><i class="fa fa-edit"></i> Personas</a></li>
                    <li class="breadcrumb-item active">Registrar Persona</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="callout bg-secondary-gradient">
                    <h4 class="text-dark">IMPORTANTE!</h4>
                    <p class="text-dark">NO OLVIDES RELLENAR TODOS LOS CAMPOS QUE CONTENGAN <span class="text-danger"><strong>(*)</strong></span> ESTOS SON OBLIGATORIOS.</p>
                </div>
                <!-- <form class="needs-validation" novalidate id="formulario"> -->
                <div class="row">
                    <div class="col-12" id="datosgenerales">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h4 class="box-title">DATOS GENERALES DE LA PERSONA</span></h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="tipos-personas">TIPO <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipopersonaid" id="tipos-personas" required>
                                        <option selected disabled value="">SELECCIONA UN TIPO DE PERSONAS</option>
                                        @foreach ($tipospersonas as $tp)
                                        <option class="mx-3" value="{{$tp->tipopersonaid}}">{{$tp->tipopersonadescripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="documento">DOCUMENTO DE IDENTIDAD <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="number" name="documento" id="documento" class="form-control" disabled required>
                                        <div class="d-none" id="documentoerror">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">NOMBRES <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="nombres" maxlength="50" id="nombres" class="form-control" disabled required>
                                        <div class="d-none" id="nombreerror">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">APELLIDOS <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="apellidos" maxlength="100" id="apellidos" class="form-control" disabled required>
                                        <div class="d-none" id="apellidoerror">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="datosgeneralesregistrar">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-12 col-lg-8 d-none" id="formularioextend">
                        <!-- Form Element sizes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title" id="boxheader"></h4>
                            </div>
                            <div class="box-body" id="boxbodysection">
                            </div>
                            <div class="box-body d-none" id="boxbodysectionalumno">
                                <div class="row" style="margin-top:-30px !important">
                                    <div class="col-12" id="generoalumno">
                                        <div class="form-group">
                                            <label for="tipos-personas">GENERO <span class="text-danger">*</span></label>
                                            <div id="radio-generos">
                                            </div>
                                            <div class="d-none" id="generoerror">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-12" id="tiposseguros">
                                        <div class="form-group">
                                            <label abel for="radio-seguros">TIPO DE SEGURO <span class="text-danger">*</span></label>
                                            <div id="radio-seguros">
                                            </div>
                                            <div class="d-none" id="seguroerror">
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-12" id="aniosperiodos">
                                        <div class="form-group">
                                            <label abel for="radio-anios-periodos">AÑO Y PERIODO DE INGRESO <span class="text-danger">*</span></label>
                                            <div id="radio-anios-periodos">
                                            </div>
                                            <div class="d-none" id="anioperiodoserror">
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-12" id="condsocioeconomica">
                                        <div class="form-group">
                                            <label abel for="radio-condicion-socioeconomica">CONDICIÓN SOCIOECONOMICA <span class="text-danger">*</span></label>
                                            <div id="radio-condicion-socioeconomica">
                                            </div>
                                            <div class="d-none" id="condsocioeconomicaerror">
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-12" id="manifestacionvoluntad">
                                        <div class="form-group">
                                            <label abel for="radio-manifestacion-voluntad">MANIFESTACIÓN DE VOLUNTAD <span class="text-danger">*</span></label>
                                            <div id="radio-manifestacion-voluntad">
                                            </div>
                                            <div class="d-none" id="manifestacionvoluntaderror">
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-12" id="tipodiscapacidad">
                                        <div class="form-group">
                                            <label abel for="radio-tipos-discapacidades">TIPOS DE DISCAPACIDADES <span class="text-danger">*</span></label>
                                            <div id="radio-tipos-discapacidades">
                                            </div>
                                            <div class="d-none" id="tiposdediscapacidadeserror">
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="fechainscripcion">
                                            <div class="form-group">
                                                <label abel for="fecha-inscripcion">FECHA DE INSCRIPCIÓN <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="fecha-inscripcion">
                                                <div class="d-none" id="fechadeinscripcionerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="dsexinscripcion">
                                            <div class="form-group">
                                                <label abel for="dsexpisncripcion">DS. EXP. INSCRIPCIÓN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dsexpisncripcion" value="628-2024/OMAPED" disabled>
                                                <div class="d-none" id="dsexinscripcionerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="distritos">
                                            <div class="form-group">
                                                <label abel for="distritos">DISTRITO <span class="text-danger">*</span></label>
                                                <select class="form-control combos" id="distrito" style="width: 100%;">
                                                    <option value="" disabled selected>SELECCIONA DISTRITO</option>
                                                    @foreach ($distritos as $distrito)
                                                    <option value="{{$distrito->distrito}}">{{$distrito->distrito}} - {{$distrito->codigopostal}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="d-none" id="distritoserror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="sectores">
                                            <div class="form-group">
                                                <label abel for="sector">SECTOR <span class="text-danger">*</span></label>
                                                <select class="form-control combos" id="sector" style="width: 100%;">
                                                    <option value="" disabled selected>SELECCIONA SECTOR</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                </select>
                                                <div class="d-none" id="sectorerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="subsectoralumno">
                                            <div class="form-group">
                                                <label abel for="subsector">SUBSECTOR <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="subsector">
                                                <!-- <div class="d-none" id="subsectorerror">
                                            </div> -->

                                            </div>
                                        </div>
                                        <div class="col-auto" id="domicilioalumno">
                                            <div class="form-group">
                                                <label abel for="domicilio">DOMICILIO <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="domicilio">
                                                <div class="d-none" id="domicilioerror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="fechanaciemiento">
                                            <div class="form-group">
                                                <label abel for="fecha-nacimiento">FECHA DE NACIMIENTO <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="fecha-nacimiento">
                                                <div class="d-none" id="fechanaciemientoerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="rocarnetconadis">
                                            <div class="form-group">
                                                <label abel for="ro-carnet-conadis">RO. CARNET CONADIS <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ro-carnet-conadis">
                                                <div class="d-none" id="rocarnetconadiserror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="solicitudinscripcionalumno">
                                            <label abel for="solicitud-inscripcion">SOLICITUD DE INSCRIPCIÓN <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="solicitudinscripcion" type="radio" class="with-gap" id="si" value="1" required />
                                                <label for="si" class="mr-30">SI</label>
                                                <input name="solicitudinscripcion" type="radio" id="no" class="with-gap" value="0" />
                                                <label for="no">NO</label>
                                                <div class="d-none" id="solicitudinscripcionerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="empadronamientosisfohalumno">
                                            <label abel for="empredronamiento-sisfoh">CONST. EMPRADRONAMIENTO SISFOH <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="empadronamientosisfoh" type="radio" class="with-gap" id="siempadronado" value="SI" required />
                                                <label for="siempadronado" class="mr-30">SI</label>
                                                <input name="empadronamientosisfoh" type="radio" id="noempadronado" class="with-gap" value="NO" />
                                                <label for="noempadronado" class="mr-30">NO EMPADRONADO</label>
                                                <input name="empadronamientosisfoh" type="radio" id="caducado" class="with-gap" value="CADUCADO" />
                                                <label for="caducado">CADUCADO</label>
                                                <div class="d-none" id="empadronamientosisfoherror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="copiadni">
                                            <label abel for="copia-dni">COPIA DE DNI <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="copiadni" type="radio" class="with-gap" id="sipcopia" value="1" required />
                                                <label for="sipcopia" class="mr-30">SI</label>
                                                <input name="copiadni" type="radio" id="nocopia" class="with-gap" value="0" />
                                                <label for="nocopia">NO</label>
                                                <div class="d-none" id="copiadnierror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="informemedico">
                                            <label abel for="informe-medico">INFORME MÉDICO <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="informemedico" type="radio" class="with-gap" id="siinforme" value="1" required />
                                                <label for="siinforme" class="mr-30">SI</label>
                                                <input name="informemedico" type="radio" id="noinforme" class="with-gap" value="0" />
                                                <label for="noinforme">NO</label>
                                                <div class="d-none" id="informemedicoerror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="reciboserciviosalumno">
                                            <label abel for="recibo-servicios">RECIBO DE SERVICIOS <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="recibosercivios" type="radio" class="with-gap" id="sireciboservicio" value="1" required />
                                                <label for="sireciboservicio" class="mr-30">SI</label>
                                                <input name="recibosercivios" type="radio" id="noreciboservicio" class="with-gap" value="0" />
                                                <label for="noreciboservicio">NO</label>
                                                <div class="d-none" id="reciboservicioserror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="col-auto" id="carnetconadis">
                                            <label abel for="copia-carnet-conadis">COPIA DE CARNET DEL CONADIS <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="carnetconadis" type="radio" class="with-gap" id="sicarnetconadis" value="1" required />
                                                <label for="sicarnetconadis" class="mr-30">SI</label>
                                                <input name="carnetconadis" type="radio" id="nocarnetconadis" class="with-gap" value="0" />
                                                <label for="nocarnetconadis">NO</label>
                                                <div class="d-none" id="copiacarnetconadiserror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto" id="documentaciondigital">
                                            <label abel for="documentacion-digital">DOCUMENTACIÓN DIGITAL <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input name="documentaciondigital" type="radio" class="with-gap" id="sidocdigital" value="1" required />
                                                <label for="sidocdigital" class="mr-30">SI</label>
                                                <input name="documentaciondigital" type="radio" id="nodocdigital" class="with-gap" value="0" />
                                                <label for="nodocdigital">NO</label>
                                                <div class="d-none" id="documentaciondigitalerror">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row" id="buttonregisteralumno">
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- </form> -->
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
    let generos = @json($generos);
    let seguros = @json($seguros);
    let aniospreiodos = @json($aniosperiodos);
    let condicionse = @json($condicionse);
    let manifestaciones = @json($manifestaciones);
    let tipodiscapacidades = @json($tipodiscapacidades);
</script>
<script src="{{asset('assets/js/perzonalized/personas.js')}}"></script>
@endpush
