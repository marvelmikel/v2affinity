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
</div><!-- .page-content container-fluid -->
@stop

<!-- modal to view invoice logs -->
<div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-logbook"></i>Invoice Logs</h4>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Activity</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row">
                                            <td>1</td>
                                            <td>edhd</td>
                                            <td>snshs</td>
                                            <td>xbxhh</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                <!-- <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button> -->
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection