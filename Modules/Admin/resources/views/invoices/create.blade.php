@extends('voyager::master')

@section('page_title', __('Create Invoice'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager.wallet"></i>
        New Invoice
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
                          action="{{ route('voyager.invoices.store') }}"
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
                                <label for="name">Title</label>
                                <input class="form-control" type="text" value="{{ old('title') }}" name="title" id="">
                            </div>

                            <div class="form-group">
                                <label for="name">Description</label>
                                <input class="form-control" type="text"  value="{{ old('description') }}" name="description" id="">
                            </div>


                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="name">Store</label>
                                    <select class="form-control select" value="{{ old('store_id') }}" name="store_id" id="">
                                        <option value="1">Miana Store</option>
                                        <option value="2">Suppiuns Store</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="name">Due Date</label>
                                    <input type="date" class="form-control" type="text" value="{{ old('due_at') }}" name="due_at" id="">
                                </div>
                            </div>

                           

                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_name') }}" name="customer_name" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Email</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_email') }}"  name="customer_email" id="">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Address Line 1</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_1') }}" name="customer_address_line_1" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Address Line 2</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_2') }}" name="customer_address_line_2" id="">
                                </div>
                            </div>

                          
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="name">Customer City</label>
                                    <input type="text" class="form-control" type="text"  value="{{ old('customer_address_city') }}" name="customer_address_city" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Customer Country</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_country') }}" name="customer_address_country" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Customer Postcode</label>
                                    <input type="text" class="form-control" type="text" value="{{ old('customer_address_postcode') }}" name="customer_address_postcode" id="">
                                </div>
                            </div>


                          

                        </div><!-- panel-body -->
                      
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Next</button>
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
