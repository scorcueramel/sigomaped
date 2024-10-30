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
                    <input name="taller_programa" type="radio" id="dias_${e.diaid}" onclick="javascript:inscritosPorDia(${e.diaid})">
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
                            ${e.personainscritainasistencia}
                        </td>
                        <td class="d-flex justify-content-center">
                            <div class="dropdown">
                                <button class="btn btn-outline btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="javascript:registrarInasistenciaAlumno(${e.personainscritaid},'${e.personainscritanombre}');"><i class="fa fa-plus"></i> Registrar Inasistencia</a>
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

function registrarInasistenciaAlumno(inscricionid,nombrealumno){
    $("#modalInasistencia").modal("show");
    $(".modal-body").html('');
    $(".modal-body").append(`
        <table class="table table-bordered">
            <tr>
                <td>NOMBRE DEL ALUMNO</td>
                <td>${nombrealumno}</td>
            </tr>
        <table>
    `);
}
