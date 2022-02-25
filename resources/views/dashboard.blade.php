<x-material-layout :activePage="'dashboard'" :menuParent="'dashboard'">
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="titlePage">Dashboard</x-slot>

    <div class="p-2">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="pb-3 text-lg font-medium">
                        <h1>Overview</h1>
                    </div>
                    <div class="grid grid-cols-8 gap-2 ">
                        <div class="col-span-8 md:col-span-2  rounded-lg">
                            <x-dashboard.card>
                                <h1 class="text-2xl font-bold">${{number_format($totalVenta) }}.00</h1>
                                <span class="text-sm uppercase text-gray-100 font-medium">Costo Total de Espacios</span>
                            </x-dashboard.card>
                        </div>
                        <div class="col-span-8 md:col-span-6">
                            <div class="grid grid-cols-8 gap-2">
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">${{ number_format($ventaUnidad['Airó']) }}.00
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Airó</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">${{ number_format($ventaUnidad['Fashion Drive'])
                                            }}.00
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Fashion Drive</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">${{ number_format($ventaUnidad['Main Entrance'])
                                            }}.00
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Main Entrance</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">${{ number_format($ventaUnidad['Showcenter'])
                                            }}.00</h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Showcenter</span>
                                    </x-dashboard.card>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-6 gap-4 pt-5">
                        <div class="col-span-6 md:col-span-2 md:col-span-2 shadow-lg px-2">
                            <canvas id="ocupacionPorcentual" width="400" height="200"></canvas>
                        </div>
                        <div class="col-span-6 md:col-span-2 px-2 shadow-lg">
                            <canvas id="ocupacionMonetaria" width="400" height="200"></canvas>
                        </div>
                        <div class="col-span-6 md:col-span-2 px-2 shadow-lg">
                            <canvas id="ocupacionPorEspacio" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 grid grid-cols-6 gap-4 ">
                        <div class="col-span-6 md:col-span-2 ">
                            <div class="shadow-lg rounded-lg p-3  m-2">
                                <div class="py-4  font-medium text-sm ">
                                    <h1>Data dristribution</h1>
                                </div>
                                <div class="grid grid-cols-4 gap-2">
                                    <div class="col-span-3">
                                        <ul class="text-sm font-normal text-gray-500 px-4 list-disc space-y-3">
                                            <li>Airó</li>
                                            <li>Fashion Drive</li>
                                            <li>Main Entrance</li>
                                            <li>Showcenter</li>
                                        </ul>
                                    </div>
                                    <div class="col-span-1">
                                        <ul class="text-sm font-normal text-gray-500 px-1 space-y-3">
                                            <li>10</li>
                                            <li>2</li>
                                            <li>4</li>
                                            <li>5</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-4 shadow-lg p-3 rounded-lg  m-2">
                            <div class="py-3">
                                <h1>Productos populares</h1>
                            </div>
                            <x-table.table>
                                <x-slot name="theader">
                                    <x-table.th>Pantalla</x-table.th>
                                    <x-table.th>Tipo</x-table.th>
                                    <x-table.th>Ubicacion</x-table.th>
                                    <x-table.th>Precio</x-table.th>
                                    <x-table.th>Fecha</x-table.th>
                                </x-slot>
                                <x-table.tr>
                                    <x-table.td>L1</x-table.td>
                                    <x-table.td>Digital</x-table.td>
                                    <x-table.td>Exterior</x-table.td>
                                    <x-table.td>$120,000.00</x-table.td>
                                    <x-table.td>10 enero 2022</x-table.td>
                                </x-table.tr>
                                <x-table.tr>
                                    <x-table.td>L2</x-table.td>
                                    <x-table.td>Digital</x-table.td>
                                    <x-table.td>Exterior</x-table.td>
                                    <x-table.td>$180,000.00</x-table.td>
                                    <x-table.td>31 diciembre 2021</x-table.td>
                                </x-table.tr>
                                <x-table.tr>
                                    <x-table.td>L3</x-table.td>
                                    <x-table.td>Digital</x-table.td>
                                    <x-table.td>Exterior</x-table.td>
                                    <x-table.td>$143,000.00</x-table.td>
                                    <x-table.td>31 diciembre 2021</x-table.td>
                                </x-table.tr>
                            </x-table.table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        let totalEspacioVenta = {{Js::from($totalChart)}};
        let totalVentaPorcentaje = {{Js::from($totalPorcentaje)}};
        let unidadesNombre = {{Js::from($unidades->pluck('nombre'))}};
        let unidadNombre = {{Js::from($ventaPorUnidad->pluck('unidad'))}};
        let unidadTotal = {{Js::from($ventaPorUnidad->pluck('total'))}};

        const ocupacionPorcentual = document.getElementById('ocupacionPorcentual');
        // const ctx = document.getElementById('myChart');
        const ocupacionMonetaria = document.getElementById('ocupacionMonetaria');
        const ocupacionPorEspacio = document.getElementById('ocupacionPorEspacio');
        new Chart(ocupacionPorcentual, {
            type: 'doughnut',
            data: {
                labels: ['Ocupado', 'Disponible'],
                datasets: [{
                    data: totalVentaPorcentaje,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'OCUPACIÓN PORCENTUAL',
                    },
                },
            }
        });
        new Chart(ocupacionMonetaria, {
            type: 'doughnut',
            data: {
                labels: ['Ocupado', 'Disponible'],
                datasets: [{
                    label: '# of Votes',
                    data: totalEspacioVenta,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'OCUPACIÓN MONETARIA',
                    }
                }
            }
        });

        new Chart(ocupacionPorEspacio, {
            type: 'doughnut',
            data: {
                labels: unidadNombre,
                datasets: [{
                    data: unidadTotal,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'NEGOCIO PORCENTUAL',
                    }
                }
            }
        });

    </script>

    @endpush


</x-material-layout>
