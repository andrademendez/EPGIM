<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Main</x-slot>
    <x-content>
        <x-slot name="import">
            @if (auth()->user()->isAdmin() || auth()->user()->isCreator() )
            @include("pages.campanias.create")
            @include("pages.campanias.edit")
            @endif
        </x-slot>
        <div class="py-3">
            <div id="fullMain">
            </div>
        </div>
    </x-content>


    @push('js')
    {{-- <script src="{{ asset(" js/pikaday.js") }}"></script> --}}

    <script src="{{ asset('js/calendarios/main.js') }}"></script>
    <script src="{{ asset('js/campanias.js') }}"></script>
    <script>


    </script>
    @endpush
</x-material-layout>
