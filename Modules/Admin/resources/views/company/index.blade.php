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

    <!-- Sales person & Store manager view Company information Only -->

    @elseif(Auth::user()->role_id === 3 || Auth::user()->role_id === 4)
    <h1 class="page-title">
        <i class="voyager-company"></i>
        Company Information
    </h1>

    <div class="panel-body">

        <div class="form-group row">
            <div class="col-md-4">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" value="{{ $companyData['company_name'] }}" class="form-control" readonly style="background-color: white; color:black;font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_address">Company Address</label>
                <input type="tel" name="company_address" id="company_address" value="{{ $companyData['company_address'] }}" class="form-control" readonly style="background-color: white;color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_phone">Company Phone Number</label>
                <input type="tel" name="company_phone" id="company_phone" value="{{ $companyData['company_phone'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_email">Company Email</label>
                <input type="tel" name="company_email" id="company_email" value="{{ $companyData['company_email'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_number">Company Reg Number</label>
                <input type="tel" name="company_number" id="company_number" value="{{ $companyData['company_number'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>


        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="terms_conditions" style="font-weight:bolder;">
                    <h1>Terms & Conditions</h1>
                </label>
                <br>
                <p style="background-color: white; color:black; font-weight:bolder; font-size:20px; height:100px">
                    {{ strip_tags ($companyData['terms_conditions']) }}
                </p>
            </div>

        </div>
    </div>
    <!-- End Sales person & Store manager view Company information Only -->

    @else


    <!-- Company Subscription Info -->
    <div class="card">
        @livewire('subscriptions')
    </div>
    <!-- End Company Subscription Info -->

    <br><br>

    <!-- Company Information Details View -->

    <h1 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">
        <i class="voyager-company"></i>
        Company Information
    </h1>

    <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel-body">

            <div class="form-group row">
                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" style="color:black; font-weight:bolder;" value="{{ $companyData['company_name'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_address">Company Address</label>
                    <input type="tel" name="company_address" id="company_address" style="color:black; font-weight:bolder;" value="{{ $companyData['company_address'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_phone">Company Phone Number</label>
                    <input type="tel" name="company_phone" id="company_phone" style="color:black; font-weight:bolder;" value="{{ $companyData['company_phone'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_email">Company Email</label>
                    <input type="tel" name="company_email" id="company_email" style="color:black; font-weight:bolder;" value="{{ $companyData['company_email'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_number">Company Reg Number</label>
                    <input type="tel" name="company_number" id="company_number" style="color:black; font-weight:bolder;" value="{{ $companyData['company_number'] }}" class="form-control" required>
                </div>


            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="terms_conditions" style="font-weight:bolder;">
                        <h3>Terms & Conditions</h3>
                    </label>
                    <input type="hidden" name="terms_conditions" id="terms_conditions" class="form-control richTextBox" style="font-size:20px;" value="{{ $companyData['terms_conditions'] }}">
                    <trix-editor input="terms_conditions" class="trix-content"></trix-editor>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Info</button>

    </form>


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