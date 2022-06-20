<x-material-layout :activePage="'dashboard'" :menuParent="'dashboard'">
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="titlePage">Dashboard</x-slot>

    <div class="p-2">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="text-xl font-semibold py-2 mb-5 border-b-2 border-violet-600">
                        <span>Hola, {{ auth()->user()->name }}</span>
                    </div>
                    <div class="grid grid-cols-8 gap-2 ">
                        <div class="col-span-8 md:col-span-2  rounded-lg">
                            <x-dashboard.card>
                                <h1 class="text-2xl font-bold">${{ number_format($totalVenta) }}.00</h1>
                                <span class="text-sm uppercase text-gray-100 font-medium">Costo Total de Espacios</span>
                            </x-dashboard.card>
                        </div>
                        <div class="col-span-8 md:col-span-6">
                            <div class="grid grid-cols-8 gap-2">
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">
                                            ${{ number_format($ventaUnidad['Airó'], 2) }}
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Airó</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">
                                            ${{ number_format($ventaUnidad['Fashion Drive'], 2) }}
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Fashion Drive</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">
                                            ${{ number_format($ventaUnidad['Main Entrance'], 2) }}
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Main Entrance</span>
                                    </x-dashboard.card>
                                </div>
                                <div class="col-span-4 md:col-span-2 rounded-lg">
                                    <x-dashboard.card>
                                        <h1 class="text-xl font-bold">
                                            ${{ number_format($ventaUnidad['Showcenter'], 2) }}
                                        </h1>
                                        <span class="text-sm uppercase text-gray-100 font-medium">Showcenter</span>
                                    </x-dashboard.card>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=" ">
                        <div class="grid grid-cols-5 gap-2 pt-5 ">
                            <div class="col-span-4 md:col-span-2 shadow-lg  py-3 ">
                                <canvas id="ocupacionPorcentual" class=""></canvas>
                            </div>
                            <div class="col-span-4 md:col-span-3 shadow-lg py-3">
                                <canvas id="ocupacionMonetariaB" height="200"></canvas>
                            </div>
                            <div class="col-span-4 md:col-span-2 shadow-lg py-3">
                                <canvas id="porEspacioPorcentual"></canvas>
                            </div>
                            <div class="col-span-4 md:col-span-3 shadow-lg py-3">
                                <canvas id="ocupacionPorEspacioB" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 ">
                        <div class="py-2 mt-3 grid-cols-3 md:col-span-2">

                            <livewire:inicio.espacios-frecuentes />
                        </div>
                        <div class="py-2 mt-3 grid-cols-3 md:col-span-1">

                            <livewire:inicio.mejores-clientes />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        let totalEspacioVenta = {{
                Js::from($totalChart)
            }};
        let totalVentaPorcentaje = {{
                Js::from($totalPorcentaje)
            }};
        let unidadesNombre = {{
                Js::from($unidades->pluck('nombre'))
            }};
        let unidadNombre = {{
                Js::from($ventaPorUnidad->pluck('unidad'))
            }};
        let unidadTotal = {{
                Js::from($ventaPorUnidad->pluck('total'))
            }};
        let negocioPorcentual = {{
                Js::from($negocioPorcentual)
            }};

        const ocupacionPorcentual = document.getElementById('ocupacionPorcentual');
        const ocupacionMonetariaB = document.getElementById('ocupacionMonetariaB');
        // const ctx = document.getElementById('myChart');


        const ocupacionPorEspacioB = document.getElementById('ocupacionPorEspacioB');
        const porEspacioPorcentual = document.getElementById('porEspacioPorcentual');

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
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRot',
                            pointRadius: 5,
                        },
                    }
                },
            }
        });

        new Chart(ocupacionMonetariaB, {
            type: 'bar',
            data: {
                labels: ['Ocupado', 'Disponible'],
                datasets: [{
                    label: 'OCUPACIÓN MONETARIA',
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'OCUPACIÓN MONETARIA',
                    },

                }
            }
        });

        new Chart(porEspacioPorcentual, {
            type: 'doughnut',
            data: {
                labels: unidadNombre,
                datasets: [{
                    data: negocioPorcentual,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)',
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
                    },
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRot',
                            pointRadius: 5,
                        },
                    }
                }
            }
        });

        new Chart(ocupacionPorEspacioB, {
            type: 'bar',
            data: {
                labels: unidadNombre,
                datasets: [{
                    label: 'NEGOCIO MONETARIA',
                    data: unidadTotal,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)',
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
                        text: 'NEGOCIO MONETARIA',
                    },
                    label: {
                        display: false,

                    }
                }
            }
        });
    </script>
    @endpush


</x-material-layout>
