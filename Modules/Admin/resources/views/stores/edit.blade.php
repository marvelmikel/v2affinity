@extends('voyager::master')

@section('page_title', __('Build Store'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
@stop

@section('page_header')
<h1 class="page-title">
    <i class="icon voyager-shop"></i>
    Store Information
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="{{ route('stores.update', ['storeId' => $store->id]) }}"
                    method="POST" enctype="multipart/form-data">



                    <!-- CSRF TOKEN -->
                    @csrf
                    @method('PUT')

                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Store Name</label>
                                <input class="form-control" type="text" value="{{ $store->store_name}}"
                                    name="store_name" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Email</label>
                                <input class="form-control" type="text" value="{{ $store->store_email}}"
                                    name="store_email" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Store Phone</label>
                                <input class="form-control" type="text" value="{{ $store->store_phone}}"
                                    name="store_phone" id="">
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Address City</label>
                                <input class="form-control" type="text" value="{{ $store->address_city}}"
                                    name="address_city" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Address Country</label>
                                <input type="text" class="form-control" type="text" value="{{ $store->address_county}}"
                                    name="address_county" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Next Invoice Number</label>
                                <input type="number" class="form-control" value="{{ $store->next_invoice_number}}"
                                    name="next_invoice_number" id="">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Store Address Postcode</label>
                                <input type="text" class="form-control" type="text"
                                    value="{{ $store->address_postcode}}" name="address_postcode" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Address Line 1</label>
                                <input type="text" class="form-control" type="text" value="{{ $store->address_line_1}}"
                                    name="address_line_1" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Address Line 2</label>
                                <input type="text" class="form-control" value="{{ $store->address_line_2}}"
                                    name="address_line_2" id="">
                            </div>
                        </div>



                        <div class="form-group row">

                            <div class="col-md-4">
                                @if($store->store_logo)
                                <img src="{{ asset('storage/' . $store->store_logo) }}" alt="Store Logo"
                                    style="width: 100%; height: auto;">
                                @else
                                <p>No logo uploaded</p>
                                @endif
                            </div>

                            <input type="file" value="{{ $store->store_logo}}" name="store_logo" id="">

                        </div>

                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Update Store</button>
                    </div>
                </form>

            </div>

            <br>
            <br>

            <!-- Store Employees -->
            <div class="card">
                <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                    <h3><i class="voyager-people"></i> {{ __('Store Employees') }}</h3>
                </div>
                <div class="clear"></div>
                <br>
                <div style="max-height: 500px; overflow-y: auto;">

                    <table class="table " style="width:100%; margin: 40px 0;">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersAssignedToStore as $user)
                            @if ($user->id !== Auth::user()->id)
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="name"
                                        value="{{ $user->name }}"></td>

                                <td><input readonly class="form-control" type="text" name="role_name"
                                        value="{{ $user->role->name ?? 'N/A' }}"></td>

                                <td colspan="3">
                                    <!-- <a href="#" style='margin-right:2px; text-decoration: none;'
                                        class='btn btn-success btn-xs' data-toggle="modal"
                                        data-target="#add_item_column_modal">
                                        <i class="voyager-eye"></i>View</a> -->

                                    <form action="{{ route('delete-store-employee', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="voyager-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

        </div>





        <!-- store Email Settings -->
       {{-- @if (Auth::check() && Auth::user()->role_id == 1) --}}
        <div class="col-md-6 ">
            <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                <h3><i class="voyager-mail"></i> {{ __('Store Email Settings') }}</h3>
                <!-- <div>
                    <a href="" class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New Item</a>
                </div> -->
            </div>
            <div class="clear"></div>
            <br>
            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="" method="">



                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Host</label>
                                <input class="form-control" type="text" value="" name="title" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Port</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Username</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Password</label>
                                <input type="address" class="form-control" type="text" value="" name="due_at" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">From Address</label>
                                <input type="text" class="form-control" type="text" value="" name="customer_email"
                                    id="">
                            </div>
                        </div>

                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Save Store Email Settings</button>
                    </div>
                </form>

            </div>
        </div><!-- .row -->
    </div>
  
    {{-- @endif --}}

</div>
@stop
@section('javascript')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
</script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection