<div>
    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
        @include('partials.avatar', ['item' => $automobile, 'type' => 'automobile', 'editable' => 'false'])
        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="name">Make</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $automobile->make }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="email">Model</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $automobile->model }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="years_of_experience">Year</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $automobile->year }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="years_of_experience">Number of Cylinders</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $automobile->number_of_cylinders }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="can_drive_manual">Automatic</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                @if ($automobile->automatic)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="can_drive_manual">Current Driver</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                @if (isset($automobile->driver))
                    <a href="{{ route('drivers.show', $automobile->driver) }}">
                        {{ $automobile->driver->name}}
                    </a>
                @else
                    <div class="">
                        No driver is currently assigned to this automobile.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
