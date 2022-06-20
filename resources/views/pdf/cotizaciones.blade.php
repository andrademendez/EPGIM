<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotizacion - GIM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="p-2 row ">
        <div class="col-md-6" style="margin-top:15px; ">
            <div>
                <span class="h5 d-inline">Empresa: </span>
                <span class="d-inline">{{ $campanias->cliente->nombre }}</span>
            </div>
            <div>
                <span class="h5 d-inline">Temporaridad:</span>
                <span class="d-inline">{{ $campanias->formatoMx($campanias->start) }} - {{
                    $campanias->formatoMx($campanias->end) }} </span>
            </div>
        </div>
        <!--  -->
        <div class="col-md-6" style="padding-top: 15px; ">
            <div>
                <span class="text-base h5">No. Co:</span>
                <span class="d-inline"> {{ $campanias->cotizacion->folio }} </span>
            </div>
            <div>
                <h1 class="h5 d-inline ">Fecha:</h1>
                <span class="d-inline">
                    {{ $campanias->formatoMx($campanias->cotizacion->created_at) }}
                </span>

            </div>
        </div>
    </div>

    <div style="padding-top: 15px;">
        <table class="table table-bordered">
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
                @foreach ($campanias->espacios as $espacio)
                <tr>
                    <td>{{ $espacio->unidad->ciudad->nombre }} </td>
                    <td>{{ $espacio->unidad->nombre }}</td>
                    <td>{{ $campanias->medio->nombre }}</td>
                    <td>{{ $espacio->cantidad }}</td>
                    <td>{{ $espacio->clave }}</td>
                    <td>{{ $espacio->referencia }}</td>
                    <td>{{ $espacio->medidas }}</td>
                    <td>$ {{ number_format($espacio->precio) }}.00</td>
                </tr>
                @endforeach

                <tr>
                    <td colspan="6">Total</td>
                    <td colspan="2">
                        <div>
                            $ {{ number_format($campanias->costoCampania($campanias->id)) }}.00
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <div class="fixed-bottom mb-3" style="margin-top: 15px">
        <span class="d-block ">Precios expresados en MN</span>
        <span class="d-block ">Precios al
            {{ $campanias->formatoMx($campanias->cotizacion->created_at) }}
        </span>
        <span class="d-block ">Tarifas mensuales</span>
        <span class="d-block ">El precio reflejado NO incluye IVA</span>
        <span class="d-block ">Se requiere anticipo del 50%</span>
    </div>
</body>

</html>
