@extends('voyager::master')

@section('page_title', __('Build Invoice'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        .btn-group{
            width: 100% !important;
        }
        .modal-body button{
            width: 100% !important;
        }

        .multiselect-container {
            width: 100% !important;
        }

        

    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-news"></i>
        Build Invoice
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
                                        <option value="1">United Carpet Store</option>
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
                                <div class="col-md-4">
                                    <label for="name">Customer Address Line 1</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_line_1 }}" name="customer_address_line_1" id="">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Customer Address Line 2</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_line_2 }}" name="customer_address_line_2" id="">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Customer Phone Number</label>
                                    <input type="text" class="form-control" type="text" value="{{ $invoice->customer->phone }}" name="customer_phone_number" id="">
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
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
                <br>
                <br>

                <!-- invoice pricing -->
                <div class="card">
                    <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                        <h3><i class="voyager-credit-card"></i> {{ __('Invoice Pricing') }}</h3>
                    </div>
                    <div class="clear"></div>
                    <br>

                    <table class="table " style="width:100%; margin: 40px 0;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Indentifier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('voyager.invoices.save-pricing', [$invoice->id]) }} ">
                                
                                @foreach($invoice->pricings as $pricing)
                                    @if($pricing->name != 'formular')
                                        @if($pricing->name =='tax' || $pricing->name == 'discount')
                                        <tr>
                                            <td><input disabled readonly  class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->name }}" ></td>
                                            <td><input class="form-control" type="number" max="1" min="0" step="any" name="{{ $pricing->name }}[]" value="{{ $pricing->value }}"  ></td>
                                            <td><input readonly style="background-color: white;" class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->identifier }}"  ></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td><input disabled readonly  class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->name }}" ></td>
                                            <td><input class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->value }}"  ></td>
                                            <td><input readonly style="background-color: white;" class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->identifier }}"  ></td>
                                        </tr>
                                        @endif
                                    @endif
                                @endforeach

                                <!-- formula here -->
                                <tr>
                                    <td><input disabled readonly  class="form-control" type="text" name="formular[]" value="formular" ></td>
                                    <td><input class="form-control" type="text" name="formular[]" value="{{ $invoice->getPricing('formular')['value'] }}"  ></td>
                                    <td><input readonly style="background-color: white;" class="form-control" type="text" name="formular[]" value="{{ $invoice->getPricing('formular')['identifier'] }}"  ></td>
                                </tr>


                                <!-- item total here -->
                                <tr>
                                    <td><input disabled readonly  class="form-control" type="text" value="Amount" ></td>
                                    <td colspan="2" ><input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format($invoice->total, 2) }}"  ></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><a href="#"   data-invoiceid="{{ $invoice->id  }}" class="btn btn-secondary btn-xs add-pricing-column-btn"><i class="voyager-plus"></i>Add Pricing Item Cost </a> </td>
                                </tr>

                        

                                <tr>
                                    <td>
                                    <button type="submit" class="btn btn-success"><i class="voyager"></i>Save Invoice</button>
                                    <a style="text-decoration: none;"  href="" class="btn btn-primary"><i class="voyager"></i>Print Invoice</a>
                                </td>
                                <td>  
                                    <a style="text-decoration: none;"  href="" class="btn btn-primary"><i class="voyager"></i>Email Invoice </a>
                                    <a style="text-decoration: none;"  href="" class="btn btn-primary"><i class="voyager"></i>Invoice Pdf</a>
                                </td>
                               
                            </tr>



                                

                            </form>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- invoice items -->
            <div class="col-md-6 ">
                <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                    <h3><i class="voyager-list"></i> {{ __('Invoice Items') }}</h3>
                    <div>
                        <!-- <a href="{{ route('voyager.invoices.add-item', $invoice->id) }}"  class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New Item</a>   -->
                        <a data-toggle="modal" data-target="#add_product_modal"   class="btn btn-primary"><i class="voyager-plus"></i>Add New Item</a>  
                    </div>                  
                </div>
                <div class="clear"></div>
                <br>

                <div class="card" style="max-height: 540px; overflow: scroll;">
                    @foreach($invoice->items as $invoiceItem)
                        <table class="table " style="width:100%; margin: 40px 0;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <!-- <th>Indentifier</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('voyager.invoices.save-item', [$invoice->id, $invoiceItem->id]) }} ">
                                    @foreach($invoiceItem->meta as $meta)
                                        <!-- did this so I can put the formular at the end of the meta list -->
                                        @if($meta->name != 'formular')
                                            <tr>
                                                <td><input disabled readonly  class="form-control" type="text" name="{{ $meta->name }}[]" value="{{ $meta->name }}" ></td>
                                                <td><input style="background-color: white;"  class="form-control" name="{{ $meta->name }}[]" value="{{ $meta->value }}" type="{{ $meta->type }}" {{ $meta->visibility }}   ></td>
                                                <td><input readonly style="background-color: white;" class="form-control" type="text" name="{{ $meta->name }}[]" value="{{ $meta->identifier }}"  ></td>
                                            </tr>
                                        @endif

                                    @endforeach

                                   <!-- formula here -->
                                    <tr>
                                        <td><input disabled readonly  class="form-control" type="text" name="formular[]" value="formular" ></td>
                                        <td><input readonly style="background-color: white;"  class="form-control" type="text" name="formular[]" value="{{ $invoiceItem->getMeta('formular') ? $invoiceItem->getMeta('formular')['value'] : ''  }}"  ></td>
                                        <td><input  readonly  style="background-color: white;" class="form-control" type="text" name="formular[]" value="{{ $invoiceItem->getMeta('formular') ? $invoiceItem->getMeta('formular')['identifier'] : '' }}"  ></td>
                                    </tr>

                                     <!-- item total here -->
                                    <tr>
                                        <td><input disabled readonly  class="form-control" type="text" value="Item Total" ></td>
                                        <td colspan="2" ><input readonly style="background-color: white;" class="form-control" type="text" value="{{ $invoiceItem->item_total }}"  ></td>
                                    </tr>



                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-success"><i class="voyager"></i>Save Item</button>
                                        <td colspan="3"><a href="#" style="text-decoration: none;"  data-invoiceid="" class="btn btn-sm btn-danger"><i class="voyager-trash"></i> Remove item </a> </td>
                                    </td>
                                    <td>
                                </tr>

                              </form>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div><!-- .row -->
        </div>


    <!-- Add invocie item column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_item_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span  aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add Column</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-meta-column', $invoice->id) }}" method="post">
                    @csrf()
                    <div class="modal-body" style="overflow:scroll">
                   

                        <div>
                            <label for=""> Column Name </label>
                            <input  name="name" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Value </label>
                            <input name="value" type="text" class="form-control"></input>
                        </div>
                    
                        <input type="hidden" name="item_id" class="form-control"></input>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Add invocie pricing column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span  aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add New Pricing</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-pricing-column', $invoice->id) }}" method="post">
                    @csrf()
                    <div class="modal-body" style="overflow:scroll">
                   

                        <div>
                            <label for=""> Column Name </label>
                            <input  name="name" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Value </label>
                            <input name="value" type="text" class="form-control"></input>
                        </div>
                    
                        <input type="hidden" name="invoice_id" class="form-control"></input>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Add invocie produtct column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_product_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span  aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add Invoice Product</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-item', $invoice->id) }}" method="post">
                    @csrf()
                    @method('post')
                    <div class="modal-body" style="overflow:scroll; min-height: 300px;">
                   
                        <div>
                            <strong>Select Products:</strong>
                            <select id="multiple-checkboxes" name="product_ids[]" multiple="multiple">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>

                       
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    </div>
@stop

@section('javascript')
    <script>

        $(document).ready(function(){
            $('.add-column-btn').click(function(e){
                e.preventDefault();
                let invoiceitemid = $(this).data('invoiceitemid')
                console.log(invoiceitemid)
                $('input[name="item_id"]').val(invoiceitemid)
                $('#add_item_column_modal').modal('show');
            })


            $('.add-pricing-column-btn').click(function(e){
                e.preventDefault();
                let invoiceid = $(this).data('invoiceid')
                console.log(invoiceid)
                $('input[name="invoice_id"]').val(invoiceid)
                $('#add_pricing_column_modal').modal('show');
            })
        })


        $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });


    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">





@stop
