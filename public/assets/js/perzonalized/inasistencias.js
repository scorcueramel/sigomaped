$('#programasAll').on('change', function () {
    let id = $(this).val();
    $("#talleresProgramas").addClass('d-none');
    // $("#aniosperiodos").addClass('d-none');
    $("#datosAlumnos").addClass('d-none');
    $("#dias").addClass('d-none');
    $("#radios_dias").html('');
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-talleres-programs/${id}`,
        success: function (response) {
            if (response.length > 0) {
                $("#tallerlistado").html('');
                $("#talleresProgramas").removeClass('d-none');
                $("#tallerlistado").append(`
                <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
            `);
                response.forEach((e) => {
                    $("#tallerlistado").append(`
                    <option value="${e.tallerid}">${e.tallernombre}</option>
                `);
                });
            }
        }
    });
});

$('#tallerlistado').on('change', function () {
    $("#dias").addClass('d-none');
    $("#radios_dias").html('');
    $("#datosAlumnos").addClass('d-none');
    $(".datos_alumnos").html('');
    let id = $(this).val();
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-dia-taller/${id}`,
        success: function (response) {
            $("#dias").removeClass('d-none');
            if (response.length > 0) {
                response.forEach((e) => {
                    $("#radios_dias").append(`
                <div class="radio">
                    <input name="taller_programa" type="radio" id="dias_${e.diaid}" data-diaid="${e.diaid}" onclick="javascript:inscritosPorDia(${e.diaid})">
                    <label for="dias_${e.diaid}">${e.dianombre}</label>
                </div>
                `);
                });
            }
        }
    });
});

function inscritosPorDia(diaid) {
    $("#datosAlumnos").addClass('d-none');
    $(".datos_alumnos").html('');
    let tallerid = $("#tallerlistado").val();
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-isncritos-dias/${tallerid}/${diaid}`,
        success: function (response) {
            if (response.length > 0) {
                $("#datosAlumnos").removeClass('d-none');
                response.forEach((e) => {
                    $(".datos_alumnos").append(`
                    <tr>
                        <td>
                            ${e.personainscritanombre}
                        </td>
                        <td>
                            ${e.personainscritadocumento}
                        </td>
                        <td>
                            ${e.personainscritaestado == 'I' ? '<span class="badge badge-pill badge-info">INSCRITO</span>' : '' || e.personainscritaestado == 'D' ? '<span class="badge badge-pill badge-success">DERIVADO</span>' : '' || e.personainscritaestado == 'R' ? '<span class="badge badge-pill badge-danger">RETIRADO</span>' : ''}
                        </td>
                        <td>
                            ${e.personainscritainasistencias}
                        </td>
                        <td class="d-flex justify-content-center">
                            <div class="dropdown">
                                <button class="btn btn-outline btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="javascript:registrarInasistenciaAlumno(${e.personainscritaid},${e.personainscritainasistencias},'${e.personainscritanombre}');"><i class="fa fa-plus"></i> Registrar Inasistencia</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
                });
            }
        }
    });
}

function registrarInasistenciaAlumno(inscripcionid, cantidadinasistencias, nombrealumno) {
    if (cantidadinasistencias >= 3) {
        return Swal.fire({
            title: `¡Registro Restringido!`,
            html: `<p class="text-center">Se restringió el registro debido a que el alumno ya cuenta con 3 inasistencias y por lo tanto ya fue retirado del curso.</p>`,
            icon: `warning`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: `Entiendo!`,
            allowOutsideClick: false,
        });
    }

    $("#modalInasistencia").modal("show");
    $(".modal-body").html('');
    $(".modal-body").append(`
        <table class="table table-bordered">
            <input type="hidden" value="${inscripcionid}" id="inscripcionid"/>
            <input type="hidden" value="1" id="inasistio"/>
            <tr>
                <td>NOMBRE DEL ALUMNO</td>
                <td>${nombrealumno}</td>
            </tr>
            <tr>
                <td>FECHA</td>
                <td>
                    <input class="form-control" type="date" id="fechainasistencia">
                    <div id="fechaerror" class="d-none">
                    </div>
                </td>
            </tr>
            <tr>
                <td>FALTA JUSTIFICADA</td>
                <td>
                    <div class="radio">
                        <input name="justificada" type="radio" id="sijustificada" value="1" onclick="javascript:mustraMotivoFalta('SI');">
                        <label for="sijustificada" class="mr-4">SI</label>
                        <input name="justificada" type="radio" id="nojustificada" value="0" onclick="javascript:mustraMotivoFalta('NO');" checked>
                        <label for="nojustificada">NO</label>
                    </div>
                </td>
            </tr>
            <tr class="d-none" id="motivoinasistencia">
                <td>MOTIVO</td>
                <td>
                    <textarea class="form-control" id="motivo" placeholder="Indica el motivo de la falta" maxlength="300"></textarea>
                    <small>Máximo 300 caracteres.</small>
                </td>
            </tr>
        <table>
    `);
}

function mustraMotivoFalta(justificada) {
    justificada == 'SI' ? $("#motivoinasistencia").removeClass('d-none') : '';
    justificada == 'NO' ? ($("#motivoinasistencia").addClass('d-none'), $('#motivo').val('')) : '';
}


$("#btnRegistrarInasistencia").on('click', function () {
    let inscripcionid = $("#inscripcionid").val();
    let inasistio = $("#inasistio").val();
    let fechainasistencia = $("#fechainasistencia").val();
    let justificada = $("input[name=justificada]:checked").val();
    let motivo = $("#motivo").val();
    let diaid = $("input[name=taller_programa]:checked").attr('data-diaid');

    let data = {
        inscripcionid,
        inasistio,
        fechainasistencia,
        justificada,
        motivo,
    }

    $.ajax({
        type: "POST",
        url: "/asistencia/store",
        data: data,
        success: function (response) {
            Swal.fire({
                title: `Registro Exitoso`,
                html: `<p class="text-center">Inasistencia registrada Correctamente.</p>`,
                icon: `success`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Entiendo!`,
                allowOutsideClick: false,
            }).then((result) => {
                $('#espera').val('0');
                if (result.isConfirmed) {
                    $("#modalInasistencia").modal("hide");
                    inscritosPorDia(diaid);
                }
            });
        },
        error: function (error) {
            let errores = error.responseJSON;
            mostrarSeccionErroes();
            gestionMensajes(errores.errors);
        }
    });

});

function mostrarSeccionErroes(){
    $("#fechaerror").removeClass('d-none');
}

function gestionMensajes(erroresresp) {
    let fecharegistroexist = 'fechainasistencia' in erroresresp;
    if (fecharegistroexist) {
        $('#fechaerror').html(`<span class="text-danger">${erroresresp.fechainasistencia}<span>`)
    } else {
        $('#fechaerror').addClass('d-none');
        $('#fechaerror').html('');
    }
}
