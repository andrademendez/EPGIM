<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        {{-- <img src="{{ asset('images/gim-1.png') }}" alt="" class="h-16"> --}}
                        <hr>
                        <span>GRUPO Inmobiliario Monterrey</span>
                    </td>
                    <td>
                        <div>
                            <h4>No. Co:</h4>
                        </div>
                        <div>
                            <h4>Fecha:</h4>
                            <span>
                                <?php
                                // Obteniendo la fecha actual del sistema con PHP
                                    $fechaActual = date('d-m-Y');
                                    echo $fechaActual;
                                ?>
                            </span>

                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
        <div>
            <div>
                <h4>Empresa: </h4>
                <span></span>
            </div>
            <div>
                <h4>Temporaridad:</h4>
                <span></span>
            </div>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Municipio</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Medio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Precio Lista</th>
                    </tr>
                </thead>
                <tbody>



                </tbody>

            </table>
        </div>
    </div>
</body>

</html>
