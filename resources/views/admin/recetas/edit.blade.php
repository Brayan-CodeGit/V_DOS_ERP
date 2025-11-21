<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Receta: ') . $receta->Nombre_Receta }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Sección de Mensajes --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">{{ __('¡Error de Operación!') }}</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">{{ __('¡Error de Validación!') }}</strong>
                    <span class="block sm:inline">{{ __('Revisa los campos e intenta de nuevo.') }}</span>
                </div>
            @endif

            {{-- PRIMERA SECCIÓN: Edición de Datos Generales de la Receta --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">1. Datos Generales de la Receta</h3>

                    <form method="POST" action="{{ route('admin.recetas.update', $receta) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="Nombre_Receta" :value="__('Nombre de Receta')" />
                                <x-text-input id="Nombre_Receta" class="block mt-1 w-full" type="text"
                                    name="Nombre_Receta" :value="old('Nombre_Receta', $receta->Nombre_Receta)" required autofocus />
                                <x-input-error :messages="$errors->get('Nombre_Receta')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="ID_Producto_Final" :value="__('ID Producto Final')" />
                                <x-text-input id="ID_Producto_Final" class="block mt-1 w-full" type="number"
                                    name="ID_Producto_Final" :value="old('ID_Producto_Final', $receta->ID_Producto_Final)" required />
                                <x-input-error :messages="$errors->get('ID_Producto_Final')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="Rendimiento" :value="__('Rendimiento')" />
                                <x-text-input id="Rendimiento" class="block mt-1 w-full" type="number" step="0.01"
                                    name="Rendimiento" :value="old('Rendimiento', $receta->Rendimiento)" required />
                                <x-input-error :messages="$errors->get('Rendimiento')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="Unidad_Rendimiento" :value="__('Unidad de Rendimiento')" />
                                <x-text-input id="Unidad_Rendimiento" class="block mt-1 w-full" type="text"
                                    name="Unidad_Rendimiento" :value="old('Unidad_Rendimiento', $receta->Unidad_Rendimiento)" required />
                                <x-input-error :messages="$errors->get('Unidad_Rendimiento')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Actualizar Receta') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-gray-700 my-8">

            {{-- SEGUNDA SECCIÓN: Gestión de Componentes (DetalleReceta) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">2. Componentes / Ingredientes de la Receta</h3>

                    {{-- Formulario para agregar nuevo componente --}}
                    <h4 class="text-lg font-medium mt-6 mb-3">Añadir Nuevo Componente</h4>
                    <form method="POST" action="{{ route('admin.recetas.detalles.store', $receta) }}"
                        class="mb-6 border p-4 rounded-lg dark:border-gray-700">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="ID_Producto_Componente" :value="__('Componente (Materia Prima/Semi-Elaborado)')" />
                                <select id="ID_Producto_Componente" name="ID_Producto_Componente" required
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Seleccione un Producto</option>
                                    {{-- El array $componentes viene del controlador y contiene Productos MP y SE --}}
                                    @foreach ($componentes as $componente)
                                        <option value="{{ $componente->ID_Producto }}"
                                            {{ old('ID_Producto_Componente') == $componente->ID_Producto ? 'selected' : '' }}>
                                            {{ $componente->Nombre }} (Unidad Base: {{ $componente->Unidad_Medida }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('ID_Producto_Componente')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="Cantidad_Necesaria" :value="__('Cantidad Necesaria')" />
                                <x-text-input id="Cantidad_Necesaria" class="block mt-1 w-full" type="number"
                                    step="0.0001" name="Cantidad_Necesaria" :value="old('Cantidad_Necesaria')" required />
                                @error('Cantidad_Necesaria')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="Unidad_Consumo" :value="__('Unidad de Consumo')" />
                                <x-text-input id="Unidad_Consumo" class="block mt-1 w-full" type="text"
                                    name="Unidad_Consumo" placeholder="Ej: gr, kg, ml, L, und" :value="old('Unidad_Consumo')" required />
                                @error('Unidad_Consumo')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-full md:col-span-4 flex justify-end">
                                <x-primary-button class="bg-green-600 hover:bg-green-700">
                                    {{ __('➕ Agregar Componente') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    {{-- Listado de Componentes Actuales --}}
                    <h4 class="text-lg font-medium mt-6 mb-3">Componentes de la Receta
                        ({{ $receta->detalles ? $receta->detalles->count() : 0 }})</h4>

                    @if ($receta->detalles->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Esta receta no tiene componentes definidos.</p>
                    @elseif ($receta->detalles)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID Detalle</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID Producto</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Producto Componente</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Cantidad y Unidad</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($receta->detalles as $detalle)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->ID_Detalle }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $detalle->ID_Producto_Componente }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{-- Usamos la relación productoComponente --}}
                                                {{ $detalle->productoComponente?->Nombre ?? 'Producto Desconocido' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ number_format($detalle->Cantidad_Necesaria, 4) }}
                                                {{ $detalle->Unidad_Consumo }}</td> {{-- CORREGIDO: Usar Unidad_Consumo --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form
                                                    action="{{ route('admin.recetas.detalles.destroy', [$receta, $detalle]) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600"
                                                        onclick="return confirm('¿Está seguro de eliminar este componente de la receta?')">
                                                        {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>