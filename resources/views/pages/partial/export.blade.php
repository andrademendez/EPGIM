<button id="dropdownButton" data-dropdown-toggle="dropdown"
    class="text-white focus:outline-none bg-blue-700 hover:bg-blue-800 focus:ring-0 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Exportar <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>
<div id="dropdown" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow ">
    <ul class="py-1" aria-labelledby="dropdownButton">
        <li>
            <button type="button" wire:click="exportExcel"
                class="w-full flex justify-between  py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">
                <span>Excel</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                </svg>
            </button>
        </li>
        <li>
            <button type="button" wire:click="exportPDF"
                class="w-full flex justify-between py-2 px-4 text-sm text-gray-700  hover:bg-gray-100 ">
                <span>PDF</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                </svg>
            </button>
        </li>
    </ul>
</div>
