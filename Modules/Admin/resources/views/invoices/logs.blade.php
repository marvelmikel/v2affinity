@extends('voyager::master')

@section('page_title', __('Invoice Logs'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-logbook"></i> {{ __('Invoice Logs') }} - {{$invoice->invoice_number}}</h3>
                <div style="display:flex;">
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


    @section('javascript')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endsection