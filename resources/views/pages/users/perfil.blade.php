<x-material-layout :activePage="'users'" :menuParent="'users'">
    <x-slot name="title">Mi Perfil</x-slot>
    <x-slot name="titlePage">Mi Perfil</x-slot>
    <x-content>
        <x-slot name="import">

        </x-slot>
        <div class="grid grid-cols-6 gap-2">
            <div class="col-span-6 md:col-span-4">
                <livewire:perfil :id_user="$user->id" />
            </div>
            <div class="col-span-6 md:col-span-2 py-4 px-3 shadow-lg  rounded-lg">
                <div class="w-full">
                    <canvas id="myChart" class="max-h-60 md:max-h-72 h-full"></canvas>
                </div>
            </div>
        </div>
    </x-content>
    @push('js')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Espacios ocupados'
                    }
                }
            }
        });

    </script>
    @endpush
</x-material-layout>
