@extends('voyager::master')

@section('page_title', __('User Guide v1'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('User Guide v1') }}</h3>
                <div style="display:flex;">
                    testing
                </div>
                <div class="clear"></div>
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                       testing
                    </div>
                </div>
                <!-- .row -->
            </div><!-- .col-md-12 -->
        </div><!-- .page-content container-fluid -->
    </div><!-- .page-content container-fluid -->
    @stop
