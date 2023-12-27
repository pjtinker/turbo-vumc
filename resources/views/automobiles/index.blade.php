<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[__('Automobiles')]" />
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    {{-- @include('automobiles.partials.new-automobile-trigger') --}}
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach ($automobiles as $automobile)
                            <li class="p-4 hover:bg-blue-950">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <img class="w-40 h-40 rounded-full" src="{{ $automobile->avatar_url }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white">
                                            {{ $automobile->make}}
                                            <span class="text-sm text-gray-500">
                                                {{ $automobile->model }}
                                            </span>
                                        </p>
                                        @if (isset($automobile->driver))
                                            <div class="my-2">
                                                <p class="text-sm font-medium text-white">
                                                    Current driver: 
                                                    <a href="{{ route('drivers.show', $automobile->driver) }}" class="text-sm text-gray-500">
                                                        {{ $automobile->driver->name}}
                                                    </a>
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="ml-auto">
                                        <a href="{{ route('automobiles.show', $automobile) }}" class="text-sm text-gray-500">
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