<!-- Modal2-->
<div wire:ignore.self id="nombre-expediente" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-hide="nombre-expediente">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-6">
                <h3 class="mb-4 text-xl font-medium text-gray-900">
                    Agregando Expediente
                </h3>
                <form class="space-y-6 " wire:submit.prevent="crearExpediente" novalidate>
                    <div class="mt-10 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-6 sm:col-start-1">
                            <x-input-label for="nombreexpediente" :value="__('Nombre')" />
                            <x-text-input id="nombreexpediente" class="block mt-1 w-full" type="text"
                                wire:model="nombreexpediente" :value="old('nombreexpediente')" />
                            @error('nombreexpediente')
                                <livewire:mostrar-alerta :message="$message"></livewire:mostrar-alerta>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <x-input-label for="dependenciass" :value="__('Unidad o dependencia administrativa')" />

                            <select id="dependenciass" wire:model="dependenciass"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="">--seleccione la unidad o dependencia--</option>
                                @foreach ($cat_unidadepedencias as $cat_unidadepedencia)
                                    <option value="{{ $cat_unidadepedencia->dep_id }}">
                                        {{ $cat_unidadepedencia->dep_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dependenciass')
                                <livewire:mostrar-alerta :message="$message"></livewire:mostrar-alerta>
                            @enderror
                        </div>
                    </div>
                    <x-button2 wire:click="$emit('MostrarAlerta')" class=" w-full">
                        {{ 'Crear Expediente ' }}
                    </x-button2>
                </form>
            </div>
        </div>
    </div>
</div> <!-- Cierre modal-->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('MostrarAlerta', funcionarioId => {
            Swal.then(
                'Expediente Guardado con exito',
                'success'
            )
        })
    </script>
@endpush
