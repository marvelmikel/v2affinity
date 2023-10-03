<x-default-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            @if(auth()->user()->subscriptions()->whereNot('status','Canceled')->get()->isEmpty())
                <p class="-my-2">
                    <x-button-link href="{{ route('subscription.create') }}">New Subscription</x-button-link>
                </p>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('subscriptions')
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
