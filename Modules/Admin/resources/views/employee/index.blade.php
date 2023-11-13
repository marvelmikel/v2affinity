@extends('voyager::master')

@section('page_title', __('Employees'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    @if(Auth::user()->role_id === 2)
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-people"></i>{{ __('Employees') }}</h3>
                <div style="display:flex;">
                    <a href="{{ route('voyager.employee.create') }}" style="margin-right:2px" class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New Employee</a></div>
            </div>
            <div class="clear"></div>
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                {{$dataTable->table()}}
                </div>
            </div>

        </div><!-- .row -->
    </div><!-- .col-md-12 -->
    @else
<!-- list of emplee for the company-->
    <h1 class="page-title">
    <i class="voyager-company"></i>
    List of Employees
</h1>
    @endif
</div><!-- .page-content container-fluid -->
@stop

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection



