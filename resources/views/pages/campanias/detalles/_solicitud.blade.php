@if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado')
<div class="flex flex-col">
    <div class="flex space-x-2 items-center justify-center">
        @foreach ($campania->attachStatusFile as $attach)
        @if ($attach->process == 'Confirmacion')
        @foreach ($attach->filesStatus as $files)
        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('images/test/jpeg.png') }}" class="h-9" alt="" srcset="">
        </a>
        @endforeach

        @continue
        @endif
        @if ($attach->process == 'Cierre')
        @foreach ($attach->filesStatus as $files)
        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('images/test/pdf.png') }}" class="h-9" alt="" srcset="">
        </a>
        @endforeach
        @endif
        @endforeach
    </div>

</div>
@else
<div class="flex items-center justify-center">
    <button type="button"
        class="rounded-full  p-1.5 bg-[#e0f1f8] ml-2 text-[#30a3cf] hover:text-[#2bb1e6] focus:outline-none focus:ring-transparent disabled:opacity-25 transition ease-in-out duration-150"
        wire:click="openModal({{ $campania->id }})" title="Challenge">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </button>
</div>
@endif
