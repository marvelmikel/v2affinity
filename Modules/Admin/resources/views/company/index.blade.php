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
                <input type="text" name="company_name" id="company_name" value="{{ $companyData['company_name'] }}" class="form-control" readonly style="background-color: white; color:black;font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label for="company_address">Company Address</label>
                <input type="tel" name="company_address" id="company_address" value="{{ $companyData['company_address'] }}" class="form-control" readonly style="background-color: white;color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label for="company_phone">Company Phone Number</label>
                <input type="tel" name="company_phone" id="company_phone" value="{{ $companyData['company_phone'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label for="company_email">Company Email</label>
                <input type="tel" name="company_email" id="company_email" value="{{ $companyData['company_email'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>

            <div class="col-md-4">
                <label for="company_number">Company Reg Number</label>
                <input type="tel" name="company_number" id="company_number" value="{{ $companyData['company_number'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
            </div>


        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label for="terms_conditions" style="font-weight:bolder;">
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

    <!-- Company Information Details View -->

    <h1 class="page-title">
        <i class="voyager-company"></i>
        Company Information
    </h1>

    <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel-body">

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" style="color:black; font-weight:bolder;" value="{{ $companyData['company_name'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_address">Company Address</label>
                    <input type="tel" name="company_address" id="company_address" style="color:black; font-weight:bolder;" value="{{ $companyData['company_address'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_phone">Company Phone Number</label>
                    <input type="tel" name="company_phone" id="company_phone" style="color:black; font-weight:bolder;" value="{{ $companyData['company_phone'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_email">Company Email</label>
                    <input type="tel" name="company_email" id="company_email" style="color:black; font-weight:bolder;" value="{{ $companyData['company_email'] }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="company_number">Company Reg Number</label>
                    <input type="tel" name="company_number" id="company_number" style="color:black; font-weight:bolder;" value="{{ $companyData['company_number'] }}" class="form-control" required>
                </div>


            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="terms_conditions" style="font-weight:bolder;">
                        <h1>Terms & Conditions</h1>
                    </label>
                    <textarea name="terms_conditions" id="terms_conditions" class="form-control richTextBox" style="font-size:20px;" required>{{ $companyData['terms_conditions'] }}</textarea>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Information</button>

    </form>
    <br><br>

<!-- Room Locations-->
<div class="card" style="width:100%;">
    <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
        <h3><i class="voyager-location"></i> {{ __('Room Locations') }}</h3>
    </div>
    <div class="clear"></div>
    <br>
    <div class="" style="max-height: 500px; overflow-y: auto;">

        <table class="table " style="margin: 40px 0;">
            <thead>
                <tr>
                    <!-- <th>Id</th> -->
                    <th>Room Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @if ($roomLocations)
    @foreach ($roomLocations as $roomLocation)
<tr>
    <!-- <td style="width:0.1%;">
        <input disabled readonly class="form-control" type="text" name="name" value="{{ $roomLocation->id}}">
    </td> -->

    <td style="width:10%;">
        <input readonly class="form-control" type="text" name="room" value="{{ $roomLocation->room_name }}">
    </td>

    <td colspan="3" style="width:1%;">
        <a href="#" style='margin-right:2px; text-decoration: none;' class='btn btn-success btn-xs' data-toggle="modal" data-target="#add_item_column_modal">
            <i class="voyager-plus"></i>
        </a>

        <form action="{{ route('room-locations.delete', ['roomLocation' => $roomLocation]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">
                <i class="voyager-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach
@endif


            </tbody>
        </table>
    </div>
</div>


     <!-- Add Room Location Name column modal -->
<div class="modal fade" tabindex="-1" id="add_item_column_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-location"></i> Add New Room Location</h4>
            </div>
            <form action="{{ route('addRoomLocation') }}" method="post">
                @csrf()
                <div class="modal-body" style="overflow:scroll">
                    <div>
                        <label for=""> Room Location Name </label>
                        <input name="room_name" type="text" class="form-control"></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                    <button type="submit" class="btn btn-primary pull-right">{{ __('voyager::generic.save') }}</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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


    document.addEventListener('DOMContentLoaded', function() {
        const addColumnLink = document.getElementById('add_column_link');
        const modal = new bootstrap.Modal(document.getElementById('add_item_column_modal'));

        addColumnLink.addEventListener('click', function(event) {
            event.preventDefault();
            modal.show();
        });
    });
</script>

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection