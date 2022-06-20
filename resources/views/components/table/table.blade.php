<div class="flex flex-col">
    <div class="w-full overflow-x-auto shadow-md ">
        <table class="w-full table-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 shadow-lg">
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
