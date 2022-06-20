<x-material-layout :activePage="'detalles'" :menuParent="'calendario'">
    <x-slot name="title">Cotizacion</x-slot>
    <x-slot name="titlePage">Cotizacion</x-slot>

    <livewire:campanias.cotizaciones :campania="$campania->id" />

</x-material-layout>
