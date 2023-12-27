<x-app-layout :title="__('Driver Info')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('drivers.index') => __('Drivers'), route('drivers.show', $driver) => __($driver->name), __('Assign Automobiles')]" />
        </h2>
    </x-slot>
    <form action="{{  route('drivers.automobiles.assign', ['driver' => $driver->id]) }}" method="POST" class="w-full">
        @csrf
            <div class="py-12">
                @if(isset($automobiles) && $automobiles->count())
                <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl mx-auto">
                            <div class="max-w-xl mx-auto">
                                <ul role="list" class="divide-y divide-gray-100"> 
                                    @foreach ($automobiles as $automobile)
                                        <li class="p-4 hover:bg-blue-950">
                                            <div class="flex">
                                                <div class="mx-3">
                                                    <input class="form-check-input" type="checkbox" name="automobiles[]" value="{{ $automobile->id }}"
                                                    id="automobile{{ $automobile->id }}"
                                                    {{ in_array($automobile->id, $driver->automobiles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <img class="w-40 h-40 rounded-full" src="{{ $automobile->avatar_url }}" alt="">
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-white">
                                                        {{ $automobile->make}}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $automobile->model }}
                                                    </p>
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