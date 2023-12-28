<x-app-layout :title="__('Automobile Info')">
    <x-slot name="header">
        <h2 class="flex items-center space-x-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :links="[route('automobiles.index') => __('Automobiles'), __($automobile->make . ' ' . $automobile->model)]" />
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text:lg text-gray-200">
                <span>
                    I left two methods for assigning a driver to an automobile. 
                    The first is the traditional way of using a select list. When you open the dropdown ellipsis and select 'Edit', the driver field becomes a select list.
                </br>
                    The second is using radiobutton and a list of drivers. To test, open the dropdown ellipsis and select 'Assign Driver'.
                </span>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('partials.edit-trigger', ['item' => $automobile])
                    <div class="max-w-2xl mx-auto">
                        @include('automobiles.partials.details')
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>