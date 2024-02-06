@extends('voyager::master')

@section('page_title', __('Company'))

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-10 text-gray-900">
            @livewire('subscriptions-edit', [ 'subscription' => $subscription ])
        </div>
    </div>
</div>
@endsection