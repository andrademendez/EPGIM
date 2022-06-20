<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Aiŕo</x-slot>
    <x-content>
        <x-slot name="import">
            @if (auth()->user()->isAdmin() || auth()->user()->isCreator() )
            @include("pages.campanias.create")
            @include("pages.campanias.edit")
            @endif

        </x-slot>
        <div class="py-3">
            <div id="fullAiro">
            </div>
        </div>
    </x-content>


    @push('js')
    {{-- <script src="{{ asset(" js/pikaday.js") }}"></script> --}}
    <script src="{{ asset('js/campanias.js') }}"></script>
    <script src="{{ asset('js/calendarios/airo.js') }}"></script>

    @endpush
</x-material-layout>
