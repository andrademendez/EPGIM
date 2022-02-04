<div class="flex items-center justify-end pb-2 my-2">
    <a {{ $attributes }}
        class="flex items-center text-xs uppercase border-transparent border-b font-medium text-gray-800 hover:text-gray-900 hover:border-gray-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        <span class="pl-2">{{ $slot }}</span>
    </a>
</div>
