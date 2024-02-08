@extends('voyager::master')

@section('page_title', __('Create Invoice'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title">
    <i class="voyager-file-text"></i>
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
                <form class="form-edit-add" role="form" action="{{ route('voyager.invoices.store') }}" method="POST">



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


                        <!-- <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control" type="text" value="{{ old('title') }}" name="title" id="">
                            </div> -->



                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_name') }}" name="customer_name" id="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Customer Email</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_email') }}" name="customer_email" id="">
                            </div>





                        </div>


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
                                <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="invoice_number">Invoice Number</label>
                                <span style="border: 1px solid whitesmoke; border-radius: 5px; padding: 2px 10px; background-color:#D95EAD; color:aliceblue" class="float-center cursor-pointer" onclick='generateInvoiceNumber()'>Generate</span>
                                <input class="form-control invoice_number" type="text" value="{{ $invoice->invoice_number }}" name="invoice_number" id="invoice_number" placeholder="Type in 'quote' if customer demand if not you can generate invoice number to proceed.">
                            </div>



                        </div>

                        <div class="form-group row">
                        <div class="col-md-4">
                                <label for="name">Customer Phone Number</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_phone_number') }}" name="customer_phone_number" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="name">Customer Address Line 1</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_1') }}" name="customer_address_line_1" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="name">Customer Address Line 2</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_address_line_2') }}" name="customer_address_line_2" id="">
                            </div>
                           
                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Customer City</label>
                                <input type="text" class="form-control" type="text" value="{{ old('customer_address_city') }}" name="customer_address_city" id="">
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
                        <button type="submit" class="border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:opacity-75 duration-300 px-5 py-1.5 livvic-font-semibold px-6 py-1 mb-3 md:mb-0">Next</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    // var checkbox = document.getElementById("invoiceNumberCheckbox");
    // var invoiceNumberField = document.getElementById("invoiceNumberField");

    // checkbox.addEventListener("change", function() {
    //     invoiceNumberField.disabled = !this.checked;
    //     if (this.checked) {
    //         invoiceNumberField.value = "";
    //     } else {
    //         invoiceNumberField.value = "{{ old('invoice_number') ?: $store->name . '-' . $invoice->id }}";
    //     }
    // });

    // invoice number generator 


function generateInvoiceNumber() {
    var pattern = /[a-zA-Z0-9_\-\+\.]/;

    function getRandomByte() {
        if (window.crypto && window.crypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    }

    function generate(length) {
        return Array.apply(null, { 'length': length })
            .map(function () {
                var result;
                while (true) {
                    result = String.fromCharCode(getRandomByte());
                    if (pattern.test(result)) {
                        return result;
                    }
                }
            })
            .join('');
    }

    // Generate a unique two-digit random number
    var randomNumber = ('0' + Math.floor(Math.random() * 100)).slice(-2);

    // Extract the first character of each word in the store name and convert to uppercase
    var storeNameParts = '<?php echo $store->store_name; ?>'.split(' ');
    var storeShortCode = '';
    for (var i = 0; i < storeNameParts.length; i++) {
        storeShortCode += storeNameParts[i].charAt(0).toUpperCase();
    }

    // Generate the invoice number in the format "INV-{store_name}-{random number}"
    var generatedNumber = 'INV-' + storeShortCode + '-' + randomNumber;

    var inputElements = document.getElementsByClassName("invoice_number");
    for (var i = 0; i < inputElements.length; i++) {
        inputElements[i].value = generatedNumber;
    }
}

</script>

@stop