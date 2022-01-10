<x-material-layout :activePage="'espacios'" :menuParent="'espacios'">
    <x-slot name="title">Espacio</x-slot>
    <x-slot name="titlePage">Editar Espacio - {{ $espacio->nombre }}</x-slot>

    <livewire:espacio.editar-espacio :id_espacio="$espacio->id" />
</x-material-layout>
