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
                    <form class="form-edit-add" role="form"
                          action=""
                          method="POST">

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
                                <label for="name">Store Name</label>
                                <input class="form-control" type="text" value="{{ old('store_name') }}" name="store_name" id="">
                            </div>

                            <div class="form-group">
                                <label for="name"> Store Logo</label>
                                <input class="form-control" type="file"  value="{{ old('store_logo') }}" name="store_logo" id="">
                            </div>

                        
                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Store Telephone No</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_name') }}" name="customer_name" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Store Email</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_email') }}"  name="customer_email" id="">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Store Address Line 1</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_1') }}" name="customer_address_line_1" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Store Address Line 2</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_2') }}" name="customer_address_line_2" id="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="name">Store Address City</label>
                                    <input type="text" class="form-control" type="text"  value="{{ old('customer_address_city') }}" name="customer_address_city" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Store Address Country</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_country') }}" name="customer_address_country" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Store Address Postcode</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_postcode') }}" name="customer_address_postcode" id="">
                                </div>
                            </div>


                          

                        </div><!-- panel-body -->
                      
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Save Store</button>
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
