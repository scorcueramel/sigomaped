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
                $("#taller").html('');
                $("#talleresProgramas").removeClass('d-none');
                $("#taller").append(`
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
    // $("#radios-anio-periodo").html('');
    $("#dias").addClass('d-none');
    $("#radios_dias").html('');
    $("#datosAlumnos").addClass('d-none');
    $(".datos_alumnos").html('');
    let id = $(this).val();
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-dia-taller/${id}`,
        success: function (response) {
            // $("#aniosperiodos").removeClass('d-none');
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
                    console.log(e)
                    $(".datos_alumnos").append(`
                    <tr>
                        <td>
                            ${e.personainscritanombre}
                        </td>
                        <td>
                            ${e.personainscritadocumento}
                        </td>
                        <td>
                            0
                        </td>
                        <td class="d-flex justify-content-center">
                            <div class="dropdown">
                                <button class="btn btn-outline btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="javascript:registrarInasistenciaAlumno(${e.personainscritaid});"><i class="fa fa-plus"></i> Registrar Inasistencia</a>
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

function registrarInasistenciaAlumno(){
    $("#modalInasistencia").modal("show");
}
