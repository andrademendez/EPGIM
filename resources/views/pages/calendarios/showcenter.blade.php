<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Showcenter</x-slot>
    <x-content>
        <x-slot name="import">
            @if (auth()->user()->isAdmin() || auth()->user()->isCreator() )
            @include("pages.campanias.create")
            @include("pages.campanias.edit")
            @else
            @include("pages.campanias.campania-show")
            @endif
        </x-slot>
        <div class="py-3">
            <div id="fullShowcenter">
            </div>
        </div>
    </x-content>


    @push('js')
    {{-- <script src="{{ asset(" js/pikaday.js") }}"></script> --}}
    <script src="{{ asset('js/calendarios/showcenter.js') }}"></script>
    <script src="{{ asset('js/campanias.js') }}"></script>
    @endpush
</x-material-layout>
