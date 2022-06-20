@if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado')
<div class="flex flex-col">
    <div class="flex space-x-2 items-center justify-center">
        @foreach ($campania->attachStatusFile as $attach)
        @if ($attach->process == 'Confirmacion')
        @foreach ($attach->filesStatus as $files)
        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('images/test/pdf.png') }}" class="h-7" alt="" srcset="">
        </a>
        @endforeach

        @continue
        @endif
        @if ($attach->process == 'Cierre')
        @foreach ($attach->filesStatus as $files)
        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('images/test/jpeg.png') }}" class="h-7" alt="" srcset="">
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>
@endif
