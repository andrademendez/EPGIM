<x-material-layout :activePage="'detalles'" :menuParent="'calendario'">
    <x-slot name="title">Detalles</x-slot>
    <x-slot name="titlePage">Detalles</x-slot>


    <livewire:campanias.detalles-general :campania_id="$campania->id" />

</x-material-layout>
