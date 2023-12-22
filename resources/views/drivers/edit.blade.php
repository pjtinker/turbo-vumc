<x-app-layout :title="__('Edit Driver')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('drivers.index') => __('Drivers'), __($driver->name)]" />
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                {{-- <turbo-frame :id="driver_edit_{{ $driver->id }}"> --}}
                    <div class="max-w-2xl mx-auto">
                        @include('drivers.partials.driver-form')
                    </div>
                {{-- </turbo-frame> --}}
            </div>
        </div>
    </div>
</x-app-layout>