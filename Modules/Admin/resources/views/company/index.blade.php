@extends('voyager::master')

@section('page_title', __('Company'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')

    @if(Auth::user()->role_id === 1)
        <!-- Admin view of all companies -->
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-company"></i> {{ __('Companies') }}</h3>
                </div>
                <div class="clear"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
        <!-- End Admin view of all companies -->
      
         <!-- Sales person & Store manager view Company information Only -->
    @elseif(Auth::user()->role_id === 3 || Auth::user()->role_id === 4)
       
       @include('includes.sales&manager-companyinfo')
        <!-- End Sales person & Store manager view Company information Only -->
    @else
        <!-- Company Information Details View -->
        @include('includes.companyinfo')
        <!-- End of  Company Information Details View  -->
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