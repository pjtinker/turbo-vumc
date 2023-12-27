@props(['type' => 'driver', 'item' => null])

@php
    if(isset($item)) {
        switch($type) {
            case 'driver':
                $name = $item->name;
                break;
            case 'automobile':
                $name = $item->make . ' ' . $item->model;
                break; 
        }
    }
@endphp

<div class="flex-shrink-0">
    @if(isset($item))
        @if ($item->avatar_url)
            <img class="w-40 h-40 rounded-full" src="{{ $item->avatar_url }}" alt="Avatar">
        @else
            @php
                $names = explode(' ', $name);
                $initials = '';
                foreach ($names as $name) {
                    if (!empty($name)) {
                        $initials .= $name[0];
                    }
                }
            @endphp     
            <div class="w-40 h-40 rounded-full bg-gray-300 text-gray-500 flex justify-center items-center text-6xl font-semibold">
                {{ strtoupper($initials) }}
            </div>
        @endif
    @else
        <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
    @endif            
</div>