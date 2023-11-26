@extends('voyager::master')

@section('page_title', __('Invoices'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('Invoices') }}</h3>
                <div style="display: flex;">
                    @if(auth()->user()->store)
                    <a href="{{ route('voyager.invoices.create') }}" style="margin-right:2px" class="btn btn-primary btn-xs">
                        <i class="voyager-plus"></i> Add New
                    </a>
                    @else
                    <!-- Button is disabled or hidden when user doesn't have a company_id in the store table -->
                    <button style="margin-right:2px" class="btn btn-primary btn-xs disabled" disabled>
                        <i class="voyager-plus"></i> Add New
                    </button>
                    @endif
                </div>
                <div class="clear"></div>
                <div class="card">

                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>

            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
    @stop

    @section('javascript')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endsection