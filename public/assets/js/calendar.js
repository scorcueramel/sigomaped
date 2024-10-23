!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$calendar = $('#calendar'),
        this.$modal = $('#modalCalendar'),
        this.$calendarObj = null
    };


    /* on drop */
    // CalendarApp.prototype.onDrop = function (eventObj, date) {
    //     var $this = this;
    //         // retrieve the dropped element's stored Event Object
    //         var originalEventObject = eventObj.data('eventObject');
    //         var $categoryClass = eventObj.attr('data-class');
    //         // we need to copy it, so that multiple events don't have a reference to the same object
    //         var copiedEventObject = $.extend({}, originalEventObject);
    //         // assign it the date that was reported
    //         copiedEventObject.start = date;
    //         if ($categoryClass)
    //             copiedEventObject['className'] = [$categoryClass];
    //         // render the event on the calendar
    //         $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
    //         // is the "remove after drop" checkbox checked?
    //         if ($('#drop-remove').is(':checked')) {
    //             // if so, remove the element from the "Draggable Events" list
    //             eventObj.remove();
    //         }
    // },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
    },

    /* Initializing */
    CalendarApp.prototype.init = function() {
        var today = new Date($.now());

        var defaultEvents =  [{
                title: 'Released Ample Admin!',
                start: '2024-10-08',
				end: '2024-10-08',
                className: 'bg-info'
            }, {
                title: 'This is today check date',
                start: today,
                end: today,
                className: 'bg-danger'
            }, {
                title: 'This is your birthday',
                start: '2017-09-08',
				end: '2017-09-08',
                className: 'bg-info'
            },
              {
                title: 'Hanns birthday',
                start: '2017-10-08',
				end: '2017-10-08',
                className: 'bg-danger'
            },{
                title: 'Like it?',
                start: new Date($.now() + 784800000),
                className: 'bg-success'
            }];

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:30:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',
            defaultView: 'month',
            handleWindowResize: true,

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: false, // allow "more" link when too many events
            selectable: false,
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),// End of use strict

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()

}(window.jQuery);// End of use strict
