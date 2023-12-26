<x-app-layout :title="__('Automobile Info')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('automobiles.index') => __('Automobiles'), __($automobile->make . ' ' . $automobile->model)]" />
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('partials.edit-trigger', ['item' => $automobile])
                {{-- <turbo-frame id="automobile_edit_{{ $automobile->id }}"> --}}
                    <div class="max-w-2xl mx-auto">
                        @include('automobiles.partials.details')
                    </div>
                {{-- </turbo-frame> --}}         
                <div class="max-w-2xl mx-auto">
                    {{-- @if(isset($automobile->automobiles) && $automobile->automobiles->count()) --}}
                        {{-- @include('automobiles.partials.list-automobiles', ['automobiles' => $automobile->automobiles]) --}}
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>