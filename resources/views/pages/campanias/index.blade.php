<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Campañas</x-slot>
    <livewire:campanias />
    {{-- <div id="uikit-create" class="uk-flex-top" uk-modal> --}}
    @include("pages.campanias.create")
    @include("pages.campanias.edit")

</x-material-layout>
