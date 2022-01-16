<div class="relative mt-1">
    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
    </div>
    {{-- <input {!! $attributes->merge(['class' => 'rounded-lg px-4 py-1.5 shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm']) !!}> --}}
    <input type="search" {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-200 focus:border-indigo-500 ring-indigo-600 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm pl-10 pr-4 py-2 ']) !!} >
</div>
