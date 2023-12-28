<form action="{{ isset($automobile) ? route('automobiles.update', $automobile->id) : route('automobiles.store') }}" method="POST" class="w-full">
    @csrf
    @if (isset($automobile))
        @method('patch')
    @endif
    <div>
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
            @include('partials.avatar', ['item' => isset($automobile) ? $automobile : null, 'type' => 'automobiles', 'editable' => 'true'])
            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="make">Make</x-input-label>
                <input id="make" name="make" type="text" value="{{ isset($automobile) ? $automobile->make : old('make') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('make')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="model">Model</x-input-label>
                <input id="model" name="model" type="text" value="{{ isset($automobile) ? $automobile->model : old('model') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('model')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="year">Year</x-input-label>
                <input id="year" name="year" type="number" value="{{ isset($automobile) ? $automobile->year : old('year') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('year')" class="mt-2" />
            </div>

            <div>
                <x-input-label class="text-gray-700 text-gray-900" for="number_of_cylinders">Number of Cylinders</x-input-label>
                <input id="number_of_cylinders" name="number_of_cylinders" type="number" value="{{ isset($automobile) ? $automobile->number_of_cylinders : old('number_of_cylinders') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring">
                <x-input-error :messages="$errors->get('number_of_cylinders')" class="mt-2" />
            </div>
            <div data-controller="automobile" data-automobile-drivers-value="{{ $drivers }}"> 
                <div>
                    <x-input-label class="text-gray-700 text-gray-900" for="automatic">Automatic</x-input-label>
                    <input type="hidden" name="automatic" value="0" >
                    <input id="automatic" 
                        value="1" 
                        name="automatic" 
                        type="checkbox"
                        data-action="change->automobile#updateSelectList"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md bg-gray-800 text-black border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:border-blue-300 focus:outline-none focus:ring"
                        {{ old('automatic', (isset($automobile) && $automobile->automatic ? '1' : '')) === '1' ? 'checked' : '' }}
                    >
                </div>

                <div> 
                    <x-input-label class="text-gray-700 text-gray-900" for="driver_id">Current Driver</x-input-label>
                    <div class="mt-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-md p-2">
                        <x-turbo-frame id="driver-select-frame">
                            @include('drivers.partials.driver_select', ['drivers' => $drivers, 'currentDriverId' => isset($automobile) ? $automobile->driver_id : ''])
                        </x-turbo-frame>
                </div>
            </div>
        </div>
    </div>
 
    <div class="mt-6" align="right">
        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>