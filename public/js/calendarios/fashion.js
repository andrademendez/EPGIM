$(document).ready(function () {
    $fullFashion = $("#fullFashion");

    today = new Date();
    y = today.getFullYear();
    m = today.getMonth();
    d = today.getDate();

    $fullFashion.fullCalendar({
        editable: true,
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        dayNames: [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ],
        firstDay: (Monday = 1),
        selectHelper: true,
        showNonCurrentDates: true,

        // allow "more" link when too many events
        eventRender: function (event, element, view) {
            var allDay = true;
            if (event.allDay === "true") {
                event.allDay = true;
                allDay = event.allDay;
            } else {
                event.allDay = false;
                allDay = event.allDay;
            }
            element
                .find(".fc-title")
                .append(
                    "<div>" +
                        '<span id="ocupado-espacio" style="font-size: 10px"> </span><br>' +
                        "</div>"
                );
            espacios(element, event);
            element.find(".fc-time").hide();
        },
        eventOrder: "hold",
        // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
        events: {
            url: "/eventos/fashion",
            cache: false,
            lazyFetching: false,
        },
        viewRender: function (view, element) {
            // We make sure that we activate the perfect scrollbar when the view isn't on Month
            if (view.name != "days") {
                $(element).find(".fc-scroller").perfectScrollbar();
            }
        },
        header: {
            left: "today",
            center: "prevYear, prev, title, next, nextYear",
            right: "month,agendaWeek,agendaDay",
        },
        defaultDate: today,
        selectable: true,
        selectHelper: true,
        views: {
            month: {
                // name of view
                titleFormat: "MMMM YYYY",
                // other view-specific options here
            },
            week: {
                titleFormat: "D MMMM YYYY",
            },
            day: {
                titleFormat: "D MMM, YYYY",
            },
        },

        select: function (start, end, jsEvent) {
            $("#crearEvento")[0].reset();
            $("#uikit-create").modal("show");
            var start = $.fullCalendar.formatDate(start, "DD-MMM-Y");
            var end = $.fullCalendar.formatDate(end, "DD-MMM-Y");
            $("#start").val(start);
            $("#end").val(end);
        },
        editable: true,
        eventLimit: 4,

        eventDrop: function (event, end, jsEvent) {
            var ustart = $.fullCalendar.formatDate(
                event.start,
                "Y-MM-DD HH:mm:ss"
            );
            var uend = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var utitle = event.title;
            var id = event.id;
            //console.log(eventos);
            Swal.fire({
                title: "¿Está seguro de cambiar de fecha?",
                text: "Esta acción no se puede revertir!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, actualizar.",
            }).then((result) => {
                if (result.value) {
                    var datos = {
                        id: id,
                        title: utitle,
                        end: uend,
                        start: ustart,
                    };
                    console.log(datos);
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: "/eventos/drop",
                        type: "POST",
                        data: datos,
                        success: function (response) {
                            var messaje = response;
                            var type = messaje[0];
                            var mess = messaje[1];

                            if (type == "error") {
                                toastr.error(mess, "", {
                                    timeOut: 3000,
                                });
                            } else if (type == "success") {
                                $calendar.fullCalendar("refetchEvents");
                                //console.log(response);
                                toastr.success(mess, "", {
                                    timeOut: 3000,
                                });
                            } else {
                                toastr.info(mess, "", {
                                    timeOut: 3000,
                                });
                            }
                        },
                    });
                }
                $calendar.fullCalendar("refetchEvents");
                return false;
            });
        },
        eventClick: function (event, jsEvent, view) {
            $("#modificarEvento")[0].reset();
            $("#modalEventEditar").modal("show");
            var start = $.fullCalendar.formatDate(event.start, "DD-MMM-Y");
            var end = $.fullCalendar.formatDate(event.end, "DD-MMM-Y");

            $("#ustart").val(start);
            $("#uend").val(end);
            $("#unombre").val(event.title);
            $("#id_up").val(event.id);
            $("#idEventEdit").val(event.id);
            $("#uestatus").val(event.estado + " (Hold - " + event.hold + ")");
            let id = event.id;
            //Livewire.emit("openModalEvent", id);
            //console.log(view);
            //datos(id);
            var datos = {
                id: id,
            };
            collection(datos);
            consultar(datos);

            //parametros
        },
    });
});
