@extends('voyager::master')

@section('page_title', __('Company Subscription'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')


    <!-- Company Subscription Info -->
    @if(auth()->user()->activeSubscription() )
        <div class="card">
            @livewire('subscriptions')
        </div>
        <!-- End Company Subscription Info -->

    @else
        <div class="py-12">
           
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-10 text-gray-900">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        @livewire('subscription-new')
                     </div>
                </div>
           
        </div>
    
    @endif


</div>
<!-- .page-content container-fluid -->
@stop
<!-- Trix Editor -->
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection