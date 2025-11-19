<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Almacén') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.almacenes.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="Nombre_Almacen" :value="__('Nombre de Almacén')" />
                        <x-text-input id="Nombre_Almacen" class="block mt-1 w-full" type="text" name="Nombre_Almacen" :value="old('Nombre_Almacen')" required autofocus />
                        <x-input-error :messages="$errors->get('Nombre_Almacen')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="Direccion" :value="__('Dirección (Opcional)')" />
                        <x-text-input id="Direccion" class="block mt-1 w-full" type="text" name="Direccion" :value="old('Direccion')" />
                        <x-input-error :messages="$errors->get('Direccion')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Guardar Almacén') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>