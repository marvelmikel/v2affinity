@extends('voyager::master')

@section('page_title', __('Create Store'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title">
    <i class="voyager-basket"></i>
    New Store
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="{{ route('voyager.stores.store') }}" method="POST"
                    enctype="multipart/form-data">

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
                        <div class="form-group">
                            <label for="store_name">Store Name</label>
                            <input class="form-control" type="text" value="{{ old('store_name') }}" name="store_name"
                                id="store_name" required>
                        </div>

                        <div class="form-group">
                            <label for="store_logo">Store Logo</label>
                            <input class="form-control" type="file" value="{{ old('store_logo') }}" name="store_logo"
                                id="store_logo" required>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label for="store_phone">Store Telephone No</label>
                                <input type="text" class="form-control" value="{{ old('store_phone') }}"
                                    name="store_phone" id="store_phone" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="store_email">Store Email</label>
                                <input type="email" class="form-control" value="{{ old('store_email') }}"
                                    name="store_email" id="store_email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label for="address_line_1">Store Address Line 1</label>
                                <input type="text" class="form-control" value="{{ old('address_line_1') }}"
                                    name="address_line_1" id="address_line_1" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address_line_2">Store Address Line 2</label>
                                <input type="text" class="form-control" value="{{ old('address_line_2') }}"
                                    name="address_line_2" id="address_line_2" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="address_city">Store Address City</label>
                                <input type="text" class="form-control" value="{{ old('address_city') }}"
                                    name="address_city" id="address_city" required>
                            </div>

                            <div class="col-md-4">
                                <label for="address_county">Store Address Country</label>
                                <input type="text" class="form-control" value="{{ old('address_county') }}"
                                    name="address_county" id="address_county" required>
                            </div>

                            <div class="col-md-4">
                                <label for="address_postcode">Store Address Postcode</label>
                                <input type="text" class="form-control" value="{{ old('address_postcode') }}"
                                    name="address_postcode" id="address_postcode" required>
                            </div>
                        </div>
                    </div><!-- panel-body -->




                    <div class="panel-footer">
                        <button type="submit" class="border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:opacity-75 duration-300 px-5 py-1.5 livvic-font-semibold px-6 py-1 mb-3 md:mb-0">Save Store</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>

</script>
@stop