<div class="max-w-xl mx-auto">
    <ul role="list" class="divide-y divide-gray-100">
        @foreach ($automobiles as $automobile)
            <li class="p-4 hover:bg-blue-950">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <img class="w-40 h-40 rounded-full" src="{{ $automobile->avatar_url }}" alt="">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">
                            {{ $automobile->make}}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $automobile->model }}
                        </p>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('automobiles.show', $automobile) }}" class="text-sm text-gray-500">
                            View
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
