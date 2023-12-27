<x-app-layout :title="__('Automobile Info')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('automobiles.index') => __('automobiles'), route('automobiles.show', $automobile) => __($automobile->name), __('Assign Driver')]" />
        </h2>
    </x-slot>
    <form action="{{  route('automobiles.drivers.assign', ['automobile_id' => $automobile->id]) }}" method="POST" class="w-full">
        @csrf
            <div class="py-12">
                @if(isset($drivers) && $drivers->count())
                <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl mx-auto">
                            <div class="max-w-xl mx-auto">
                                <ul role="list" class="divide-y divide-gray-100"> 
                                    @foreach ($drivers as $driver)
                                        <li class="p-4 hover:bg-blue-950">
                                            <div class="flex">
                                                <div class="mx-3">
                                                    <input class="form-check-input" type="checkbox" name="driver_id" value="{{ $driver->id }}"
                                                    id="automobile{{ $automobile->id }}"
                                                    {{ $automobile->id === $driver->id ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <img class="w-40 h-40 rounded-full" src="{{ $driver->avatar_url }}" alt="">
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-white">
                                                        {{ $driver->name}}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $driver->email }}
                                                    </p>
                                                </div>
                                                <div class="ml-auto">
                                                    <a href="{{ route('drivers.show', $driver) }}" class="text-sm text-gray-500">
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
            
                <div class="mt-6" align="right">
                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </div>
            @else
            <h2 class="text-lg text-gray-500">
                {{ __('No automobiles are currently available.') }}
            </h2>
        @endif
        </div>
    </form>
</x-app-layout>