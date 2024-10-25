function consultaCiclos(tallerid, programa) {
    $("#radios-ciclos").html("");
    $("#ciclos").addClass("d-none");
    $("#dias").addClass("d-none");
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-ciclos/${tallerid}`,
        success: function(response) {
            if (response.length > 0) {
                $("#ciclos").removeClass("d-none");
                $("#cicloTitulo").html(`${programa}`);
                response.forEach((e) => {
                    $("#radios-ciclos").append(`
                        <tr>
                            <td>
                                <input type="radio" name="ciclos" id="ciclo_${e.id}" onclick="javascript:consultaHorariosCiclos(${e.id},'${e.anio}','${e.periodo.periodo}')">
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
}

function consultaHorariosCiclos(id, anio, periodo) {
    $("#cicloid").val(id);
    $("#dias-ciclo").html("");
    $("#dias").addClass("d-none");
    $.ajax({
        type: "GET",
        url: `/inscripciones/get-horarios-ciclos/${id}`,
        success: function(response) {
            $("#anio").html(`${anio}`);
            $("#periodo").html(`${periodo}`);
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
                            <td>
                                <label for="dia_${e.id}">${e.cupo_maximo}</label>
                            </td>
                            <td>
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

function inscribirAlumno() {
    let alumnoId = $("#alumonid").val();
    let horarioId = $("#horarioid").val();
    let listaEspera = "1";
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
        url: "/inscripciones/store",
        data: {
            alumnoId,
            horarioId,
            listaEspera,
            cicloId,
            tallerId,
        },
        success: function(response) {
            if (response.code === 100)
                mensaje("Ops", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            else if (response.code === 200)
                mensaje("Alumno Inscrito", `${response.mensaje}`, "success", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/inscripciones/index";
                    }
                });
            else if (response.code === 300)
                mensaje("Alumno en Espera", `${response.mensaje}`, "warning", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            else if (response.code === 400)
                mensaje("Ops!", `Ya no quedan cupos en este periodo para el taller elejido, el alumno continuará en la lista de espera para la apertura de un nuevo ciclo.`, "warning", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
            else if (response.code === 500)
                mensaje("Ops", `${response.mensaje}`, "error", "Entendido!").then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                    }
                });
        }
    });

};

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
        html: `${message}`,
        icon: `${icon}`,
        confirmButtonColor: "#3085d6",
        confirmButtonText: `${textbtnconfirm}`,
        allowOutsideClick: false,
    });
}





function personasPorTaller(tallerid) {
    $("#datos_alumno").html('');
    $.ajax({
        type: "GET",
        url: `/lista-espera/get-personas-espera/${tallerid}`,
        success: function(response) {
            console.log(response)
            if (response.length > 0) {
                $("#datosAlumno").removeClass('d-none');
                response.forEach((e) => {
                    $("#datos_alumno").append(`
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline btn-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="javascript:inscribirAlumnoTaller(${e.personaid},${tallerid});"><i class="fa fa-plus"></i> Inscribir</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="javascript:quitarDeEspera('${e.nombres} ${e.apellidos}',${e.persona_id},${tallerid})"><i class="fa fa-trash-o"></i>Quitar de Espera</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${e.nombres}
                            </td>
                            <td>
                                ${e.apellidos}
                            </td>
                            <td>
                                ${e.documento}
                            </td>
                        </tr>
                    `);
                });
            }
        }
    });
}

function inscribirAlumnoTaller(personaid, tallerid) {
    Swal.fire({
        title: "¿Inscribir Alumno?",
        html: `¿Deseas inscribir al alumno a un nuevo ciclo?`,
        icon: "question",
        allowOutsideClick: false,
        showCloseButton: false,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        focusConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/lista-espera/create/${personaid}/${tallerid}`;
        }
    });
}

function quitarDeEspera(nombres, personaid, tallerid) {
    Swal.fire({
        title: `¿Quitar de la lista?`,
        html: `<p class="text-center">¿Deseas <strong><span class="font-weight-bold">Quitar</span></strgon> a ${nombres} de la lista de espera?</p>`,
        icon: `warning`,
        allowOutsideClick: false,
        showCloseButton: false,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: `Si`,
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: `No`,
        focusConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: `/lista-espera/delete/${personaid}/${tallerid}`,
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: "success",
                            title: `${response.mensaje}`,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Entendido!",
                        }).then((resp) => {
                            if(resp.isConfirmed){
                                window.location.reload();
                            }
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                title: 'Cancelado',
                html: `<p class="text-center"><strong><span class="font-weight-bold">Recuerda:</span></strong> si quitas al alumno de la lista de espera no podras recuperarlo hasta que se vuelva a inscribir en la lista de espera</p>`,
                icon: `info`,
                allowOutsideClick: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: 'Entendido!',
            });
        }
    });
}
