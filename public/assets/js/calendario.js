function chargeCalendar(data = []) {

    let eventos = data.length <= 0 ? [] : data;

    moment.locale('es');
    var calendarEl = document.getElementById('calendario');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialView: 'dayGridMonth',
        allDaySlot: false,
        locale: 'es',
        timeZone: 'UTC',
        slotDuration: '00:30:00',
        /* If we want to split day time each 15minutes */
        slotMinTime: '08:00:00',
        slotMaxTime: '19:00:00',
        handleWindowResize: true,
        height: 600,
        headerToolbar: {
            left: 'today prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        buttonText: {
            today: 'Hoy',
            day: 'Día',
            week: 'Semana',
            month: 'Mes'
        },
        editable: false,
        selectable: false,
        slotLabelFormat: { //se visualizara de esta manera 01:00 AM en la columna de horas
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            meridiem: 'short'
        },
        eventTimeFormat: { //y este código se visualizara de la misma manera pero en el titulo del evento creado en fullcalendar
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            meridiem: 'short'
        },
        events: eventos,
        eventClick: function(calEvent) {
            $("#modalCalendar").modal('show');
            $("#modalComponentLabel").html('');
            $("#modalComponentLabel").html(`DETALLES DEL ALUMNO <span class="font-weight-bold">${calEvent.event.title}<span>`);
            $(".modal-body").html('');
            $(".modal-body").append(`
                <table class="table">
                    <tr>
                        <td>PROGRAMA</td>
                        <td>${calEvent.event.extendedProps.programa}</td>
                    </tr>
                    <tr>
                        <td>TALLER</td>
                        <td>${calEvent.event.extendedProps.taller}</td>
                    </tr>
                    <tr>
                        <td>AÑO Y PERIODO</td>
                        <td>${calEvent.event.extendedProps.anio} - ${calEvent.event.extendedProps.periodo}</td>
                    </tr>
                    <tr>
                        <td>REPRESENTANTE LEGAL</td>
                        <td>${calEvent.event.extendedProps.representante ?? '<span class="text-danger">INFORMACIÓN NO REGISTRADA<span>'}</td>
                    </tr>
                    <tr>
                        <td>TELFONO REPRESENTANTE</td>
                        <td>${calEvent.event.extendedProps.telefonorepre ?? '<span class="text-danger">INFORMACIÓN NO REGISTRADA<span>'}</td>
                    </tr>
                    <tr>
                        <td>CORREO REPRESENTANTE</td>
                        <td>${calEvent.event.extendedProps.correorepre ?? '<span class="text-danger">INFORMACIÓN NO REGISTRADA<span>'}</td>
                    </tr>
                <table>
            `);
        }
    });
    calendar.render();
}
