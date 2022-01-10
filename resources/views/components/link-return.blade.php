<div class="flex items-center justify-end pb-2 my-2">
    <a {{ $attributes }} class="flex items-center text-xs uppercase border-transparent border-b text-gray-800 hover:text-gray-600 hover:border-indigo-600">
        <ion-icon size="small" src="{{ asset('icons/ionicons/arrow-back-outline.svg') }}"></ion-icon>
        <span class="pl-2">{{ $slot }}</span>
    </a>
</div>
