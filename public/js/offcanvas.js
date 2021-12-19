jQuery(document).ready(function($) {

    $("#save").on("click", function(e) {
        e.preventDefault();
        e.target.blur();
        var nombre = $("#nombre").val();
        var teventos = $("#tevento").val();
        var espacio = $("#espacio").val();
        var estatus = $("#select-estatus").val();
        var date_start = $("#started").val();
        var eventos = {
            title: nombre,
            start: date_start,
            tevento: teventos,
            espacio: espacio,
            estatus: estatus
        };
        // console.log(eventos);
        // return false;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/eventos/store",
            type: "POST",
            data: eventos,
            success: function(response) {

                $calendar.fullCalendar("refetchEvents");
                //console.log(response);
                var messaje = response;
                var type = messaje[0];
                var mess = messaje[1];
                //console.log(mess);
                if (type == 'error') {
                    toastr.error(mess, "", {
                        timeOut: 3000
                    });
                } else if (type == 'success') {
                    toastr.success(mess, "", {
                        timeOut: 3000
                    });
                } else {
                    toastr.info(mess, "", {
                        timeOut: 3000
                    });
                }
            },
            error: function() {
                toastr.error("No se ha podido crear el evento", "", {
                    timeOut: 3000
                });
            }
        });
        return false;
    });
    $('#cancel').on('click', function(e) {
        e.preventDefault();
        $('#crearEvento')[0].reset();
        $("#espacio").val();
        $calendar.fullCalendar('unselect');
        $calendar.fullCalendar("refetchEvents");
        //location.reload();
    });
    $("#uguardar").on("click", function(e) {
        e.preventDefault();

        var id = $("#id_up").val();
        var utitle = $("#unombre").val();
        var ustarts = $('#ustart').val();
        var ustart = ustarts + " 00:00:00";
        var uend = ustarts + " 23:59:59";
        var teventos = $('#utevento').val();
        var estatus = $('#uestatus').val();
        var eventos = {
            id: id,
            title: utitle,
            start: ustart,
            end: uend,
            tevento: teventos,
            estatus: estatus,
        };

        //console.log(uendz);
        //return false;
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/eventos/update',
            type: "POST",
            data: eventos,
            success: function(response) {
                //console.log(response);
                $calendar.fullCalendar("refetchEvents");
                var messaje = response;
                var type = messaje[0];
                var mess = messaje[1];
                if (type == 'error') {
                    toastr.error(mess, "", {
                        timeOut: 3000
                    });
                } else if (type == 'success') {

                    toastr.success(mess, "", {
                        timeOut: 3000
                    });
                } else {
                    toastr.info(mess, "", {
                        timeOut: 3000
                    });
                }
            },
            error: function() {
                toastr.error("Se ha presentado un problema al actualizar el evento", "", {
                    timeOut: 3000
                });
            }
        });
        return false;
    });
    $('#udelete').on('click', function(e) {
        e.preventDefault();

        var id = $("#id_up").val();
        Swal.fire({
            title: 'Está seguro?',
            text: "¡No podrás revertir esta acción!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
        }).then((result) => {
            if (result.value) {
                var eventos = {
                    id: id,
                };
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "POST",
                    url: '/eventos/destroy',
                    data: eventos,
                    success: function(response) {
                        //console.log(response);
                        var messaje = response;
                        var type = messaje[0];
                        var mess = messaje[1];
                        if (type == 'error') {
                            toastr.error(mess, "", {
                                timeOut: 3000
                            });
                        } else if (type == 'success') {
                            $('#modalEventEditar').modal('hide');
                            $calendar.fullCalendar("refetchEvents");
                            toastr.success(mess, "", {
                                timeOut: 3000
                            });
                        } else {
                            toastr.info(mess, "", {
                                timeOut: 3000
                            });
                        }
                        $calendar.fullCalendar("refetchEvents");
                    }
                });
            }
            $calendar.fullCalendar("refetchEvents");
            return false;
        })
    });
    $("#saveAddVenue").on('click', function(e) {
        e.preventDefault();

        var id = $("#idEventEdit").val();
        var espacios = $('#espacioadd').val();
        var datos = {
            evento_id: id,
            espacios: espacios
        }
        console.log(datos);
        //return false;
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/eventos/addvenue',
            type: "POST",
            data: datos,
            success: function(response) {
                //console.log(response);
                var datas = response;
                var type = datas[0];
                var mess = datas[1];
                if (type == 'info') {
                    toastr.info(mess, "", {
                        timeOut: 3000
                    });
                } else if (type == 'error') {
                    toastr.error(mess, "", {
                        timeOut: 3000
                    });
                } else {
                    $calendar.fullCalendar("refetchEvents");

                    $('#espacioadd').val('');
                    toastr.success('Evento actualizado!!', "", {
                        timeOut: 3000
                    });
                    var lista = $('#cargadatos');
                    if (datas) {
                        var content = '';
                        datas.forEach(function(data) {
                            content +=
                                '<tr>' +
                                '<td class="p-2 whitespace-normal flex items-center text-sm text-gray-800 text-uppercase">' +
                                '<span class="iconify w-6 h-6" data-icon="mdi:office-building-marker" data-inline="false"></span>' +
                                '<span class="pl-2">' + data.nombre + '</span></td>' +
                                '<td class="p-2">' +
                                '<button type="button" id="delespacio" class="px-2 text-red-800" onclick="eliminar(' + data.id + ', ' + data.evento_id + ')" >' +
                                '<span class="iconify w-6 h-6" data-icon="ph:x-circle" data-inline="false"></span>' +
                                '</button> ' +
                                '</td>' +
                                '</tr>'
                        })
                        lista.html(content);
                    }
                }
            },
            error: function(response) {
                toastr.error("Se ha presentado un problema al actualizar el evento", "Error", {
                    timeOut: 3000
                });
            }
        });
    });

    $('#uk-close').on('click', function() {
        $('#crearEvento')[0].reset();
        $calendar.fullCalendar('unselect');
        $('#uikit-create').hide();
        $calendar.fullCalendar("refetchEvents");
        return false;
    });
});

function eliminar(id, evento) {
    var espacio = id;
    var evento_id = evento;
    var datos = {
        espacio: espacio,
        evento: evento_id
    }
    console.log(datos);
    //return false;
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/eventos/deletevenue',
        type: "POST",
        data: datos,
        success: function(response) {
            //console.log(response);
            var datas = response;
            var type = datas[0];
            var mess = datas[1];
            if (type == 'info') {
                toastr.info(mess, "", {
                    timeOut: 3000
                });
            } else if (type == 'error') {
                toastr.error(mess, "", {
                    timeOut: 3000
                });
            } else {
                $calendar.fullCalendar("refetchEvents");
                toastr.success('Evento eliminado!!', "", {
                    timeOut: 3000
                });
                var lista = $('#cargadatos');
                if (datas) {
                    var content = '';
                    datas.forEach(function(data) {
                        content +=
                            '<tr>' +
                            '<td class="px-2 py-2 whitespace-normal flex items-center text-sm text-gray-800 text-uppercase">' +
                            '<span class="iconify w-6 h-6" data-icon="mdi:office-building-marker" data-inline="false"></span>' +
                            '<span class="pl-2">' + data.nombre + '</span></td>' +
                            '<td class="px-2">' +
                            '<button type="button" id="delespacio" class="px-2 text-red-800" onclick="eliminar(' + data.id + ', ' + data.evento_id + ')" >' +
                            '<span class="iconify w-6 h-6" data-icon="ph:x-circle" data-inline="false"></span>' +
                            '</button> ' +
                            '</td>' +
                            '</tr>'
                    })
                    lista.html(content);
                }
            }
        },
        error: function(response) {
            toastr.error("Se ha presentado un problema al actualizar el evento", "Error", {
                timeOut: 3000
            });
        }
    });
}