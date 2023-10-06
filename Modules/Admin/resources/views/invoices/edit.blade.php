@extends('voyager::master')

@section('page_title', __('Add Invoice Items Invoice'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-news"></i>
        Add Invoice Items
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-6">

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
                                <input class="form-control" type="text" value="{{ $invoice->title }}" name="title" id="">
                            </div>

                            <div class="form-group">
                                <label for="name">Description</label>
                                <input class="form-control" type="text"  value="{{ $invoice->description }}" name="description" id="">
                            </div>


                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="name">Store</label>
                                    <select class="form-control select" value="{{ $invoice->store_id }}" name="store_id" id="">
                                        <option value="1">Miana Store</option>
                                        <option value="2">Suppiuns Store</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="name">Due Date</label>
                                    <input type="date" class="form-control" type="text" value="{{ $invoice->due_at }}" name="due_at" id="">
                                </div>
                            </div>

                           

                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->name }}" name="customer_name" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Email</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->email }}"  name="customer_email" id="">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Address Line 1</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_line_1 }}" name="customer_address_line_1" id="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Customer Address Line 2</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_line_2 }}" name="customer_address_line_2" id="">
                                </div>
                            </div>

                          
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="name">Customer City</label>
                                    <input type="text" class="form-control" type="text"  value="{{ $invoice->customer->address_city }}" name="customer_address_city" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Customer Country</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_country }}" name="customer_address_country" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Customer Postcode</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_postcode }}" name="customer_address_postcode" id="">
                                </div>
                            </div>


                          

                        </div><!-- panel-body -->
                      
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>

                </div>
            </div>


            <div class="col-md-6 ">
                
                <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                    <h3><i class="voyager-list"></i> {{ __('Invoice Items') }}</h3>
                    <div>
                        <a href="{{ route('voyager.invoices.create') }}"  class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New</a>  
                    </div>                  
                </div>
                <div class="clear"></div>
                <br>
                <div class="card">
                    <table class="table " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Indentifier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-control" type="text" name="title" value="Title" id=""></td>
                                <td><input class="form-control" type="text" name="title_value" id=""></td>
                                <td><input class="form-control" type="text" name="title_indentifier" id=""></td>
                            </tr>

                            <tr>
                                <td><input class="form-control" type="text" name="price" value="Price" id=""></td>
                                <td><input class="form-control" type="text" name="value" id=""></td>
                                <td><input class="form-control" type="text" name="indentifier" id=""></td>
                            </tr>

                            <tr>
                                <td><input class="form-control" type="text" name="quantity" value="Quantity" id=""></td>
                                <td><input class="form-control" type="text" name="quantity_value" id=""></td>
                                <td><input class="form-control" type="text" name="quantity_indentifier" id=""></td>
                                
                            </tr>

                            <tr>
                                <td><input class="form-control" type="text" name="custom" value="" placeholder="Column Name" id=""></td>
                                <td><input class="form-control" type="text" name="custom_value"  placeholder="Column Value" id=""></td>
                                <td><input disabled readonly class="form-control" type="text" name="custom_indentifier"  placeholder="Column Key" id=""></td>
                            </tr>


                            <tr>
                                <td colspan="3"><a href="{{ route('voyager.invoices.create') }}"  class="btn btn-secondary btn-xs"><i class="voyager-plus"></i>Add Column</a>  </td>
                            </tr>

                            <tr>
                                <td><input class="form-control" type="text" name="formula" value="Formula" id=""></td>
                                <td colspan="2"><input class="form-control" type="text" name="formula_indentifier" id=""></td>
                            </tr>

                            <tr><td>
                                <a href="{{ route('voyager.invoices.create') }}"  class="btn btn-primary btn-xs"><i class="voyager"></i>Save Item</a> 
                            </td></tr>

                            

                           
                        </tbody>
                    </table>


                    <br>

                  
                </div>
            
    
            </div><!-- .row -->


        </div>



    </div>
@stop

@section('javascript')
    <script>
        
    </script>
@stop
