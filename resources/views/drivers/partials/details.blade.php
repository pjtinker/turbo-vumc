<div>
    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
        @include('drivers.partials.avatar')
        
        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="name">Name</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $driver->name }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="email">Email Address</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $driver->email }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="years_of_experience">Years of Experience</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                {{ $driver->years_of_experience }}
            </div>
        </div>

        <div>
            <x-input-label class="text-gray-700 text-gray-900" for="can_drive_manual">Can Drive Manual</x-input-label>
            <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                @if ($driver->can_drive_manual)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
    </div>
</div>
