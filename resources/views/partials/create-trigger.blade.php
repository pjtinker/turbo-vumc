@props(['type' => 'driver', 'url' => route('drivers.create')])

<div class="relative flex items-end justify-end py-2 px-2 rounded-lg">
    <a href="{{ $url }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ __('New ' . Str::ucfirst($type)) }}
    </a>
</div>