<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalle de Receta: ') . $receta->Nombre_Receta }}
            </h2>
            <a href="{{ route('admin.recetas.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('← Volver al Listado') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Información General</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div>
                            <p class="font-medium text-gray-500 dark:text-gray-400">ID de Receta</p>
                            <p class="text-xl">{{ $receta->ID_Receta }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 dark:text-gray-400">Nombre</p>
                            <p class="text-xl">{{ $receta->Nombre_Receta }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 dark:text-gray-400">Producto Final (ID)</p>
                            {{-- Se mostraría el nombre del producto si tuvieras la relación definida: $receta->producto->Nombre --}}
                            <p class="text-xl">{{ $receta->ID_Producto_Final }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 dark:text-gray-400">Rendimiento</p>
                            <p class="text-xl">{{ $receta->Rendimiento }} {{ $receta->Unidad_Rendimiento }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 dark:text-gray-400">Fecha de Creación</p>
                            <p>{{ $receta->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2 mt-6">Detalles y Componentes (Pendiente)</h3>
                    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Aquí se cargará una tabla o lista con los ingredientes o componentes asociados a esta receta, usando el modelo **DetalleReceta**.
                        </p>
                    </div>

                    <div class="mt-6 flex justify-end">
                         <a href="{{ route('admin.recetas.edit', $receta) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Editar Receta') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>