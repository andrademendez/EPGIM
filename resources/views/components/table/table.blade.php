<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full ">
            <div class="overflow-hidden shadow-md rounded-lg px-1">
                <table class="min-w-full">
                    <thead class="bg-gray-100 ">
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
    </div>
</div>
