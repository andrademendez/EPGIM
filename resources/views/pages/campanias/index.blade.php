<x-material-layout :activePage="'campania'" :menuParent="'calendario'">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Campañas</x-slot>
    <x-content>
        <x-slot name="import">
            @include("pages.campanias.create")
            @include("pages.campanias.edit")
        </x-slot>

        <div class="pb-2 bg-white border-b border-gray-100">
            <div class="flex items-center justify-end">
                <x-form.select name="unidades" id="">
                    <option value="general">General</option>
                    @forelse ($unidades as $uni)
                    <option value="{{ $uni->id }}">{{ $uni->nombre }}</option>
                    @empty
                    @endforelse
                </x-form.select>
            </div>
        </div>
        <div class="py-3">
            <div id="fullCalendar">
            </div>
        </div>
    </x-content>

    @push('js')
    {{-- <script src="{{ asset(" js/pikaday.js") }}"></script> --}}
    <script src="{{ asset('js/campanias.js') }}"></script>
    <script>
        $(document).ready(function () {
            md.initFullCalendar();
        });

    </script>
    @endpush
</x-material-layout>
