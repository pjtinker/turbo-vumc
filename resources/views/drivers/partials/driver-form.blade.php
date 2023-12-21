<form action="{{ isset($driver) ? route('drivers.update', $driver->id) : route('drivers.store') }}" method="POST" class="w-full">
    @csrf
 
    <div>
        @csrf
        @if(isset($driver))
            @method('patch')
        @endif

        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
            <div class="flex-shrink-0">
                @if(isset($driver) && $driver->avatar_url)
                    <img class="w-40 h-40 rounded-full" src="{{ $driver->avatar_url }}" alt="{{ $driver->name }}'s Avatar">
                @else
                    <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center">
                        <!-- You can replace this icon with your preferred image or icon for uploading -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                @endif            
            </div>
            
            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="name">Name</x-input-label>
                <input id="name" name="name" type="text" value="{{ isset($driver) ? $driver->name : old('name') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="email">Email Address</x-input-label>
                <input id="email" name="email" type="email" value="{{ isset($driver) ? $driver->email : old('email') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="years_of_experience">Years of Experience</x-input-label>
                <input id="years_of_experience" name="years_of_experience" type="number" value="{{ isset($driver) ? $driver->years_of_experience : old('years_of_experience') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('years_of_experience')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="can_drive_manual">Can Drive Manual</x-input-label>
                <input type="hidden" name="can_drive_manual" value="0">
                <input id="can_drive_manual" value="1" name="can_drive_manual" type="checkbox" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring"
                    @if (isset($driver) && $driver->can_drive_manual)
                        checked
                    @endif
                >
            </div>
        </div>
    </div>
 
    <div class="mt-6">
        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>