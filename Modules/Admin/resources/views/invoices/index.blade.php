@extends('voyager::master')

@section('page_title', __('Invoices'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('Invoices') }}</h3>
                <div style="display:flex;">
                    <a href="{{ route('voyager.invoices.create') }}" class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1">
                        <i class="voyager-plus"></i> Add New
                    </a>
                </div>
                <div class="clear"></div>
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        {{ $dataTable->table() }}
                    </div>
                </div>
                <!-- .row -->
            </div><!-- .col-md-12 -->
        </div><!-- .page-content container-fluid -->
    </div><!-- .page-content container-fluid -->
    @stop

    <!-- invoice logs modal -->
    @include('includes.invoice-modal-logs')
    <!-- End invoice logs modal -->

    @section('javascript')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endsection