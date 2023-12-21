<x-app-layout :title="__('Driver Info')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('drivers.index') => __('Drivers'), __($driver->name)]" />
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl mx-auto">
                    @include('drivers.partials.driver-form')
                </div>
            </div>
        </div>
        {{-- <div class="p-6 flex space-x-2">
            <div class="flex-shrink-0">
                @if(isset($driver) && $driver->avatar_url)
                <img class="w-40 h-40 rounded-full" src="{{ $driver->avatar_url }}" alt="{{ $driver->name }}'s Avatar">
            @else
                <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            @endif            
        </div> --}}
         
        {{-- <div class="flex-1">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
            
                <div>
                    <x-input-label class="text-gray-700 text-gray-900" for="name">Name</x-input-label>
                    <p id="name">{{ $driver->name }}</p>
                </div>
    
                <div>
                    <x-input-label class="text-gray-700 text-gray-900" for="email">Email Address</x-input-label>
                    <p id="email">{{ $driver->email }}</p>
                </div>
    
                <div>
                    <x-input-label class="text-gray-700 text-gray-900" for="years_of_experience">Years of Experience</x-input-label>
                    <p id="years_of_experience">{{ $driver->years_of_experience }}</p>
                </div>
    
                <div>
                    <x-input-label class="text-gray-700 text-gray-900" for="can_drive_manual">Can Drive Manual</x-input-label>
                    <p id="can_drive_manual">{{ $driver->can_drive_manual ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div> --}}
            <div class="flex items-center space-x-2 ml-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('drivers.edit', $driver) }}">{{ __('Edit') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

</x-app-layout>
