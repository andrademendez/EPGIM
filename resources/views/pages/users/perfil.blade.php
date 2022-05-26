<x-material-layout :activePage="'users'" :menuParent="'users'">
    <x-slot name="title">Mi Perfil</x-slot>
    <x-slot name="titlePage">Mi Perfil</x-slot>
    <x-content>
        <x-slot name="import">

        </x-slot>
        <div>
            <livewire:perfil :id_user="$user->id" />
        </div>
    </x-content>

</x-material-layout>
