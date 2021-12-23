$(document).ready(function () {
    md.initFullCalendar();
});

$(".modal").modal({
    keyboard: false,
    show: false,
});
// Jquery draggable
$(".modal-dialog").draggable({
    handle: ".modalheader",
});

new Pikaday({
    field: document.getElementById("start"),
    format: "D-MMM-YYYY",
    firstDay: 1,
});
new Pikaday({
    field: document.getElementById("end"),
    format: "D-MMM-YYYY",
    firstDay: 1,
});

new Pikaday({
    field: document.getElementById("ustart"),
    format: "D-MMM-YYYY",
    firstDay: 1,
});

new Pikaday({
    field: document.getElementById("uend"),
    format: "D-MMM-YYYY",
    firstDay: 1,
});
