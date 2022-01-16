<input {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm']) }} x-data x-ref="input" x-init=" new Pikaday({ field: $refs.input,

        firstDay: 1,
        onSelect: function (date) { $dispatch('input', moment(date.toString()).format('D-MMM-YYYY')) }
    })">
