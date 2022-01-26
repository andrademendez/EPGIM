<x-material-layout :activePage="'errors'" :menuParent="'errors'">

    <x-slot name="title">Forbidden</x-slot>
    <x-slot name="titlePage">Forbidden</x-slot>
    <div class="flex flex-col items-center justify-center py-48">
        <div class=" text-3xl text-gray-700 font-medium text-center uppercase tracking-wider">
            {{ $exception->getMessage() ?: 'Forbidden' }}
        </div>
        <div class="text-lg text-gray-500  text-center my-3">
            <span>
                La página a la que intenta acceder tiene acceso restringido. <br> Consulte al administrador de su
                sistema.
            </span>
        </div>
        <div class="text-lg text-gray-500 uppercase tracking-wider mt-2">
            <a class="bg-purple-700 text-white py-2.5 px-4 rounded-full text-xs font-medium border-b border-transparent hover:bg-purple-800"
                href="{{ route('dashboard') }}">
                Regresar a Inicio
            </a>
        </div>
    </div>
</x-material-layout>
