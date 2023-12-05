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
                                    <option value="">Select a Store</option>
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>

        </div>


        <!-- invoice items -->
        <div class="col-md-12 ">
            <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                <h3><i class="voyager-list"></i> {{ __('Invoice Items') }}</h3>
                <div>
                    <!-- <a href="{{ route('voyager.invoices.add-item', $invoice->id) }}"  class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New Item</a>   -->
                    <a data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary"><i class="voyager-plus"></i>Add New Item</a>
                </div>
            </div>
            <div class="clear"></div>
            <br>

            <div class="card" style="max-height: 540px; overflow: scroll;">
                @foreach ($invoice->items as $invoiceItem)
                <table class="table " style="width:100%; margin: 40px 0;">
                    <tbody>
                        <form id="invoiceForm" action="{{ route('voyager.invoices.save-item', [$invoice->id, $invoiceItem->id]) }} ">
                            <tr class="invoice-item-meta" style="overflow: scroll;">
                                @foreach ($invoiceItem->meta as $meta)
                                <!-- did this so I can put the formular at the end of the meta list -->
                                @if ($meta->name != 'formular')
                                @if ($meta->type == 'formular')
                                <td style="min-width: 200px;" class="{{ $meta->visibility }}">
                                    <input disabled readonly class="form-control  {{ $meta->visibility }} " type="text" name="{{ $meta->name }}[]" value="{{ $meta->title }}" required>
                                    <input disabled readonly style="background-color: white;" class="form-control evaluated-input  {{ $meta->visibility }}" name="{{ $meta->name }}[]" value="{{ evaluate_formular($meta->value, 'InvoiceItemMeta', $invoiceItem->id, $meta->modifier) }}" type="{{ $meta->type }}" {{ $meta->visibility }} required>

                                    <input disabled readonly style="background-color: white;" class="form-control  {{ $meta->visibility }}" type="hidden" name="{{ $meta->name }}[]" value="{{ $meta->identifier }}" required>
                                </td>
                                @else
                                <td style="min-width: 200px;" class="{{ $meta->visibility }}">
                                    <input disabled readonly class="form-control  {{ $meta->visibility }}" type="text" name="{{ $meta->name }}[]" value="{{ $meta->title }}" required>

                                    <input style="background-color: white;" class="form-control evaluated-input  {{ $meta->visibility }}" name="{{ $meta->name }}[]" value="{{ $meta->value }}" type="{{ $meta->type }}" {{ $meta->visibility }} required>

                                    <input readonly style="background-color: white;" class="form-control  {{ $meta->visibility }}" type="hidden" name="{{ $meta->name }}[]" value="{{ $meta->identifier }}" required>
                                </td>


                                @endif
                                @endif
                                @endforeach
                                <td>
                                <input disabled readonly class="form-control " type="text" name="location" value="Select Room Location" required>
                                <select class="form-control" name="" id="">
                                        <option selected value=""></option>
                                    </select>
                                </td>
                        

                                <!-- formula here -->
                                <!-- <tr>
                                                    <td><input disabled readonly  class="form-control" type="text" name="formular[]" value="formular" ></td>
                                                    <td><input readonly style="background-color: white;"  class="form-control" type="text" name="formular[]" value="{{ $invoiceItem->getMeta('formular') ? $invoiceItem->getMeta('formular')['value'] : '' }}"  ></td>
                                                    <td><input  readonly  style="background-color: white;" class="form-control" type="text" name="formular[]" value="{{ $invoiceItem->getMeta('formular') ? $invoiceItem->getMeta('formular')['identifier'] : '' }}"  ></td>
                                                </tr> -->

                                <!-- item total here -->

                                <td style="min-width: 200px;">
                                    <input disabled readonly class="form-control" type="text" value="Total Price(£)">
                                    <input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format($invoiceItem->item_total, 2) }}">
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-success"><i class="voyager-book"></i></button>
                                <td colspanss="3">
                                    <a href="{{ route('voyager.invoices.delete-item', [$invoice->id, $invoiceItem->id]) }}" style="text-decoration: none;" data-invoiceid="" class="btn btn-sm btn-danger"><i class="voyager-trash"></i></a>
                                    <!-- <a href="#" data-invoiceitemid="{{ $invoiceItem->id }}" class="btn btn-secondary btn-xs add-column-btn"><i class="voyager-plus"></i>Add Column</a> -->
                                </td>
                                </td>
                                <td>
                            </tr>

                        </form>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div><!-- .row -->

        <!-- 
        {{-- <h3><i class="voyager-credit-card"></i> {{ __('Invoice Pricing') }}</h3>
            <div>
    <livewire:invoices.edit :wire:key="$invoice->id" :invoice="$invoice" />
       </div> --}} -->


        <!-- invoice pricing Section -->
        <div class="col-md-12 ">
            invoice pricing
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
                            <th>Type</th>
                            <th>Indentifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('voyager.invoices.save-pricing', [$invoice->id]) }} ">

                        @foreach ($invoice->pricings as $pricing)
                            @if ($pricing->name != 'formular')
                            @if ($pricing->name == 'tax' || $pricing->name == 'discount')
                            <tr>
                                <td>
                                    <input disabled readonly class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->name }} " required>
                                </td>
                                <td>

                                    <input class="form-control" type="number" min="0" step="any" name="{{ $pricing->name }}[]" value="{{ $pricing->value }}" placeholder="{{ ucfirst($pricing->name) }} % " required>
                                </td>
                                <td>

                                <select class="form-control {{ ($pricing->name == 'tax') ? 'disabled-select' : '' }}" name="{{ $pricing->name }}[]" id="">
                                        <option selected value="{{ $pricing->type }}"">{{ $pricing->type }}</option>
                                        <option value="percentage">%</option>
                                        <option value="value">value(£)</option>
                                        <!-- <option value="formular">Formular</option> -->
                                    </select>

                                </td>
                                <td>
                                    <input readonly style="background-color: white;" class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->identifier }}">
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>
                                    <input disabled readonly class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->name }}{{ $pricing->name == 'subtotal' ? ' £' : '' }}">
                                </td>
                                <td>
                                    <input readonly class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->value }}" required>
                                </td>
                                <td>
                                <select class="form-control {{ ($pricing->name == 'subtotal') ? 'disabled-select' : '' }}" name="{{ $pricing->name }}[]" id="">
                                        <option selected value="{{ $pricing->type }}"">{{ $pricing->type }}</option>
                                                        <option value=" percentage">Percentage</option>
                                        <option value="value">Value</option>
                                        {{-- <option value="formular">Formular</option> --}}
                                    </select>
                                </td>
                                <td>
                                    <input readonly style="background-color: white;" class="form-control" type="text" name="{{ $pricing->name }}[]" value="{{ $pricing->identifier }}">
                                </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach

                            <!-- formula here -->
                            @if (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="formular[]" value="formular"></td>
                                <td><input class="form-control" type="text" name="formular[]" value="{{ $invoice->getPricing('formular')['value'] }}"></td>
                                <td>
                                    <select class="form-control" name="{{ $invoice->getPricing('formular')['name'] }}[]" id="">
                                        <option selected value="{{ $invoice->getPricing('formular')['type'] }}"">{{ $invoice->getPricing('formular')['type'] }}</option>
                                                <option value=" percentage">Percentage</option>
                                        <option value="value">Value</option>
                                        <option value="formular">Formular</option>
                                    </select>
                                </td>
                                <td><input readonly style="background-color: white;" class="form-control" type="text" name="formular[]" value="{{ $invoice->getPricing('formular')['identifier'] }}">
                                </td>
                            </tr>
                            @endif




                            <!-- item total here -->
                            <tr>
                                <td><input readonly class="form-control" type="text" value="Total Amount £"></td>
                                <td colspan="3"><input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format($invoice->total, 2) }}"></td>
                            </tr>

                            <tr>
                                <td colspan="4"><a href="#" data-invoiceid="{{ $invoice->id }}" class="btn btn-secondary btn-xs add-pricing-column-btn"><i class="voyager-plus"></i>Add Pricing Item Cost </a> </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-success"><i class="voyager"></i>Save Invoice</button>
                                    <a style="text-decoration: none;" target="_blank" href="" class="btn btn-primary"><i class="voyager"></i>Email Invoice</a>
                                    <a style="text-decoration: none;" href="{{ route('voyager.invoices.show', $invoice->id) }}" class="btn btn-primary"><i class="voyager"></i>Preview Invoice</a>
                                    <a style="text-decoration: none;" target="_blank" href="{{ route('voyager.invoices.pdf', $invoice->id) }}" class="btn btn-primary"><i class="voyager"></i>Invoice PDF</a>
                                </td>


                            </tr>

                        </form>
                    </tbody>
                </table>
            </div>
        </div>

    </div>




    <!-- Add invocie item column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_item_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
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
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


                <!-- Add invocie pricing column modal -->
                <div class=" modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="voyager-data"></i> Add New Pricing</h4>
                                    </div>
                                    <form action="{{ route('voyager.invoices.add-pricing-column', $invoice->id) }}" method="post">
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



       <!-- Add invoice product column modal -->
<div class="modal modal-info fade" tabindex="-1" id="add_product_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="voyager-data"></i> Add Invoice Product</h4>
            </div>
            <form action="{{ route('voyager.invoices.add-item', $invoice->id) }}" method="post">
                @csrf()
                @method('post')
                <div class="modal-body" style="overflow: scroll; min-height: 300px;">
                    <div>
                        <strong>Select Products:</strong>
                        <select id="multiple-checkboxes" name="product_ids[]" multiple="multiple">
                            @foreach ($products->where('company_id', $companyId) as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Rest of the modal body code -->
                </div>
                <!-- Rest of the form code -->
            </form>
        </div>
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
