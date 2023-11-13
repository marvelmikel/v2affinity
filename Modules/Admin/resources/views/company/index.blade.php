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
                <h3><i class="voyager-company"></i> {{ __('Company') }}</h3>
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
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ $companyData['company_name'] }}"
                        class="form-control" readonly style="background-color: white; color:black;font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label for="company_address">Company Address</label>
                    <input type="tel" name="company_address" id="company_address"
                        value="{{ $companyData['company_address'] }}" class="form-control" readonly style="background-color: white;color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label for="company_phone">Company Phone Number</label>
                    <input type="tel" name="company_phone" id="company_phone"
                        value="{{ $companyData['company_phone'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label for="company_email">Company Email</label>
                    <input type="tel" name="company_email" id="company_email"
                        value="{{ $companyData['company_email'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label for="company_number">Company Reg Number</label>
                    <input type="tel" name="company_number" id="company_number"
                        value="{{ $companyData['company_number'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>

                
            </div>

            <div class="form-group row">
            <div class="col-md-12">
                    <label for="terms_conditions"  style="font-weight:bolder;"><h1>Terms & Conditions</h1></label>
                    <br>
                    <p  style="background-color: white; color:black; font-weight:bolder; font-size:20px; height:100px">
                    {{ strip_tags ($companyData['terms_conditions']) }}
                   </p>
                </div>
               
            </div>
        </div>
          <!-- End Sales person & Store manager view Company information Only -->

@else

    <!-- Company Information Details View -->

    <h1 class="page-title">
        <i class="voyager-company"></i>
        Company Information
    </h1>

    <form action="{{ route('company.update', $company->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel-body">

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" style="color:black; font-weight:bolder;" value="{{ $companyData['company_name'] }}"
                        class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_address">Company Address</label>
                    <input type="tel" name="company_address" id="company_address"  style="color:black; font-weight:bolder;"
                        value="{{ $companyData['company_address'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_phone">Company Phone Number</label>
                    <input type="tel" name="company_phone" id="company_phone"  style="color:black; font-weight:bolder;"
                        value="{{ $companyData['company_phone'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_email">Company Email</label>
                    <input type="tel" name="company_email" id="company_email"  style="color:black; font-weight:bolder;"
                        value="{{ $companyData['company_email'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_number">Company Reg Number</label>
                    <input type="tel" name="company_number" id="company_number"  style="color:black; font-weight:bolder;"
                        value="{{ $companyData['company_number'] }}" class="form-control" required>
                </div>

                
            </div>

            <div class="form-group row">
            <div class="col-md-12">
                    <label for="terms_conditions" style="font-weight:bolder;"><h1>Terms & Conditions</h1></label>
                    <textarea name="terms_conditions" id="terms_conditions" class="form-control richTextBox" style="font-size:20px;"
                        required>{{ $companyData['terms_conditions'] }}</textarea>
                </div>
               
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Information</button>

    </form>
   <!-- End of  Company Information Details View  -->
    @endif
  
</div>
<!-- .page-content container-fluid -->
@stop
<!-- Include the Froala Editor JS and CSS files -->
<script src="https://cdn.jsdelivr.net/npm/froala-editor@3.2.6"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.6/css/froala_editor.pkgd.min.css">

<!-- Initialize the Froala Editor on the textarea -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    new FroalaEditor('#terms_conditions');
});
</script>

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection