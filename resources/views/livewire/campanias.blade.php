<div class="p-2">
    <div class=" mx-auto ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2">
            <div class="py-3 bg-white border-b border-gray-100">
                <div class="flex items-center justify-start">
                    <div class="px-3 text-lg font-medium">
                        <span>Unidades</span>
                    </div>
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
                @if ($unidad == '1' )
                {{-- <livewire:unidades.showcenter :unidad="$unidad" /> --}}
                <div id="fullCalendarao"></div>
                <script>
                    $(document).ready(function() {
                        md.initFullCalendar();
                    });

                </script>
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
