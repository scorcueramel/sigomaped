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
                    $(".datos_alumnos").append(`
                    <tr>
                        <td>
                            ${e.personainscritanombre}
                        </td>
                        <td>
                            ${e.personainscritadocumento}
                        </td>
                    </tr>
                `);
                });
            }
        }
    });
}

// function alumnosPorDiaYTaller(id) {
//     $("#datosAlumnos").addClass('d-none');
//     $(".datos_alumnos").html('');
//     $.ajax({
//         type: "GET",
//         url: `/inscripciones/get-inscritos-ciclo/${id}`,
//         success: function(response) {
//             if (response.length > 0) {
//                 $("#datosAlumnos").removeClass('d-none');
//                 response.forEach((e) => {
//                     $(".datos_alumnos").append(`
//                     <tr>
//                         <td>
//                             ${e.nombres}
//                         </td>
//                         <td>
//                             ${e.dia}
//                         </td>
//                         <td>
//                             ${e.hora_inicio}
//                         </td>
//                         <td>
//                             ${e.hora_fin}
//                         </td>
//                     </tr>
//                 `);
//                 });
//             }
//         }
//     });
// }


$('#tipoprograma').on('change', function () {
    let id = $(this).val();
    $("#programa").attr('disabled', 'disabled');
    $("#taller").attr('disabled', 'disabled');
    $("#taller").html('');
    $("#taller").append(`
    <option selected disabled value="">SELECCIONA UN TALLER</option>
    `);
    $("#programa").html('');
    $("#programa").append(`
    <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
    `);
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-programa-tipo/${id}`,
        success: function (response) {
            if (response.length > 0) {
                $("#programa").removeAttr('disabled');
                $("#programa").html('');
                $("#programa").append(`
                <option selected disabled value="">SELECCIONA UN PROGRAMA</option>
                `);
                response.forEach((e) => {
                    $("#programa").append(`
                    <option value="${e.programaid}">${e.nombre}</option>
                `);
                });
            }
        }
    });
});
$('#programa').on('change', function () {
    let id = $(this).val();
    $("#taller").attr('disabled', 'disabled');
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-talleres-programs/${id}`,
        success: function (response) {
            if (response.length > 0) {
                $("#taller").removeAttr('disabled');
                $("#taller").html('');
                $("#taller").append(`
                <option selected disabled value="">SELECCIONA UN TALLER</option>
                `);
                response.forEach((e) => {
                    $("#taller").append(`
                    <option value="${e.tallerid}">${e.tallernombre}</option>
                `);
                });
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});
$('#taller').on('change', function () {
    let tallerid = $(this).val();
    let tipoprograma = $("#tipoprograma").val();
    let programaid = $("#programa").val();
    $.ajax({
        type: "GET",
        url: `/inscripciones/calendar-paramas/${tipoprograma}/${programaid}/${tallerid}`,
        success: function (response) {
            if (response.length > 0) {
                chargeCalendar(response);
            } else {
                $.toast({
                    heading: 'Mensaje Informativo',
                    text: `No se encontraron inscripciones para tu búsqueda`,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'warning',
                    hideAfter: 5000,
                    stack: 6
                });
            }
        }
    });
});

$(document).ready(function () {
    chargeCalendar();
});


$("#buscador").on('click', function () {
    $("#tiposTalleres").addClass('d-none');
    $("#seccionprogramas").addClass('d-none');
    $("#radios-programas").html('');
    // $("#selecciontaller").addClass('d-none');
    $("#radios-talleres").html('');
    $("#ciclos").addClass('d-none');
    $("#radios-ciclos").html('');
    $("#dias").addClass('d-none');
    $("#dias-ciclo").html('');
    $("#tallerid").html('');
    $("#inscribirespera").addClass('d-none');
    $(".tallerselec").removeAttr('checked');

    let documento = $('#documento_alumno').val();

    if (documento == '') {
        $.toast({
            heading: 'Mensaje Informativo',
            text: `Debes ingresar un número de documento`,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 5000,
            stack: 6
        });
        return;
    }

    $.ajax({
        type: "GET",
        url: `/inscripciones/get-persona/${documento}`,
        success: function (response) {
            if (response.length > 0) {
                let data = response[0];
                $("#alumonid").val(data.id);
                $("#datosAlumno").removeClass('d-none');
                $(".datos_alumno").html('');
                $(".datos_alumno").append(`
                    <tr>
                        <td>
                            <input type="radio" name="alumnoid" id="alumno_${data.id}" onclick="javascript:$('#tiposTalleres').removeClass('d-none')">
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
                $("#datosAlumno").addClass('d-none');
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
});

function inscribirAlumno() {
    let alumnoId = $("#alumonid").val();
    let horarioId = $("#horarioid").val();
    let listaEspera = $("#espera").val();
    let tallerId = $("#tallerid").val();
    let cicloId = $("#cicloid").val();

    Swal.fire({
        icon: 'info',
        html: "Espere un momento porfavor ...",
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        type: "POST",
        url: "{{route('inscripciones.store')}}",
        data: {
            alumnoId,
            horarioId,
            listaEspera,
            cicloId,
            tallerId,
        },
        success: function (response) {
            if (response.code === 100) {
                mensaje("Ops", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    $('#espera').val('0');
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            } else if (response.code === 200) {
                mensaje("Alumno Inscrito", `${response.mensaje}`, "success", "Entendido!").then((result) => {
                    $('#espera').val('0');
                    if (result.isConfirmed) {
                        window.location.href = "{{route('inscripciones.index')}}";
                    }
                });
            } else if (response.code === 300) {
                mensaje("Alumno en Espera", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    $('#espera').val('0');
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            } else if (response.code === 400) {
                mensaje("Ops!", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    let listaEspera = $("#espera").val('2');
                    confirmacion("¿Deseas Continuar?", "Puedes Inscribit al alumno la lista de espera para el próximo ciclo a iniciar.", "question", true, "No Inscribir", "Si Inscribir").then((result) => {
                        if (result.isConfirmed) {
                            inscribirEspera();
                        } else if (result.dismiss) {
                            $('#espera').val('0');
                            mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!",);
                        }
                    });

                });
            } else if (response.code === 500) {
                mensaje("Ops", `${response.mensaje}`, "error", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            }
        }
    });

};

function inscribirEspera() {
    let alumnoId = $("#alumonid").val();
    let horarioId = $("#horarioid").val();
    let listaEspera = $("#espera").val();
    let tallerId = $("#tallerid").val();
    let cicloId = $("#cicloid").val();
    Swal.fire({
        icon: 'info',
        html: "Espere un momento porfavor ...",
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        type: "POST",
        url: "{{route('inscripciones.store')}}",
        data: {
            alumnoId,
            horarioId,
            listaEspera,
            cicloId,
            tallerId,
        },
        success: function (response) {
            if (response.code === 200)
                mensaje("Alumno en Espera", `${response.mensaje} recuerda que puedes visualizar el registro del alumno en la seccion de espera`, "success", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{route('inscripciones.index')}}";
                    }
                });
            else if (response.code === 300) {
                mensaje("Alumno en Espera", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            }
            else if (response.code === 500) {
                mensaje("Ops!", `${response.mensaje}`, "error", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            }
        }
    });
}

function continuarInscripcion(id, descripcion) {
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-talleres/${id}`,
        success: function (response) {
            if (response.length > 0) {
                $("#dias").addClass('d-none');
                $("#ciclos").addClass('d-none');
                // $("#selecciontaller").addClass('d-none');
                $("#seccionprogramas").removeClass('d-none');
                $("#programaTitulo").html(descripcion);
                $(".datos-programas").html('');
                response.forEach((e) => {
                    $(".datos-programas").append(`
                    <tr>
                        <td>
                            <input name="programa" type="radio" id="programa_${e.id}" onclick="javascript:consultaCiclos(${e.id},'${e.nombre}');$('#tallerid').val(${e.id})">
                            <label for="programa_${e.id}"></label>
                        </td>
                        <td>
                            <label for="programa_${e.id}">
                                ${e.nombre}
                            </label>
                        </td>
                        <td>
                            <label for="programa_${e.id}">
                                ${e.programa.nombre}
                            </label>
                        </td>

                    </tr>
                    `);
                });
            }
        }
    });
}

function limpiarCampos() {
    $("#documento_alumno").val('');
    $("#documento_alumno").focus();
    $("#datosAlumno").addClass('d-none');
    $(".datos_alumno").html('');
    $("#tiposTalleres").addClass('d-none');
    $("#seccionprogramas").addClass('d-none');
    $("#radios-programas").html('');
    // $("#selecciontaller").addClass('d-none');
    $("#radios-talleres").html('');
    $("#ciclos").addClass('d-none');
    $("#radios-ciclos").html('');
    $("#dias").addClass('d-none');
    $("#dias-ciclo").html('');
    $("#tallerid").html('');
    $("#inscribirespera").addClass('d-none');
}

function consultaProgramas(tipotallerid, descripcion) {
    let alumnoid = $("#alumonid").val();
    let contadorIndividuales = 0;
    let contadorGrupales = 0;
    let contadorRecreativas = 0;
    $("#seccionprogramas").addClass('d-none');
    // $("#selecciontaller").addClass('d-none');
    $("#radios-programas").html('');
    // pendiente para la validacion sobre la cantidad de talleres al que se encuentra inscrito el alumno
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-validacion/${tipotallerid}/${alumnoid}/inscripciones`,
        success: function (response) {
            response.forEach((e) => {
                if (alumnoid == e.persona_id && e.tipo_taller == 1) contadorGrupales++;
                if (alumnoid == e.persona_id && e.tipo_taller == 2) contadorIndividuales++;
                if (alumnoid == e.persona_id && e.tipo_taller == 3) contadorRecreativas++;
            });
            if (contadorIndividuales == 1) {
                confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>una</strong> clase <strong>INDIVIDUAL</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                    if (result.isConfirmed) {
                        $("#seccionprogramas").removeClass('d-none');
                        $('#espera').val('1');
                        continuarInscripcion(tipotallerid, descripcion);
                    } else if (result.dismiss) {
                        $('#espera').val('0');
                        mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!",);
                    }
                });
            } else if (contadorGrupales == 2) {
                confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>dos</strong> clases <strong>GRUPALES</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                    if (result.isConfirmed) {
                        $("#seccionprogramas").removeClass('d-none');
                        $('#espera').val('1');
                        continuarInscripcion(tipotallerid, descripcion);
                    } else if (result.dismiss) {
                        $('#espera').val('0');
                        mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!",);
                    }
                });
            } else if (contadorRecreativas == 3) {
                confirmacion("¿Deseas Continuar?", "El alumno ya se encuentra inscrito a <strong>tres</strong> clases <strong>RECREATIVAS</strong>, si lo inscribes pasará a una lista de espera para el próximo ciclo a iniciar.", "question", true, "No Continuar", "Continuar").then((result) => {
                    if (result.isConfirmed) {
                        $("#seccionprogramas").removeClass('d-none');
                        $('#espera').val('1');
                        continuarInscripcion(tipotallerid, descripcion);
                    } else if (result.dismiss) {
                        $('#espera').val('0');
                        mensaje("¡Cancelado!", "Puedes verificar los programas a los que se encuentra inscrito el alumno en la sección de <strong>INSCRITOS</strong>", "warning", "Entendido!",);
                    }
                });
            } else {
                $('#espera').val('0');
                continuarInscripcion(tipotallerid, descripcion);
            }
        }
    });
}

// function consultaTalleres(id, descripcion) {
//     let titulo = descripcion.includes("TALLER") ? descripcion.substring(6, descripcion.length, -1) : '';
//     $("#radios-talleres").html('');
//     $("#ciclos").addClass('d-none');
//     // $("#selecciontaller").addClass('d-none');
//     $("#dias").addClass('d-none');
//     $.ajax({
//         type: "GET",
//         url: `/inscripciones/get-talleres/${id}`,
//         success: function(response) {
//             if (response.length > 0) {
//                 // $("#selecciontaller").removeClass('d-none');
//                 $("#tallerTitulo").html(`TALLERES ${titulo}`);
//                 response.forEach((e) => {
//                     $("#radios-talleres").append(`
//                     <div class="radio">
//                         <input name="taller" type="radio" id="taller_${e.id}" onclick="javascript:consultaCiclos(${e.id},'${descripcion}');$('#tallerid').val(${e.id})">
//                         <label for="taller_${e.id}">${e.nombre}</label>
//                     </div>
//                     `);
//                 });
//             }
//         }
//     });
// }

function consultaCiclos(id, descripcion) {
    let espera = $("#espera").val();

    if (espera == 0) {
        $('#tallerid').val(id);
        $("#radios-ciclos").html("");
        $("#ciclos").addClass("d-none");
        $("#dias").addClass("d-none");
        $.ajax({
            type: "GET",
            url: `/inscripciones/get-ciclos/${id}`,
            success: function (response) {
                if (response.length > 0) {
                    $("#ciclos").removeClass("d-none");
                    $("#cicloTitulo").html(`${descripcion}`);
                    response.forEach((e) => {
                        $("#radios-ciclos").append(`
                        <tr>
                            <td>
                                <input type="radio" name="ciclos" id="ciclo_${e.id}" onclick="javascript:consultaHorariosCiclos(${e.id},'${e.anio}')">
                                <label for="ciclo_${e.id}"></label>
                            </td>
                            <td>
                                <label for="ciclo_${e.id}">${e.anio}</label>
                            </td>
                            <td>
                                <label for="ciclo_${e.id}">${e.periodo.periodo}</label>
                            </td>
                            <td class="text-center">
                                <label for="ciclo_${e.id}">${e.fecha_inicio}</label>
                            </td>
                            <td class="text-center">
                                <label for="ciclo_${e.id}">${e.fecha_fin}</label>
                            </td>
                        </tr>
                    `);
                    });
                }
            }
        });
    } else {
        $('#inscribirespera').removeClass('d-none');
    }
}

function consultaHorariosCiclos(id, descripcion) {
    $("#cicloid").val(id);
    $("#dias-ciclo").html("");
    $("#dias").addClass("d-none");
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-horarios-ciclos/${id}`,
        success: function (response) {
            $("#diaTitulo").html(`${descripcion}`);
            if (response.length > 0) {
                $("#dias").removeClass("d-none");
                response.forEach((e) => {
                    $("#dias-ciclo").append(`
                        <tr>
                            <td>
                                <input type="radio" name="cliclodia" id="dia_${e.id}" onclick="javascript:activaInscripcionAsignaDiaId(${e.id})">
                                <label for="dia_${e.id}"></label>
                            </td>
                            <td>
                                <label for="dia_${e.id}">${e.dia}</label>
                            </td>
                            <td>
                                <label for="dia_${e.id}">${e.hora_inicio}</label>
                            </td>
                            <td>
                                <label for="dia_${e.id}">${e.hora_fin}</label>
                            </td>
                            <td class="text-center">
                                <label for="dia_${e.id}">${e.cupo_maximo}</label>
                            </td>
                            <td class="text-center">
                                <label for="dia_${e.id}">${e.cupo_actual}</label>
                            </td>
                        </tr>
                    `);
                });
            } else {
                $("#dias").addClass("d-none");
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

function activaInscripcionAsignaDiaId(diaid) {
    $("#inscribiralumno").removeClass("disabled");
    $("#horarioid").val(diaid);
}

function confirmacion(title, message, icon, cancel, canceltext, confirmtext) {
    return Swal.fire({
        title: `${title}`,
        html: `<p class="text-cecnter">${message}</p>`,
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
