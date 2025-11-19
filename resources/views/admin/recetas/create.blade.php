<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Receta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.recetas.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="Nombre_Receta" :value="__('Nombre de Receta')" />
                            <x-text-input id="Nombre_Receta" class="block mt-1 w-full" type="text" name="Nombre_Receta" :value="old('Nombre_Receta')" required autofocus />
                            <x-input-error :messages="$errors->get('Nombre_Receta')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ID_Producto_Final" :value="__('ID Producto Final')" />
                            {{-- Nota: Idealmente, usar un <select> aquí con los productos cargados --}}
                            <x-text-input id="ID_Producto_Final" class="block mt-1 w-full" type="number" name="ID_Producto_Final" :value="old('ID_Producto_Final')" required />
                            <x-input-error :messages="$errors->get('ID_Producto_Final')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Rendimiento" :value="__('Rendimiento')" />
                            <x-text-input id="Rendimiento" class="block mt-1 w-full" type="number" step="0.01" name="Rendimiento" :value="old('Rendimiento')" required />
                            <x-input-error :messages="$errors->get('Rendimiento')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Unidad_Rendimiento" :value="__('Unidad de Rendimiento')" />
                            <x-text-input id="Unidad_Rendimiento" class="block mt-1 w-full" type="text" name="Unidad_Rendimiento" :value="old('Unidad_Rendimiento')" required />
                            <x-input-error :messages="$errors->get('Unidad_Rendimiento')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Guardar Receta') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>