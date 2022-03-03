$(document).ready(function () {
    md.initFullCalendar();
    md.initFormExtendedDatetimepickers();
});

$(".modal").modal({
    keyboard: false,
    show: false,
});
// Jquery draggable
$(".modal-dialog").draggable({
    handle: ".modalheader",
});
