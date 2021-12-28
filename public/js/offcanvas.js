jQuery(document).ready(function ($) {
    $("#save").on("click", function (e) {
        e.preventDefault();
        var nombre = $("#nombre").val();
        var medio = $("#medio").val();
        var espacio = $("#espacio").val();
        var cliente = $("#cliente").val();
        var date_start = $("#start").val();
        var date_end = $("#end").val();
        var campania = {
            title: nombre,
            start: date_start,
            end: date_end,
            medio: medio,
            cliente: cliente,
            espacio: espacio,
        };
        console.log(campania);
        //return false;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/campanias",
            type: "POST",
            data: campania,
            success: function (response) {
                $calendar.fullCalendar("refetchEvents");
                //console.log(response);
                var messaje = response;
                var type = messaje[0];
                var mess = messaje[1];
                //console.log(mess);
                if (type == "error") {
                    toastr.error(mess, "", {
                        timeOut: 3000,
                    });
                } else if (type == "success") {
                    toastr.success(mess, "", {
                        timeOut: 3000,
                    });
                } else {
                    toastr.info(mess, "", {
                        timeOut: 3000,
                    });
                }
            },
            error: function () {
                toastr.error("No se ha podido crear la campaña", "", {
                    timeOut: 3000,
                });
            },
        });
        return false;
    });
    $("#cancel").on("click", function (e) {
        e.preventDefault();
        $("#crearEvento")[0].reset();
        $("#espacio").val();
        $calendar.fullCalendar("unselect");
        $calendar.fullCalendar("refetchEvents");
        //location.reload();
    });
    $("#uguardar").on("click", function (e) {
        e.preventDefault();

        let id = $("#id_up").val();
        let title = $("#unombre").val();
        let starts = $("#ustart").val();
        let start = starts + " 00:00:00";
        let end = starts + " 23:59:59";
        let teventos = $("#utevento").val();
        let eventos = {
            id: id,
            title: title,
            start: start,
            end: end,
            tevento: teventos,
        };

        //console.log(uendz);
        //return false;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/eventos/update",
            type: "POST",
            data: eventos,
            success: function (response) {
                //console.log(response);
                $calendar.fullCalendar("refetchEvents");
                var messaje = response;
                var type = messaje[0];
                var mess = messaje[1];
                if (type == "error") {
                    toastr.error(mess, "", {
                        timeOut: 3000,
                    });
                } else if (type == "success") {
                    toastr.success(mess, "", {
                        timeOut: 3000,
                    });
                } else {
                    toastr.info(mess, "", {
                        timeOut: 3000,
                    });
                }
            },
            error: function () {
                toastr.error(
                    "Se ha presentado un problema al actualizar el evento",
                    "",
                    {
                        timeOut: 3000,
                    }
                );
            },
        });
        return false;
    });
    $("#delete").on("click", function (e) {
        e.preventDefault();

        let id = $("#id_up").val();

        console.log(id);
        Swal.fire({
            title: "Está seguro?",
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!",
        }).then((result) => {
            if (result.value) {
                let eventos = {
                    id: id,
                };
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    url: "/campanias/delete",
                    type: "POST",
                    data: eventos,
                    success: function (response) {
                        //console.log(response);
                        var messaje = response;
                        var type = messaje[0];
                        var mess = messaje[1];
                        if (type == "error") {
                            toastr.error(mess, "", {
                                timeOut: 3000,
                            });
                        } else if (type == "success") {
                            $("#modalEventEditar").modal("hide");
                            $calendar.fullCalendar("refetchEvents");
                            toastr.success(mess, "", {
                                timeOut: 3000,
                            });
                        } else {
                            toastr.info(mess, "", {
                                timeOut: 3000,
                            });
                        }
                        $calendar.fullCalendar("refetchEvents");
                    },
                });
            }
            $calendar.fullCalendar("refetchEvents");
            return false;
        });
    });
    $("#saveAddVenue").on("click", function (e) {
        e.preventDefault();

        var id = $("#idEventEdit").val();
        var espacios = $("#espacioadd").val();
        var datos = {
            id: id,
            espacios: espacios,
        };
        console.log(datos);
        //return false;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/campanias/addespacio",
            type: "POST",
            data: datos,
            success: function (response) {
                //console.log(response);
                var datas = response;
                var type = datas[0];
                var mess = datas[1];
                if (type == "info") {
                    toastr.info(mess, "", {
                        timeOut: 3000,
                    });
                } else if (type == "error") {
                    toastr.error(mess, "", {
                        timeOut: 3000,
                    });
                } else {
                    $calendar.fullCalendar("refetchEvents");

                    $("#espacioadd").val("");
                    toastr.success("Evento actualizado!!", "", {
                        timeOut: 3000,
                    });
                    var lista = $("#cargadatos");
                    if (datas) {
                        var content = "";
                        datas.forEach(function (data) {
                            content +=
                                "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>" +
                                "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white'>" +
                                '<span class="iconify w-6 h-6" data-icon="mdi:office-building-marker" data-inline="false"></span>' +
                                '<span class="pl-2">' +
                                data.nombre +
                                "</span>" +
                                "</td>" +
                                "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white'>" +
                                '<button type="button" id="delespacio" class="px-2 text-red-800" onclick="eliminar(' +
                                data.id +
                                ", " +
                                data.id_campania +
                                ')" >' +
                                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' +
                                "</button> " +
                                "</td>" +
                                "</tr>";
                        });
                        lista.html(content);
                    }
                }
            },
            error: function (response) {
                toastr.error(
                    "Se ha presentado un problema al actualizar el evento",
                    "Error",
                    {
                        timeOut: 3000,
                    }
                );
            },
        });
    });

    $("#uk-close").on("click", function () {
        $("#crearEvento")[0].reset();
        $calendar.fullCalendar("unselect");
        $("#uikit-create").hide();
        $calendar.fullCalendar("refetchEvents");
        return false;
    });
});

function eliminar(id, evento) {
    var espacio = id;
    var evento_id = evento;
    var datos = {
        espacio: espacio,
        id: evento_id,
    };
    console.log(datos);
    //return false;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/campanias/delespacio",
        type: "POST",
        data: datos,
        success: function (response) {
            //console.log(response);
            var datas = response;
            var type = datas[0];
            var mess = datas[1];
            if (type == "info") {
                toastr.info(mess, "", {
                    timeOut: 3000,
                });
            } else if (type == "error") {
                toastr.error(mess, "", {
                    timeOut: 3000,
                });
            } else {
                $calendar.fullCalendar("refetchEvents");
                toastr.success("Espacio eliminado!!", "", {
                    timeOut: 3000,
                });
                var lista = $("#cargadatos");
                if (datas) {
                    var content = "";
                    datas.forEach(function (data) {
                        content +=
                            "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>" +
                            "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white'>" +
                            '<span class="iconify w-6 h-6" data-icon="mdi:office-building-marker" data-inline="false"></span>' +
                            '<span class="pl-2">' +
                            data.nombre +
                            "</span></td>" +
                            "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white'>" +
                            '<button type="button" id="delespacio" class="px-2 text-red-800" onclick="eliminar(' +
                            data.id +
                            ", " +
                            data.campania_id +
                            ')" >' +
                            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' +
                            "</button> " +
                            "</td>" +
                            "</tr>";
                    });
                    lista.html(content);
                }
            }
        },
        error: function (response) {
            toastr.error(
                "Se ha presentado un problema al actualizar el evento",
                "Error",
                {
                    timeOut: 3000,
                }
            );
        },
    });
}
