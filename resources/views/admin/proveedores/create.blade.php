<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Proveedor') }}
        </h2>
    </x-slot>

```
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form method="POST" action="{{ route('admin.proveedores.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nombre</label>
                        <input type="text" name="nombre" class="w-full rounded-md text-black" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Teléfono</label>
                        <input type="text" name="telefono" class="w-full rounded-md text-black">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Dirección</label>
                        <input type="text" name="direccion" class="w-full rounded-md text-black">
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.proveedores.index') }}"
                            class="mr-4 text-gray-600 hover:text-gray-800">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Guardar Proveedor
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
```

</x-app-layout>
