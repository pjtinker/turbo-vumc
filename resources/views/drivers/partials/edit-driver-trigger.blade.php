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
                <x-dropdown-link href="{{ route('drivers.edit', $driver) }}">{{ __('Edit') }}</x-dropdown-link>
                <form action="{{ route('drivers.destroy', $driver) }}" method="POST">
                    @method('DELETE')
                    <x-dropdown-danger-button disabled="{{ isset($driver->automobiles) && $driver->automobiles->count() ? 'true' : 'false' }}" type="submit">{{ __('Delete') }}</x-dropdown-danger-button>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>