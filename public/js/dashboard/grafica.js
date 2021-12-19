$(document).ready(function () {
    $.ajax({
        url: "php/datos.php",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function (data) {
            var nombre = [];
            var stock = [];
            var color = [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
            ];
            var bordercolor = [
                "rgba(255,99,132,1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
            ];
            console.log(data);

            for (var i in data) {
                nombre.push(data[i].nombre);
                stock.push(data[i].stock);
            }

            var chartdata = {
                labels: nombre,
                datasets: [
                    {
                        label: nombre,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 2,
                        hoverBackgroundColor: color,
                        hoverBorderColor: bordercolor,
                        data: stock,
                    },
                ],
            };

            var mostrar = $("#miGrafico");

            var grafico = new Chart(mostrar, {
                type: "doughnut",
                data: chartdata,
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                        ],
                    },
                },
            });
        },
        error: function (data) {
            console.log(data);
        },
    });
});
