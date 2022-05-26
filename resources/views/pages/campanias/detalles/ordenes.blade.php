<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Ordenes de servicios</x-slot>
    <x-slot name="titlePage">Ordenes de servicios</x-slot>

    <livewire:campanias.ordenes :campania_id="$campania" />

</x-material-layout>
