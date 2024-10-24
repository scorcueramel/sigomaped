!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$calendar = $('#calendar'),
        this.$modal = $('#modalCalendar'),
        this.$calendarObj = null
    };

    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {

        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });

    },
    /* Initializing */
    CalendarApp.prototype.init = function(e) {

        // var defaultEvents =  typeof(e) == 'undefined' ? null : e;

        var $this = this;

        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:30:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',
            defaultView: 'month',
            handleWindowResize: true,
            height: 680,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: false, // allow "more" link when too many events
            selectable: false,
            events: e,
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
        });

    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery)

// End of use strict

// //initializing CalendarApp
// function($) {
//     "use strict";
//     $.CalendarApp.init()

// }(window.jQuery);// End of use strict
