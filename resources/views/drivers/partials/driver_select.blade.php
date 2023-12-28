
@props(['drivers' => [], 'currentDriverId' => ''])

<x-turbo-frame id="driver-select-frame">
    <select name="driver_id" data-automobile-target="driverSelect" id="driverSelect" class="form-control">
        <option value="">Select a Driver</option>
        @foreach ($drivers as $driver)
            <option value="{{ $driver->id }}"
                    {{ old('driver_id', $currentDriverId) == $driver->id ? 'selected' : '' }}>
                {{ $driver->name . ' ' . ($driver->can_drive_manual ? '(M)' : '(A)')}}
            </option>
        @endforeach
    </select>
</x-turbo-frame>