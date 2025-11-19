<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catálogo Maestro de Productos') }}
            </h2>
            <a href="{{ route('admin.productos.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Crear Producto') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Unidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Costo Est.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->Codigo_SKU }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->Nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->Tipo_Producto }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->Unidad_Medida }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${{ number_format($producto->Costo_Estandar, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.productos.edit', $producto) }}"
                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-4">
                                            {{ __('Editar') }}
                                        </a>

                                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('⚠️ ADVERTENCIA: Al eliminar el producto **{{ $producto->Nombre }}**, se eliminarán todos los registros dependientes, incluyendo su uso como componente o producto final en cualquier receta. ¿Deseas continuar?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
