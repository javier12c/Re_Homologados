<main>
    <h1 class=" font-bold text-3xl mt-6 mb-4">Registros por correspondencia</h1>
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Buscar</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Buscar" required="">
                    </div>
                </form>
            </div>

        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-formulario dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-2">Folio</th>
                        <th scope="col" class="px-3 py-3">Fecha del documento</th>
                        <th scope="col" class="px-3 py-3">No. del documento</th>
                        <th scope="col" class="px-3 py-3">Unidad o depedencia</th>
                        <th scope="col" class="px-3 py-3">Cargo</th>
                        <th scope="col" class="px-3 py-3">Asunto</th>
                        <th scope="col" class="px-3 py-3">Nombre del expediente</th>
                        <th scope="col" class="px-3 py-3">Estatus</th>
                        <th scope="col" class="px-3 py-3">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Iteracion de los registros que tiene el usuario logeado --}}
                    @forelse ($registros as $registro)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $registro->id }} </th>
                            <td class="px-3 py-2"> {{ $registro->reg_fecha_documento }} </td>
                            <td class="px-3 py-2">{{ $registro->reg_ndocumento }}</td>
                            <td class="px-3 py-2">{{ $registro->dependencia->dep_nombre }}</td>
                            <td class="px-3 py-2">{{ $registro->servidor->emp_puesto }}</td>
                            <td class="px-3 py-2">{{ $registro->reg_asunto }}</td>
                            <td class="px-3 py-2"> {{ $registro->expediente->exp_nombre }}</td>
                            @if ($registro->reg_status == 1)
                                <td class="px-3 py-2 bg-yellow-200">En revision</td>
                            @else
                                <td class="px-3 py-2 bg-green-200">Validado </td>
                            @endif
                            <td class=" mt-5  flex gap-3 w-14 items-center justify-end">
                                <a href="#" class="">
                                    <img src="{{ asset('img/Vector1.svg') }}" alt="">
                                </a>
                                <a href="{{ route('registros.edit', $registro->id) }}">
                                    <img src="{{ asset('img/Vector2.svg') }}" alt="">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p class=" p-3 text-center text-sm text-gray-600">No hay registros que mostrar</p>
                    @endforelse
                </tbody>
            </table>
            <div class="  mt-10">
                {{ $registros->links() }}
            </div>
        </div>

    </div>

</main>
