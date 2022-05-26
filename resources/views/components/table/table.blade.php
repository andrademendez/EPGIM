<div class="flex flex-col">
    <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                <tr>
                    {{ $theader ?? '' }}
                </tr>
            </thead>
            <tbody class="bg-white pb-2">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
