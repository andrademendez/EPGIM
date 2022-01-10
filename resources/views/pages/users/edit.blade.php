<x-material-layout :activePage="'users'" :menuParent="'users'">
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="titlePage">Editar Usuario </x-slot>

    <livewire:editar-usuario :id_usuario="$usuario->id" />
</x-material-layout>
