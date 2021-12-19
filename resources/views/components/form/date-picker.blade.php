<input {{ $attributes }} x-data x-ref="input" x-init=" new Pikaday({ field: $refs.input,
        format: 'D-MMM-YYYY',
        firstDay: 1,
        onSelect: function (date) { $dispatch('input', moment(date.toString()).format('D-MMM-YYYY')) }
    })" type="text" class="mt-1 appearance-none border border-transparent py-2 px-3 bg-white text-gray-700 placeholder-gray-400 text-base focus:ring-1 focus:ring-purple-600 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-full sm:rounded-lg">
