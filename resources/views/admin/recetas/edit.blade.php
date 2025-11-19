{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Receta: ') . $receta->Nombre_Receta }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.recetas.update', $receta) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="Nombre_Receta" :value="__('Nombre de Receta')" />
                            <x-text-input id="Nombre_Receta" class="block mt-1 w-full" type="text" name="Nombre_Receta" :value="old('Nombre_Receta', $receta->Nombre_Receta)" required autofocus />
                            <x-input-error :messages="$errors->get('Nombre_Receta')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ID_Producto_Final" :value="__('ID Producto Final')" />
                            <x-text-input id="ID_Producto_Final" class="block mt-1 w-full" type="number" name="ID_Producto_Final" :value="old('ID_Producto_Final', $receta->ID_Producto_Final)" required />
                            <x-input-error :messages="$errors->get('ID_Producto_Final')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Rendimiento" :value="__('Rendimiento')" />
                            <x-text-input id="Rendimiento" class="block mt-1 w-full" type="number" step="0.01" name="Rendimiento" :value="old('Rendimiento', $receta->Rendimiento)" required />
                            <x-input-error :messages="$errors->get('Rendimiento')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Unidad_Rendimiento" :value="__('Unidad de Rendimiento')" />
                            <x-text-input id="Unidad_Rendimiento" class="block mt-1 w-full" type="text" name="Unidad_Rendimiento" :value="old('Unidad_Rendimiento', $receta->Unidad_Rendimiento)" required />
                            <x-input-error :messages="$errors->get('Unidad_Rendimiento')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Actualizar Receta') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

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
                                <x-text-input id="Nombre_Receta" class="block mt-1 w-full" type="text" name="Nombre_Receta" :value="old('Nombre_Receta', $receta->Nombre_Receta)" required autofocus />
                                <x-input-error :messages="$errors->get('Nombre_Receta')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="ID_Producto_Final" :value="__('ID Producto Final')" />
                                <x-text-input id="ID_Producto_Final" class="block mt-1 w-full" type="number" name="ID_Producto_Final" :value="old('ID_Producto_Final', $receta->ID_Producto_Final)" required />
                                <x-input-error :messages="$errors->get('ID_Producto_Final')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="Rendimiento" :value="__('Rendimiento')" />
                                <x-text-input id="Rendimiento" class="block mt-1 w-full" type="number" step="0.01" name="Rendimiento" :value="old('Rendimiento', $receta->Rendimiento)" required />
                                <x-input-error :messages="$errors->get('Rendimiento')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="Unidad_Rendimiento" :value="__('Unidad de Rendimiento')" />
                                <x-text-input id="Unidad_Rendimiento" class="block mt-1 w-full" type="text" name="Unidad_Rendimiento" :value="old('Unidad_Rendimiento', $receta->Unidad_Rendimiento)" required />
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
                    <form method="POST" action="{{ route('admin.recetas.detalles.store', $receta) }}" class="mb-6 border p-4 rounded-lg dark:border-gray-700">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="ID_Producto_Componente" :value="__('Componente (Producto)')" />
                                {{-- NOTA: Deberías cargar una lista de PRODUCTOS aquí --}}
                                <x-text-input id="ID_Producto_Componente" class="block mt-1 w-full" type="number" name="ID_Producto_Componente" placeholder="ID Producto" :value="old('ID_Producto_Componente')" required />
                                @error('ID_Producto_Componente') <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="Cantidad_Necesaria" :value="__('Cantidad Necesaria')" />
                                <x-text-input id="Cantidad_Necesaria" class="block mt-1 w-full" type="number" step="0.0001" name="Cantidad_Necesaria" :value="old('Cantidad_Necesaria')" required />
                                @error('Cantidad_Necesaria') <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="Unidad_Medida" :value="__('Unidad')" />
                                <x-text-input id="Unidad_Medida" class="block mt-1 w-full" type="text" name="Unidad_Medida" :value="old('Unidad_Medida')" required />
                                @error('Unidad_Medida') <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="col-span-full md:col-span-4 flex justify-end">
                                <x-primary-button class="bg-green-600 hover:bg-green-700">
                                    {{ __('➕ Agregar Componente') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    {{-- Listado de Componentes Actuales --}}
                    {{-- <h4 class="text-lg font-medium mt-6 mb-3">Componentes de la Receta ({{ $receta->detalles->count() }})</h4> --}}
                    <h4 class="text-lg font-medium mt-6 mb-3">Componentes de la Receta ({{ $receta->detalles ? $receta->detalles->count() : 0 }})</h4>
                    
                    @if ($receta->detalles->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Esta receta no tiene componentes definidos.</p>
                    @elseif ($receta->detalles)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID Detalle</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID Producto</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Producto Componente</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Cantidad</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($receta->detalles as $detalle)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->ID_Detalle }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->ID_Producto_Componente }}</td>
                                            {{-- Nota: Necesitarás cargar la relación `componente` para el nombre --}}
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $detalle->componente ? $detalle->componente->Nombre : 'Producto Desconocido' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($detalle->Cantidad_Necesaria, 4) }} {{ $detalle->Unidad_Medida }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- Por simplicidad, aquí solo pondremos el botón eliminar. La edición se haría en un modal o una vista separada --}}
                                                <form action="{{ route('admin.recetas.detalles.destroy', [$receta, $detalle]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600" onclick="return confirm('¿Eliminar este componente?')">
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