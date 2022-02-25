<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Main</x-slot>
    <x-content>
        <x-slot name="import">
            @include("pages.campanias.create")
            @include("pages.campanias.edit")
        </x-slot>
        <div class="py-3">
            <div id="fullFashion">
            </div>
        </div>
    </x-content>


    @push('js')
    <script src="{{ asset('js/calendarios/fashion.js') }}"></script>
    {{-- <script src="{{ asset(" js/pikaday.js") }}"></script> --}}
    <script src="{{ asset('js/campanias.js') }}"></script>
    <script>
        $(document).ready(function () {
                md.initFullCalendar();
            });

    </script>

    @endpush
</x-material-layout>
