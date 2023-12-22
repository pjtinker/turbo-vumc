<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[__('Drivers')]" />
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('drivers.partials.new-driver-trigger')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <ul id="drivers" role="list" class="divide-y divide-gray-100">
                        @foreach ($drivers as $driver)
                            <li class="p-4 hover:bg-blue-950">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        @if ($driver->avatar_url)
                                            <img class="w-40 h-40 rounded-full" src="{{ $driver->avatar_url }}" alt="Avatar">
                                        @else
                                            @php
                                                $names = explode(' ', $driver->name);
                                                $initials = '';
                                                foreach ($names as $name) {
                                                    if (!empty($name)) {
                                                        $initials .= $name[0];
                                                    }
                                                }
                                            @endphp     
                                            <div class="w-40 h-40 rounded-full bg-gray-300 text-gray-500 flex justify-center items-center text-6xl font-semibold">
                                                {{ strtoupper($initials) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white">
                                            {{ $driver->name}}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $driver->email }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Currently driving: {{ $driver->currently_driving_string }}
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
</x-app-layout>