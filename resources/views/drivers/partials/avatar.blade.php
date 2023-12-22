<div class="flex-shrink-0">
    @if(isset($driver) && $driver->avatar_url)
        <img class="w-40 h-40 rounded-full" src="{{ $driver->avatar_url }}" alt="{{ $driver->name }}'s Avatar">
    @else
        <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
    @endif            
</div>