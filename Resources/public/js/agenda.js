require(['jquery', 'routing', 'fullcalendar'], function($, Router) {

    var $calendar = $('#agenda-calendar');

    $calendar.fullCalendar({
        lang: $('html').attr('lang'),
        header: {
            left: 'month, agendaWeek, agendaDay',
            center: 'title',
            right: 'prev, next'
        },
        lazyFetching: true,
        //timeFormat: 'H:mm',
        aspectRatio: 2,
        eventSources: [{
            url: Router.generate('ekyna_agenda_api_load_events'),
            type: 'POST',
            data: {},
            error: function() {
                //alert('There was an error while fetching Google Calendar!');
            }
        }],
        eventRender: function(event, element) {
            var $ctrl = $('<div class="agenda-event-ctrl"></div>');

            var $show = $('<a><span class="glyphicon glyphicon-pencil"></span></a>');
            $show.text(event.title);
            $show.attr('href', Router.generate('ekyna_agenda_event_admin_show', {'eventId': event.id}));
            $ctrl.append($show);

            var $edit = $('<a class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>');
            $edit.attr('href', Router.generate('ekyna_agenda_event_admin_edit', {'eventId': event.id}));
            $ctrl.append($edit);

            var $delete = $('<a class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>');
            $delete.attr('href', Router.generate('ekyna_agenda_event_admin_remove', {'eventId': event.id}));
            $ctrl.append($delete);

            if (!event.enabled) {
                element.css({borderStyle: 'dotted'});
            }

            element.qtip({
                content: $ctrl,
                style: {classes: 'qtip-bootstrap'},
                hide: {
                    fixed: true,
                    delay: 300
                },
                position: {
                    my: 'bottom center',
                    at: 'top center',
                    target: 'mouse',
                    viewport: $calendar,
                    adjust: {
                        mouse: false,
                        scroll: false
                    }
                }
            });
        }
    });

});