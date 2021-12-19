jQuery(document).ready(function($) {


    $("#bt-filter").on("click", function(e) {
        e.preventDefault();
        var inicio = $('#inicio').val();
        var fin = $('#fin').val();
        //$('#datosCargados').toggle();
        var datos = {
                start: inicio,
                end: fin
            }
            //console.log(datos);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/espacio/ocupado',
            type: 'GET',
            data: datos,
            dataType: 'json',
            success: function(response) {
                var data = response;
                var lista = $('#cargarDatos');
                //console.log(data);
                //return false;
                if (data) {
                    var len = data.lenght;
                    var content = '';
                    $.each(data, function(i, datos) {
                        content +=
                            '<tr>' +
                            '<td>' + datos.id + '</td>' +
                            '<td>' + datos.nombre + '</td>' +
                            '<td>' + datos.total + '</td>' +
                            '</tr>';
                    })
                    lista.html(content);
                }

            }

        })
    });
    $("#bt-filter2").on("click", function(e) {
        e.preventDefault();
        var inicio = $('#inicio2').val();
        var fin = $('#fin2').val();
        //$('#datosCargados').toggle();
        var datos = {
                start: inicio,
                end: fin
            }
            //console.log(datos);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/espacio/ocupar',
            type: 'GET',
            data: datos,
            dataType: 'json',
            success: function(response) {
                var data = response;
                var lista = $('#cargarDatos2');
                //console.log(data);
                //return false;
                if (data) {
                    var len = data.lenght;
                    var content = '';
                    $.each(data, function(i, datos) {
                        content +=
                            '<tr>' +
                            '<td>' + datos.id + '</td>' +
                            '<td>' + datos.nombre + '</td>' +
                            '<td>' + datos.total + '</td>' +
                            '</tr>';
                    })
                    lista.html(content);
                }

            }

        })
    })
})