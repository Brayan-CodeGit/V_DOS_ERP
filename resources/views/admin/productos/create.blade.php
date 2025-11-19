<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.productos.store') }}">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="Nombre" :value="__('Nombre')" />
                            <x-text-input id="Nombre" class="block mt-1 w-full" type="text" name="Nombre" :value="old('Nombre')" required autofocus />
                            <x-input-error :messages="$errors->get('Nombre')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="Codigo_SKU" :value="__('Código SKU')" />
                            <x-text-input id="Codigo_SKU" class="block mt-1 w-full" type="text" name="Codigo_SKU" :value="old('Codigo_SKU')" required />
                            <x-input-error :messages="$errors->get('Codigo_SKU')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="Tipo_Producto" :value="__('Tipo de Producto')" />
                            <select id="Tipo_Producto" name="Tipo_Producto" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo }}" @selected(old('Tipo_Producto') == $tipo)>{{ $tipo }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('Tipo_Producto')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="Unidad_Medida" :value="__('Unidad de Medida')" />
                            <x-text-input id="Unidad_Medida" class="block mt-1 w-full" type="text" name="Unidad_Medida" :value="old('Unidad_Medida')" required />
                            <x-input-error :messages="$errors->get('Unidad_Medida')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="Costo_Estandar" :value="__('Costo Estándar')" />
                            <x-text-input id="Costo_Estandar" class="block mt-1 w-full" type="number" step="0.01" name="Costo_Estandar" :value="old('Costo_Estandar', 0.00)" min="0" />
                            <x-input-error :messages="$errors->get('Costo_Estandar')" class="mt-2" />
                        </div>
                        <div class="flex items-end pb-1">
                            <label for="Es_Inventariable" class="flex items-center">
                                <input id="Es_Inventariable" name="Es_Inventariable" type="checkbox" checked class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Es Inventariable') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('Es_Inventariable')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Guardar Producto') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>