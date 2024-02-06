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

    .btn-group {
        width: 100% !important;
    }

    .modal-body button {
        width: 100% !important;
    }

    .multiselect-container {
        width: 100% !important;
    }

    .hidden {
        display: none !important;
    }

    .disabled-select {
        pointer-events: none;
        opacity: 0.3;
    }

    /* Mobile view */
    @media (max-width: 767px) {
        .invoice-item-meta {
            display: block;
        }

        .invoice-item-meta td {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {

        .invoice-item-meta .meta-data,
        .invoice-item-meta .item-total,
        .invoice-item-meta .actions {
            display: block;
            /* Stack vertically on mobile */
            width: 100%;
        }
    }

    /* Optional: Style for larger screens */
    @media (min-width: 769px) {
        .invoice-item-meta td {
            display: inline-block;
            /* Align in a row for desktop */
        }
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
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="{{ route('voyager.invoices.update', $invoice->id) }}" method="POST">



                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}
                    @method('PATCH')

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
                            <div class="form-group col-md-6">
                                <label for="name">Store</label>
                                <select class="form-control select" value="{{ old('store_id') }}" name="store_id" id="">
                                    @if (Auth::user()->role_id == 2 && Auth::user()->company)
                                        <!-- For users with role_id = 2 (company role) and a valid company relationship -->
                                        <option value="{{ Auth::user()->store->id }}" @if (old('store_id')==Auth::user()->store->id) selected @endif> 
                                            {{ Auth::user()->store->store_name }}</option>
                                        @foreach (Auth::user()->company->stores ?? [] as $store)
                                            <option value="{{ $store->id }}" @if (old('store_id')==$store->id) selected @endif>
                                                {{ $store->store_name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <!-- For users with role_id = 3 or 4 -->
                                        @if (Auth::user()->store)
                                            <option value="{{ Auth::user()->store->id }}" @if (old('store_id')==Auth::user()->store->id) selected @endif>
                                                {{ Auth::user()->store->store_name }}
                                            </option>
                                        @else
                                            @php
                                             throw new \Exception('No store assigned to you yet');
                                            @endphp
                                        @endif
                                    @endif
                                </select>


                            </div>


                            <div class="form-group col-md-6">
                                <label for="name">Invoice Number</label>
                                <input class="form-control" type="text" value="{{ $invoice->invoice_number }}" name="invoice_number" id="">
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" type="text" value="{{ $invoice->customer->name }}" name="customer_name" id="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Customer Email</label>
                                <input type="text" class="form-control" type="text" value="{{ $invoice->customer->email }}" name="customer_email" id="">
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
                                <input type="text" class="form-control" type="text" value="{{ $invoice->customer->address_city }}" name="customer_address_city" id="">
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
                        <button type="submit" class="border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:opacity-75 duration-300 px-5 py-1.5 livvic-font-semibold px-6 py-1 mb-3 md:mb-0">Update</button>
                    </div>
                </form>

            </div>

        </div>
 <h3><i class="voyager-list"></i> Invoice Items</h3>

        <div>
            <livewire:invoices.edit :wire:key="'pricing' . $invoice->id" :invoice="$invoice" :products="$products" />
        </div>

    <!-- Add invocie item column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_item_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add Column</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-meta-column', $invoice->id) }}" method="post">
                    @csrf()
                    <div class="modal-body" style="overflow:scroll">

                        <div>
                            <label for=""> Column Title </label>
                            <input name="title" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Value </label>
                            <input name="value" type="text" class="form-control"></input>
                        </div>


                        <input type="hidden" name="item_id" class="form-control"></input>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{
                            __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Add invocie pricing column modal -->
{{--
    <div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add New Pricing</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-pricing-column', $invoice->id) }}"
                                    method="post">
                                    @csrf()
                                    <div class="modal-body" style="overflow:scroll">
                                        <div>
                                            <label for=""> Column Name </label>
                                            <input name="name" type="text" class="form-control"></input>
                                        </div>


                                        <div style="margin: 10px 0;">
                                            <label for=""> Column Value </label>
                                            <input name="value" type="text" class="form-control"></input>
                                        </div>

                                        <input name="visibility" value="visible" type="hidden" class="form-control"></input>

                                        <div>
                                            <label for=""> Select Operation </label>
                                            <select name="operation" class="form-control">
                                                <option value="+">Add</option>
                                                <option value="-">Subtract</option>
                                                <!-- <option value="*">Multiply</option>
                                                <option value="/">Divide</option> -->
                                            </select>
                                        </div>





                                        <input type="hidden" name="invoice_id" class="form-control"></input>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline mx-3 pull-right"
                                            data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
--}}

     <!-- Add invoice item column modal -->
    <div class=" modal modal-info fade" tabindex="-1" id="add_product_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="{{ __('voyager::generic.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add
                        Invoice Product</h4>
                </div>
                <form action="{{ route('voyager.invoices.add-item', $invoice->id) }}" method="post">
                                                                @csrf()
                                                                @method('post')
                    <div class="modal-body" style="overflow: scroll; min-height: 300px;"><div>
                            <strong>Select Products:</strong>
                            <select id="multiple-checkboxes"
                                 name="product_ids[]" multiple="multiple">
                                 @foreach ($products->where('company_id',
                                     $companyId) as $product)
                                     <option value="{{ $product->id }}">{{
                                     $product->title }}</option>
                                         @endforeach
                                         </select>
                                        </div>
                                                                    <!-- Rest of the modal body code -->
                                         </div>
                                                                <!-- Rest of the form code -->
                                     <div class="modal-footer">
                                    <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close')}}</button>
                                    <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
       </div>
                </form>
            </div>
        </div>
    </div>

 </form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 </div>
@endsection

@section('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        $('.add-column-btn').click(function(e) {
            e.preventDefault();
            let invoiceitemid = $(this).data('invoiceitemid');
            console.log(invoiceitemid);
            $('input[name="item_id"]').val(invoiceitemid);
            $('#add_item_column_modal').modal('show');
        });

        $('.add-pricing-column-btn').click(function(e) {
            e.preventDefault();
            let invoiceid = $(this).data('invoiceid');
            $('input[name="invoice_id"]').val(invoiceid);
            $('#add_pricing_column_modal').modal('show');
        });
    });

    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
            includeSelectAllOption: true,
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection
