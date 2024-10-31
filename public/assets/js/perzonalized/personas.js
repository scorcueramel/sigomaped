/**
 * funciones para el registro de personas
 */

$("#tipos-personas").on('change', function () {
    $("#documento").removeAttr('disabled')
    $("#nombres").removeAttr('disabled')
    $("#apellidos").removeAttr('disabled')
    limpiarCampos();
    $("#datosgenerales").removeClass('col-lg-5');
    let tipoPersona = $(this).val();
    if (tipoPersona == 1 || tipoPersona == 2) {
        $("#datosgeneralesregistrar").html('');
        $("#datosgenerales").addClass('col-lg-5');
        $("#formularioextend").removeClass('d-none');
        $("#boxheader").html('DATOS PARA EL USUARIO');
        $("#boxbodysectionalumno").addClass('d-none');
        $("#boxbodysection").html(`
                    <div class="form-group">
                        <label for="email">CORREO ELÉCTRONICO <span class="text-danger">*</span></label>
                        <div class="controls">
                            <input type="text" name="email" id="email" class="form-control" autocomplete="off" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\\.([a-z\\.]{2,6})" data-validation-regex-message="Ingresa un correo valido" required>
                            <div class="d-none" id="correoerror">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">CONTRASEÑA <span class="text-danger">*</span></label>
                        <div class="controls">
                            <input type="password" name="password" id="password" class="form-control" aria-describedby="descripcionpass" autocomplete="off" required>
                            <div id="descripcionpass" class="form-text"><small>Largo minimo <strong><span class="font-weight-bold">8 caracteres</span></strong></small></div>
                            <div class="d-none" id="passworderror">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">REPETIR CONTRASEÑA <span class="text-danger">*</span></label>
                        <div class="controls">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="off" required>
                            <div class="d-none" id="passwordconfirmationderror">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
                        </div>
                    </div>
        `);
    } else if (tipoPersona == 3 || tipoPersona == 4) {
        $("#boxbodysectionalumno").addClass('d-none');
        let titulo = 'DATOS DEL ALUMNO';
        datosAlumno(tipoPersona, titulo);
        // $("#datosgeneralesregistrar").html(`
        //     <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
        // `);
    } else if (tipoPersona == 5) {
        $("#boxbodysectionalumno").addClass('d-none');
        let titulo = 'DATOS PARA EL REPRESENTANTE LEGAL';
        limpiarCampos();
        datosAlumno(tipoPersona, titulo);
    } else if (tipoPersona == 6) {
        limpiarCampos();
        $("#datosgeneralesregistrar").html('');
        $("#datosgenerales").addClass('col-lg-5');
        $("#formularioextend").removeClass('d-none');
        $("#boxheader").html('DATOS DEL ALUMNO');
        $("#boxbodysectionalumno").removeClass('d-none');
        $("#buttonregisteralumno").html('');
        $("#buttonregisteralumno").append(`
            <div class="col-12">
                <button type="button" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
            </div>
        `);
        $("#radio-generos").html('');
        $("#radio-seguros").html('');
        $("#radio-anios-periodos").html('');
        $("#radio-condicion-socioeconomica").html('');
        $("#radio-manifestacion-voluntad").html('');
        $("#radio-acreditacion-residencia").html('');
        $("#radio-tipos-discapacidades").html('');
        generos.forEach((g) => {
            $("#radio-generos").append(`
                <input name="genero" type="radio" id="genero_${g.generoid}" value="${g.generoid}" required>
                <label for="genero_${g.generoid}" class="mr-30">${g.generotipo}</label>
            `);
        });
        seguros.forEach((s) => {
            $("#radio-seguros").append(`
                <input name="tiposeguro" type="radio" id="tiposeguro_${s.tipoguroid}" value="${s.tipoguroid}" required>
                <label for="tiposeguro_${s.tipoguroid}" class="mr-30">${s.tiposeguro}</label>
            `);
        });
        aniospreiodos.forEach((a) => {
            $("#radio-anios-periodos").append(`
                <input name="anioperiodo" type="radio" id="anioperiodo${a.anioperiodoid}" value="${a.anioperiodoid}" required>
                <label for="anioperiodo${a.anioperiodoid}" class="mr-30">${a.descripcion}</label>
            `);
        });
        condicionse.forEach((c) => {
            $("#radio-condicion-socioeconomica").append(`
                <input name="cse" type="radio" id="cse${c.cseid}" value="${c.cseid}" required>
                <label for="cse${c.cseid}" class="mr-30">${c.csedescripcion}</label>
            `);
        });
        manifestaciones.forEach((m) => {
            $("#radio-manifestacion-voluntad").append(`
                <input name="manifestacion" type="radio" id="manifestacion${m.manifestacionid}" value="${m.manifestacionid}" required>
                <label for="manifestacion${m.manifestacionid}" class="mr-30">${m.manifestacion}</label>
            `);
        });
        tipodiscapacidades.forEach((d) => {
            $("#radio-tipos-discapacidades").append(`
                <input name="tipodiscapacidad" type="radio" id="tipodiscapacidad${d.tipodiscapacidadid}" value="${d.tipodiscapacidadid}" required>
                <label for="tipodiscapacidad${d.tipodiscapacidadid}" class="mr-30">${d.tipodiscapacidad}</label>
            `);
        });
        acreditacionesResidencia.forEach((r) => {
            $("#radio-acreditacion-residencia").append(`
                <input name="acreditacionderesidencia" type="radio" id="acreditacionderesidencia${r.acredresidid}" value="${r.acredresidid}" required>
                <label for="acreditacionderesidencia${r.acredresidid}" class="mr-30">${r.acreditacionresidencia}</label>
            `);
        });
    }
});

function buscarAlumno() {
    $("#tablaalumno").removeClass('d-none');
    let documento = $('#documento_alumno').val();
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-persona/${documento}`,
        success: function (response) {
            $('#alumonid').val('');
            if (response.length > 0) {
                let data = response[0];
                $(".datos_alumno").html('');
                $(".datos_alumno").append(`
                    <tr>
                        <td>
                            <input type="radio" name="alumnoid" id="alumno_${data.id}" onclick="javascript:camposRepesentanteLegal(${data.id});$('#datosdelalumnopadre').removeClass('d-none');" required>
                            <label for="alumno_${data.id}"></label>
                        </td>
                        <td>
                            <label for="alumno_${data.id}">
                                ${data.nombres}
                            </label>
                        </td>
                        <td>
                            <label for="alumno_${data.id}">
                                ${data.apellidos}
                            </label>
                        </td>
                        <td>
                            <label for="alumno_${data.id}">
                                ${data.documento}
                            </label>
                        </td>
                    </tr>
                `);
            } else {
                $.toast({
                    heading: 'Mensaje Informativo',
                    text: `${response.mensaje}`,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'warning',
                    hideAfter: 5000,
                    stack: 6
                });
            }
        }
    });
}

function datosAlumno(tipopersona, titulo) {
    if (tipopersona == 3 || tipopersona == 4) {
        generalRepreYPadres(titulo)
        $("#boxbodysection").append(`
            <div class="col-12 d-none" id="datosdelalumnopadre">
                <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
            </div>`);
    } else if (tipopersona == 5) {
        generalRepreYPadres(titulo)
        $("#boxbodysection").append('<div class="row d-none" id="datosrepresentante"></div>');
    }
}

function generalRepreYPadres(titulo) {
    $("#datosgeneralesregistrar").html('');
    $("#datosgenerales").addClass('col-lg-5');
    $("#formularioextend").removeClass('d-none');
    $("#boxheader").html(`${titulo}`);
    $("#boxbodysection").html(`
            <div class="form-group">
                <label for="documento_alumno">Buscar alumno por número de documento</label>
                <div class="input-group">
                    <input type="text" class="form-control input-sm" id="documento_alumno" autofocus>
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="button" id="buscador" onclick="buscarAlumno()"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </div>
            <div class="table-responsive d-none" id="tablaalumno">
                <input type="hidden" id="alumonid" value="" required>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>DOCUMENTO</th>
                        </tr>
                    </thead>
                    <tbody class="datos_alumno">
                    </tbody>
                    <div class="d-none" id="datosalumnoerror">
                    </div>
                </table>
            </div>
        `);
}

function camposRepesentanteLegal(alumnoid) {
    $('#alumonid').val(alumnoid);
    $("#datosrepresentante").removeClass('d-none');
    $("#datosrepresentante").html('');
    $("#datosrepresentante").html(`
        <div class="col-12">
            <div class="form-group">
                <label for="correo">CORREO ELÉCTRONICO</label>
                <div class="controls">
                    <input type="text" name="correo" id="correo" class="form-control" autocomplete="off" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\\.([a-z\\.]{2,6})">
                </div>
            </div>
            <div class="form-group">
                <label for="telefono">NRO DE CONTÁCTO</label>
                <div class="controls">
                    <input type="number" name="telefono" id="telefono" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-info btn-block" onclick="javascript:registrarPersona();">Registrar Persona</button>
        </div>
    `);
}

function registrarPersona() {
    let tipopersonaid = $("#tipos-personas").val();
    let documento = $("#documento").val();
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();

    Swal.fire({
        icon: 'info',
        html: "Espere un momento porfavor ...",
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    if (tipopersonaid == 1 || tipopersonaid == 2) {
        let email = $('#email').val();
        let password = $('#password').val();
        let password_confirmation = $('#password_confirmation').val();
        let data = {
            tipopersonaid,
            documento,
            nombres,
            apellidos,
            email,
            password,
            password_confirmation
        };
        guardarDatos(data)
    } else if (tipopersonaid == 3 || tipopersonaid == 4 || tipopersonaid == 5) {
        let alumnoid = $('#alumonid').val();
        let correo = $('#correo').val();
        let telefono = $('#telefono').val();
        let data = {
            tipopersonaid,
            documento,
            nombres,
            apellidos,
            alumnoid,
            correo,
            telefono
        };
        guardarDatos(data)
    } else if (tipopersonaid == 6) {
        let genero = $('input[name=genero]:checked').val();
        let tiposeguro = $('input[name=tiposeguro]:checked').val();
        let anioperiodo = $('input[name=anioperiodo]:checked').val();
        let cse = $('input[name=cse]:checked').val();
        let manifestacion = $('input[name=manifestacion]:checked').val();
        let tipodiscapacidad = $('input[name=tipodiscapacidad]:checked').val();

        let fechainscripcion = $('#fecha-inscripcion').val();
        let dsexpisncripcion = $('#dsexpisncripcion').val();
        let distrito = $('#distrito').val();
        let sector = $('#sector').val();
        let subsector = $('#subsector').val();
        let domicilio = $('#domicilio').val();
        let fechanacimiento = $('#fecha-nacimiento').val();
        let rocarnetconadis = $('#ro-carnet-conadis').val();
        let empadronamientosisfoh = $('input[name=empadronamientosisfoh]:checked').val();
        let acreditacionderesidencia = $('input[name=acreditacionderesidencia]:checked').val();

        let solicitudinscripcion = $('input[name=solicitudinscripcion]:checked').val();
        let copiadni = $('input[name=copiadni]:checked').val();
        let informemedico = $('input[name=informemedico]:checked').val();
        let recibosercivios = $('input[name=recibosercivios]:checked').val();
        let carnetconadis = $('input[name=carnetconadis]:checked').val();
        let documentaciondigital = $('input[name=documentaciondigital]:checked').val();

        let data = {
            tipopersonaid,
            documento,
            nombres,
            apellidos,
            genero,
            tiposeguro,
            anioperiodo,
            cse,
            manifestacion,
            tipodiscapacidad,
            fechainscripcion,
            dsexpisncripcion,
            distrito,
            sector,
            subsector,
            domicilio,
            fechanacimiento,
            rocarnetconadis,
            empadronamientosisfoh,
            acreditacionderesidencia,
            solicitudinscripcion,
            copiadni,
            informemedico,
            recibosercivios,
            carnetconadis,
            documentaciondigital,
        };
        guardarDatos(data)
    }
}

function guardarDatos(data) {
    $.ajax({
        type: "POST",
        url: "/personas/store",
        data: data,
        success: function (response) {
            if (response.code === 200) {
                mensaje('Persona Registrada', `${response.mensaje}`, 'success', 'Entendido')
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
            }
        },
        error: function (error) {
            Swal.close();
            let errores = error.responseJSON;
            if (error.status === 500) {
                mensaje('Ops!', `${error.responseJSON.message}`, 'error', 'Entendido!')
                    .then((result) => {
                        if (result.isConfirmed) {
                            Swal.close();
                        }
                    });
            }
            mostrarSeccionErroes();
            gestionMensajes(errores.errors);
        }
    });
}

function mostrarSeccionErroes() {
    $('#documentoerror').removeClass('d-none');
    $('#nombreerror').removeClass('d-none');
    $('#apellidoerror').removeClass('d-none');
    $('#correoerror').removeClass('d-none');
    $('#passworderror').removeClass('d-none');
    $('#passwordconfirmationderror').removeClass('d-none');
    $('#generoerror').removeClass('d-none');
    $('#seguroerror').removeClass('d-none');
    $('#anioperiodoserror').removeClass('d-none');
    $('#condsocioeconomicaerror').removeClass('d-none');
    $('#manifestacionvoluntaderror').removeClass('d-none');
    $('#acreditacionresidenciaerror').removeClass('d-none');
    $('#tiposdediscapacidadeserror').removeClass('d-none');
    $('#fechadeinscripcionerror').removeClass('d-none');
    $('#seguroerror').removeClass('d-none');
    $('#dsexinscripcionerror').removeClass('d-none');
    $('#distritoserror').removeClass('d-none');
    // $('#sectorerror').removeClass('d-none');
    // $('#subsectorerror').removeClass('d-none');
    $('#domicilioerror').removeClass('d-none');
    $('#fechanaciemientoerror').removeClass('d-none');
    // $('#rocarnetconadiserror').removeClass('d-none');
    $('#solicitudinscripcionerror').removeClass('d-none');
    $('#empadronamientosisfoherror').removeClass('d-none');
    $('#copiadnierror').removeClass('d-none');
    $('#informemedicoerror').removeClass('d-none');
    $('#reciboservicioserror').removeClass('d-none');
    $('#copiacarnetconadiserror').removeClass('d-none');
    $('#documentaciondigitalerror').removeClass('d-none');
}

function gestionMensajes(erroresresp) {
    let documentoexist = 'documento' in erroresresp;
    let nombreexist = 'nombres' in erroresresp;
    let apellidoexist = 'apellidos' in erroresresp;
    let correoeexist = 'email' in erroresresp;
    let passwordeexist = 'password' in erroresresp;
    let confirmationpasswordeexist = 'password_confirmation' in erroresresp;
    let generoexist = 'genero' in erroresresp;
    let tiposeguroexist = 'tiposeguro' in erroresresp;
    let anioperiodoexist = 'anioperiodo' in erroresresp;
    let cseexist = 'cse' in erroresresp;
    let manifestacionexist = 'manifestacion' in erroresresp;
    let tipodiscapacidadexist = 'tipodiscapacidad' in erroresresp;
    let fechainscripcionxist = 'tipodiscapacidad' in erroresresp;
    let solicitudinscripcionexist = 'solicitudinscripcion' in erroresresp;
    let copiadniexist = 'copiadni' in erroresresp;
    let informemedicoexist = 'informemedico' in erroresresp;
    let reciboserciviosexist = 'recibosercivios' in erroresresp;
    let carnetconadisexist = 'carnetconadis' in erroresresp;
    let documentaciondigitalexist = 'documentaciondigital' in erroresresp;
    let dsexpisncripcionexist = 'dsexpisncripcion' in erroresresp;
    let distritoserrorexist = 'distrito' in erroresresp;
    // let sectorexist = 'sector' in erroresresp;
    // let subsectorexist = 'subsector' in erroresresp;
    let domicilioexist = 'domicilio' in erroresresp;
    let fechanacimientoexist = 'fechanacimiento' in erroresresp;
    // let rocarnetconadisexist = 'rocarnetconadis' in erroresresp;
    let empadronamientosisfohexist = 'empadronamientosisfoh' in erroresresp;
    let acreditacionderesidenciaexist = 'acreditacionderesidencia' in erroresresp;


    if (documentoexist) {
        $('#documentoerror').html(`<span class="text-danger">${erroresresp.documento}<span>`)
    } else {
        $('#documentoerror').addClass('d-none');
        $('#documentoerror').html('');
    }

    if (nombreexist) {
        $('#nombreerror').html(`<span class="text-danger">${erroresresp.nombres}<span>`)
    } else {
        $('#nombreerror').addClass('d-none');
        $('#nombreerror').html('');
    }

    if (apellidoexist) {
        $('#apellidoerror').html(`<span class="text-danger">${erroresresp.apellidos}<span>`)
    } else {
        $('#apellidoerror').addClass('d-none');
        $('#apellidoerror').html('');
    }

    if (correoeexist) {
        $('#correoerror').html(`<span class="text-danger">${erroresresp.email}<span>`)
    } else {
        $('#correoerror').addClass('d-none');
        $('#correoerror').html('');
    }

    if (passwordeexist) {
        $('#passworderror').html(`<span class="text-danger">${erroresresp.password}<span>`)
    } else {
        $('#passworderror').addClass('d-none');
        $('#passworderror').html('');
    }

    if (confirmationpasswordeexist) {
        $('#passwordconfirmationderror').html(`<span class="text-danger">${erroresresp.password_confirmation}<span>`)
    } else {
        $('#passwordconfirmationderror').addClass('d-none');
        $('#passwordconfirmationderror').html('');
    }

    if (generoexist) {
        $('#generoerror').html(`<span class="text-danger">${erroresresp.genero}<span>`)
    } else {
        $('#generoerror').addClass('d-none');
        $('#generoerror').html('');
    }

    if (tiposeguroexist) {
        $('#seguroerror').html(`<span class="text-danger">${erroresresp.tiposeguro}<span>`)
    } else {
        $('#seguroerror').addClass('d-none');
        $('#seguroerror').html('');
    }

    if (fechainscripcionxist) {
        $('#fechadeinscripcionerror').html(`<span class="text-danger">${erroresresp.fechainscripcion}<span>`)
    } else {
        $('#fechadeinscripcionerror').addClass('d-none');
        $('#fechadeinscripcionerror').html('');
    }

    if (distritoserrorexist) {
        $('#distritoserror').html(`<span class="text-danger">${erroresresp.distrito}<span>`)
    } else {
        $('#distritoserror').addClass('d-none');
        $('#distritoserror').html('');
    }

    if (dsexpisncripcionexist) {
        $('#dsexinscripcionerror').html(`<span class="text-danger">${erroresresp.dsexpisncripcion}<span>`)
    } else {
        $('#dsexinscripcionerror').addClass('d-none');
        $('#dsexinscripcionerror').html('');
    }

    // if (sectorexist) {
    //     $('#sectorerror').html(`<span class="text-danger">${erroresresp.sector}<span>`)
    // } else {
    //     $('#sectorerror').addClass('d-none');
    //     $('#sectorerror').html('');
    // }

    // if (subsectorexist) {
    //     $('#subsectorerror').html(`<span class="text-danger">${erroresresp.subsector}<span>`)
    // } else {
    //     $('#subsectorerror').addClass('d-none');
    //     $('#subsectorerror').html('');
    // }

    if (anioperiodoexist) {
        $('#anioperiodoserror').html(`<span class="text-danger">${erroresresp.anioperiodo}<span>`)
    } else {
        $('#anioperiodoserror').addClass('d-none');
        $('#anioperiodoserror').html('');
    }

    if (cseexist) {
        $('#condsocioeconomicaerror').html(`<span class="text-danger">${erroresresp.cse}<span>`)
    } else {
        $('#condsocioeconomicaerror').addClass('d-none');
        $('#condsocioeconomicaerror').html('');
    }

    if (manifestacionexist) {
        $('#manifestacionvoluntaderror').html(`<span class="text-danger">${erroresresp.manifestacion}<span>`)
    } else {
        $('#manifestacionvoluntaderror').addClass('d-none');
        $('#manifestacionvoluntaderror').html('');
    }

    if (acreditacionderesidenciaexist) {
        $('#acreditacionresidenciaerror').html(`<span class="text-danger">${erroresresp.acreditacionderesidencia}<span>`)
    } else {
        $('#acreditacionresidenciaerror').addClass('d-none');
        $('#acreditacionresidenciaerror').html('');
    }

    if (tipodiscapacidadexist) {
        $('#tiposdediscapacidadeserror').html(`<span class="text-danger">${erroresresp.tipodiscapacidad}<span>`)
    } else {
        $('#tiposdediscapacidadeserror').addClass('d-none');
        $('#tiposdediscapacidadeserror').html('');
    }

    if (solicitudinscripcionexist) {
        $('#solicitudinscripcionerror').html(`<span class="text-danger">${erroresresp.solicitudinscripcion}<span>`)
    } else {
        $('#solicitudinscripcionerror').addClass('d-none');
        $('#solicitudinscripcionerror').html('');
    }

    if (copiadniexist) {
        $('#copiadnierror').html(`<span class="text-danger">${erroresresp.copiadni}<span>`)
    } else {
        $('#copiadnierror').addClass('d-none');
        $('#copiadnierror').html('');
    }

    if (informemedicoexist) {
        $('#informemedicoerror').html(`<span class="text-danger">${erroresresp.informemedico}<span>`)
    } else {
        $('#informemedicoerror').addClass('d-none');
        $('#informemedicoerror').html('');
    }

    if (reciboserciviosexist) {
        $('#reciboservicioserror').html(`<span class="text-danger">${erroresresp.recibosercivios}<span>`)
    } else {
        $('#reciboservicioserror').addClass('d-none');
        $('#reciboservicioserror').html('');
    }

    if (carnetconadisexist) {
        $('#copiacarnetconadiserror').html(`<span class="text-danger">${erroresresp.carnetconadis}<span>`)
    } else {
        $('#copiacarnetconadiserror').addClass('d-none');
        $('#copiacarnetconadiserror').html('');
    }

    if (documentaciondigitalexist) {
        $('#documentaciondigitalerror').html(`<span class="text-danger">${erroresresp.documentaciondigital}<span>`)
    } else {
        $('#documentaciondigitalerror').addClass('d-none');
        $('#documentaciondigitalerror').html('');
    }

    if (domicilioexist) {
        $('#domicilioerror').html(`<span class="text-danger">${erroresresp.domicilio}<span>`)
    } else {
        $('#domicilioerror').addClass('d-none');
        $('#domicilioerror').html('');
    }

    if (fechanacimientoexist) {
        $('#fechanaciemientoerror').html(`<span class="text-danger">${erroresresp.fechanacimiento}<span>`)
    } else {
        $('#fechanaciemientoerror').addClass('d-none');
        $('#fechanaciemientoerror').html('');
    }

    // if (rocarnetconadisexist) {
    //     $('#rocarnetconadiserror').html(`<span class="text-danger">${erroresresp.rocarnetconadis}<span>`)
    // } else {
    //     $('#rocarnetconadiserror').addClass('d-none');
    //     $('#rocarnetconadiserror').html('');
    // }

    if (empadronamientosisfohexist) {
        $('#empadronamientosisfoherror').html(`<span class="text-danger">${erroresresp.empadronamientosisfoh}<span>`)
    } else {
        $('#empadronamientosisfoherror').addClass('d-none');
        $('#empadronamientosisfoherror').html('');
    }
}

function limpiarCampos() {
    $("#datosgeneralesregistrar").html('');
    $("#formularioextend").addClass('d-none');
    $("#boxheader").html('')
    $("#boxbodysection").html('')
}

function confirmacion(title, message, icon, cancel, canceltext, confirmtext) {
    return Swal.fire({
        title: `${title}`,
        html: `${message}`,
        icon: `${icon}`,
        allowOutsideClick: false,
        showCloseButton: false,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: `${confirmtext}`,
        showCancelButton: `${cancel}`,
        cancelButtonColor: "#d33",
        cancelButtonText: `${canceltext}`,
        focusConfirm: true,
    });
}

function mensaje(title, message, icon, textbtnconfirm) {
    return Swal.fire({
        title: `${title}`,
        html: `<p class="text-center">${message}</p>`,
        icon: `${icon}`,
        confirmButtonColor: "#3085d6",
        confirmButtonText: `${textbtnconfirm}`,
        allowOutsideClick: false,
    });
}

$(document).ready(function () {
    $(".combos").select2({
        theme: 'bootstrap-5',
        language: {
            noResults: function () {
                return "Sin resultados";
            },
            searching: function () {
                return "Buscando..";
            }
        }
    });
});

/**
 * funciones para la carga de la vista index (tablas y consultas)
 */

$("#buscarregistros").on('click', function () {
    let tipopersona = $("#tipopersonasbusqueda").val();
    $.ajax({
        type: "GET",
        url: `/personas/get-personas-tipo/${tipopersona}`,
        success: function (data) {
            $("#resultadodebusqueda").removeClass('d-none');
            cargarTabla(data)
        },
        error: function (err) {
            console.log(err);
        }
    });
});


function cargarTabla(data) {
    $('#tablapersonas').DataTable({
        order: [
            [0, "asc"]
        ],
        processing: true,
        // serverSide: true,
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        aLengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, "Todos"]
        ],
        data: data.data,
        columns: [{
            data: 'tipopersona'
        },
        {
            data: 'documento'
        },
        {
            data: 'nombres'
        },
        {
            data: 'apellidos'
        },
        {
            data: 'acciones'
        },
        ],
        "language": {
            "lengthMenu": "Mostrar " +
                `<select class="custom-select custom-select-sm form-control form-control-sm">
                        <option value='5'>5</option>
                        <option value='10'>10</option>
                        <option value='20'>20</option>
                        <option value='-1'>Todos</option>
                    </select>` +
                " registros por página",
            "zeroRecords": "Sin Resultados Actualmente",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin Resultados",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar: ",
            // "paginate": {
            //     "next": "Siguiente",
            //     "previous": "Anterior"
            // }
        },
        "bDestroy": true
    });
    $('.dt-layout-table').addClass('my-4');
    $('#tablapersonas_wrapper').addClass('mb-3');
}


function personaDetalle(personaid) {
    // $.ajax({
    //     type: "method",
    //     url: "url",
    //     data: "data",
    //     dataType: "dataType",
    //     success: function (response) {

    //     }
    // });

    console.log(personaid)
};

function alumnoDetalle(alumnoid) {
    $.ajax({
        type: "GET",
        url: `/personas/get-alumno-detalle/${alumnoid}`,
        success: function (response) {
            let data = response[0];
            $("#modalPersonas").modal("show");
            $("#modalComponentLabel").html('');
            $("#modalComponentLabel").html(`DETALLE DEL ALUMNO : ${data.nombre_alumno}`);
            $(".modal-body").html('');
            $(".modal-body").append(`
                <table class="table table-bordered">
                    <tr>
                        <td>DATOS DEL REPRESENTANTE</td>
                    </tr>
                    <tr>
                        <td>NOMBRES:</td>
                        <td>${data.nombre_rep}</td>
                    </tr>
                    <tr>
                        <td>CORREO:</td>
                        <td>${data.email_rep}</td>
                    </tr>
                    <tr>
                        <td>TELEFONO:</td>
                        <td>${data.tel_rep}</td>
                    </tr>
                </table>
            `);
        }
    });
};
