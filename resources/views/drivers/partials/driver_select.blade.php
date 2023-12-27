
@props(['drivers' => [], 'currentDriverId' => ''])

<x-turbo-frame id="driver-select-frame">
    <select name="driver_id" data-automobile-target="driverSelect" id="driverSelect" class="form-control">
        <option value="">Select a Driver</option>
        @foreach ($drivers as $driver)
            <option value="{{ $driver->id }}"
                    {{ $currentDriverId == $driver->id ? 'selected' : '' }}>
                {{ $driver->name }}
            </option>
        @endforeach
    </select>
</x-turbo-frame>