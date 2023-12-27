@php
    $class = get_class($item);
    $model = $item;
    switch($class) {
        case "App\Models\Driver":
            $editRoute = 'drivers.edit';
            $assignedRoute = 'drivers.automobiles.assign';
            $deleteRoute = 'drivers.destroy';
            $id = 'driver_id';
            $actionNoun = 'Automobiles';
            break;
        case "App\Models\Automobile":
            $editRoute = 'automobiles.edit';
            $assignedRoute = 'automobile.drivers.assign';
            $deleteRoute = 'automobiles.destroy';
            $id = 'automobile_id';
            $actionNoun = 'Driver';
            break;
    }
@endphp

<div class="relative w-full">
    <div class="absolute top-0 right-0 m-2">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="{{ route($editRoute, $item) }}">{{ __('Edit') }}</x-dropdown-link>
                {{-- <x-dropdown-link href="{{ route($assignedRoute, [$id => $item->id]) }}">{{ __('Assign ' . $actionNoun) }}</x-dropdown-link> --}}
                <form action="{{ route($deleteRoute, $item) }}" method="POST">
                    @method('DELETE')
                    <x-dropdown-danger-button type="submit">{{ __('Delete') }}</x-dropdown-danger-button>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>