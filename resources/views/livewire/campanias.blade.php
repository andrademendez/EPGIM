<x-content>
    <x-slot name="import">
        @if ($open == true)
        @include('pages.campanias.modal-edit')
        @endif
    </x-slot>
    <div class="pb-2 bg-white border-b border-gray-100">
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

        @if ($unidad == '1' )
        <div id="fullCalendarao">
        </div>

        @elseif ($unidad == '4')

        <div id="fullCalendarsw">
        </div>
        @else
        <div id="fullCalendar" wire:ignore>
        </div>


        @endif
    </div>

</x-content>
@push('js')

<script>
    $(document).ready(function() {
        md.initFullCalendar();
    });

    @this.on(`refreshCalendar`, () => {
        $calendar.refetchEvents()
    });

</script>

@endpush
