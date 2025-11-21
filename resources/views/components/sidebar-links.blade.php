<div class="space-y-2">
    <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base font-normal text-white rounded-lg dark:text-white hover:bg-gray-700 dark:hover:bg-gray-700">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-2 2m-2 0l-7 7m7-7v10a1 1 0 001 1h3M6 20h12a1 1 0 001-1v-4a1 1 0 00-1-1H6a1 1 0 00-1 1v4a1 1 0 001 1z"></path></svg>
        <span class="ml-3 text-lg font-bold">ERP - Admin</span>
    </a>

    <div class="space-y-1 pt-4">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center p-2 text-base font-normal rounded-lg transition duration-75 text-gray-200 hover:bg-gray-700">
            <span class="ml-3">{{ __('Dashboard') }}</span>
        </x-nav-link>

        <h3 class="text-xs uppercase text-gray-400 pt-3 pb-1 ml-3 font-semibold">{{ __('Catálogo Maestro') }}</h3>
        
        <x-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')" class="flex items-center p-2 text-base font-normal rounded-lg transition duration-75 text-gray-200 hover:bg-gray-700">
            <span class="ml-3">{{ __('Productos') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.almacenes.index')" :active="request()->routeIs('admin.almacenes.*')" class="flex items-center p-2 text-base font-normal rounded-lg transition duration-75 text-gray-200 hover:bg-gray-700">
            <span class="ml-3">{{ __('Almacenes') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.recetas.index')" :active="request()->routeIs('admin.recetas.*')" class="flex items-center p-2 text-base font-normal rounded-lg transition duration-75 text-gray-200 hover:bg-gray-700">
            <span class="ml-3">{{ __('Recetas') }}</span>
        </x-nav-link>

       
        

        {{-- Aquí se agregarían futuros módulos como Inventario, Compras, etc. --}}
    </div>
</div>