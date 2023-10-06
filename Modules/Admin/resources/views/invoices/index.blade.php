@extends('voyager::master')

@section('page_title', __('voyager::generic.media'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('Invoices') }}</h3>
                <div style="display:flex;">
                    <a href="{{ route('voyager.invoices.create') }}" style="margin-right:2px" class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New</a></div>
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


