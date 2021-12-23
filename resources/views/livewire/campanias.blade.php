<div class="p-2">
    <x-slot name="title">Campañas</x-slot>
    <x-slot name="titlePage">Campañas</x-slot>
    <div class=" mx-auto ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2">
            <div class="py-3 bg-white border-b border-gray-100">
                <div class="flex items-center justify-end">
                    <x-form.select name="unidades" id="" wire:model="unidad">
                        <option value="general">General</option>
                        @forelse ($unidades as $uni)
                        <option value="{{ $uni->id }}">{{ $uni->nombre }}</option>
                        @empty
                        @endforelse
                    </x-form.select>
                </div>
            </div>
            <div class="py-3">
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                @if ($unidad == '1' )
                <div id="fullCalendarao">
                    <script>
                        $(document).ready(function() {
                            md.initFullCalendar();
                        });

                    </script>

                </div>

                @elseif ($unidad == '4')

                <div id="fullCalendarsw">
                    <script>
                        $(document).ready(function() {
                            md.initFullCalendar();
                        });

                    </script>
                </div>
                @else
                <div id="fullCalendar">
                    <script>
                        $(document).ready(function() {
                            md.initFullCalendar();
                        });

                    </script>

                </div>
                @endif
            </div>
        </div>
    </div>
</div>
