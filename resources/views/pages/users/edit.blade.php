<x-material-layout :activePage="'users'" :menuParent="'users'">
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="titlePage">Editar Usuario </x-slot>
    <x-content>

        <x-slot name="import">
        </x-slot>

        <livewire:user.editar-usuario :id_usuario="$usuario->id" />
        <div class="mt-4 mb-2">
            <div class="w-full">
                <livewire:user.campanias :id_usuario="$usuario->id" />
            </div>
        </div>
    </x-content>
    @push('js')
    <script>
        let espaciosName = {{ Js::from($espacioName) }};
        let espaciosTotal = {{ Js::from($espacioTotal) }};
        const ctx3 = document.getElementById('chartEspacios').getContext('2d');
        const myChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: espaciosName,
                datasets: [{
                    data: espaciosTotal,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'
                        , 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'
                        , 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Custom Chart Title'
                    }
                }
            }
        });

    </script>
    @endpush
</x-material-layout>
