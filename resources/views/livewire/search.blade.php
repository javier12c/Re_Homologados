<div>
    <input class="block font-medium text-sm text-gray-700 uppercase space-y-6" type="text" wire:model="dateRange" x-data
        x-init="flatpickr($refs.input, {
            mode: 'range',
            dateFormat: 'd/m/Y',
            onChange: function(selectedDates) {
                $wire.set('dateRange', selectedDates.map(date => date.toISOString().split('T')[0]).join(' a '));
            }
        });" x-ref="input" class="border p-2">
    <button wire:click="countRecords" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Contar registros
    </button>
    <p class="">Número de registros: {{ $count }}</p>
</div>
