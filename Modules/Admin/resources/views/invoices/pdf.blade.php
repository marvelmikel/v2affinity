<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
    html {
        margin: 0;
        padding: 0;
    }

    body {
        /*background: url(images/pdf.png) top center no-repeat;*/
        background-size: cover;
        font-size: 0;
        font-family: 'Poppins', sans-serif;
    }

    p,
    span {
        font-size: 10px;
    }

    .box {
        background: #E0E1EE;
        box-sizing: border-box;
        height: 13px;
        margin-bottom: 4px;
        font-size: 9px;
        padding: 5px 2px;
    }

    .top_section {
        margin: 25px 30px 0 30px;
        height: 160px;
        position: relative;
        display: block;
    }

    .top_section>div {
        position: relative;
        display: inline-block;
        top: 0;
        height: 160px;
        vertical-align: top;
    }

    .top_section .logo_section {
        width: 28%;
    }

    .top_section .details_section_1 {
        margin-left: 1%;
        width: 40%;
    }

    .top_section .details_section_2 {
        margin-left: 1%;
        width: 30%;
    }

    .top_section .details_section_1 span,
    .top_section .details_section_2 span {
        font-size: 11px;
    }

    .top_section .logo_section .logo {
        width: auto;
        max-height: 72px;
        margin-bottom: 8px;
    }

    .item_table {
        height: 245px;
        margin: 5px 30px 0 30px;
        position: relative;
        display: block;
    }

    .item_table .table .table-header {
        font-size: 0;
        margin-bottom: 5px;
    }

    .item_table .table .table-header .table-cell {
        background: #C7C7E0;
        padding: 4px 0;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
        text-align: center;
    }

    .item_table .table .table-row .table-cell {
        background: #FFFBD5;
        padding: 5px 0;
        font-size: 12px;
        display: inline-block;
        position: relative;
        text-align: center;
    }

    .item_table .table .table-row .table-cell:after {
        content: '';
        display: block;
        position: absolute;
        margin-top: 15px;
        left: 10px;
        right: 10px;
        height: 1px;
        background: #000;
    }

    .item_table .table .table-row .table-cell {
        text-transform: uppercase;
    }

    .item_table .table .table-cell.cell-description {
        width: 33%;
        margin-right: 1%;
    }

    .item_table .table .table-cell.cell-colour {
        width: 15%;
        margin-right: 1%;
    }

    .item_table .table .table-cell.cell-size {
        width: 9.5%;
        margin-right: 1%;
    }

    .item_table .table .table-cell.cell-quantity {
        width: 9.5%;
        margin-right: 1%;
    }

    .item_table .table .table-cell.cell-code {
        width: 12%;
        margin-right: 1%;
    }

    .item_table .table .table-cell.cell-selling-price {
        width: 16%;
    }

    .item_table .table .table-row .table-cell.cell-selling-price span {
        display: inline-block;
        position: relative;
        width: 48%;
        text-align: center;
    }

    .item_table .table .table-row .table-cell.cell-selling-price span:first-of-type:after {
        content: '';
        height: 100%;
        width: 1px;
        background: #000;
        position: absolute;
        display: block;
        right: 0;
        top: -5px;
    }

    .totals {
        height: 170px;
        margin: 0 30px;
        position: relative;
        display: block;
        font-size: 0;
        border-bottom: 1px dotted #000;
    }

    .totals .totals_details {
        display: inline-block;
        vertical-align: top;
        width: 60%;
    }

    .totals .totals_details .container {
        display: block;
        border: 1px solid #000;
        margin-top: 10px;
        height: 36px;
        box-sizing: border-box;
        padding: 10px;
    }

    .totals .totals_details .container p {
        margin: 0;
    }

    .totals .totals_details .container:first-of-type {
        margin-bottom: 10px;
    }

    .totals .totals_price {
        display: inline-block;
        vertical-align: top;
        width: 40%;
    }

    .totals .totals_price .price_row {
        display: block;
        margin-bottom: 3px;
        text-align: right;
    }

    .totals .totals_price .price_row:first-of-type {
        margin-top: 10px;
    }

    .totals .totals_price .price_row .price_row_title {
        display: inline-block;
        width: 55%;
        margin-right: 3%;
        text-align: right;
        vertical-align: middle;
    }

    .totals .totals_price .price_row .price_row_title span {
        font-size: 12px;
        font-weight: bold;
    }

    .totals .totals_price .price_row .price_row_box {
        display: inline-block;
        width: 39%;
        background: #C7C7E0;
        height: 23px;
        vertical-align: middle;
        line-height: 20px;
        text-align: center;
    }

    .totals .totals_payment {
        text-align: right;
    }

    .totals .totals_payment p {
        font-weight: bold;
        font-size: 12px;
        margin: 5px 0 0 0;
    }

    .totals .totals_payment p .payment_box {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 1px solid #000;
        margin-right: 10px;
    }

    .totals .totals_payment p .payment_box:last-of-type {
        margin: 0;
    }

    .checklist {
        height: 285px;
        margin: 0 30px;
        position: relative;
        display: block;
        font-size: 0;
        top: 0;
        left: 0;
    }

    .checklist img {
        position: absolute;
        display: block;
        bottom: 0;
        left: 0;
    }

    .checklist .checkbox {
        position: absolute;
        display: block;
        font-size: 14px;
        text-align: center;
        line-height: 16px;
        height: 16px;
        width: 35px;
        z-index: 100;
    }

    .checklist .checkbox.underlay {
        top: 86px;
    }

    .checklist .checkbox.grippers {
        top: 113px;
    }

    .checklist .checkbox.doorplates {
        top: 141px;
    }

    .checklist .checkbox.doorplatestypebrass {
        top: 141px;
        left: 190px;
    }

    .checklist .checkbox.doorplatestypealuminium {
        top: 161px;
        left: 190px;
    }

    .checklist .checkbox.yes {
        left: 252px;
    }

    .checklist .checkbox.no {
        left: 286px;
    }

    .checklist .checkbox.reuse {
        left: 320px;
    }

    .checklist .checklist_left {
        width: 50%;
        display: inline-block;
        position: relative;
    }

    .fitting {
        height: 95px;
        margin: 16px 30px 0;
        position: relative;
        display: block;
        padding: 10px;
        border: 1.5px solid #000;
        font-size: 0;
    }

    .fitting .fitting_row_title span {
        font-size: 12px;
        font-weight: bold;
    }

    .fitting .fitting_details {
        display: inline-block;
        vertical-align: top;
        width: 60%;
    }

    .fitting .fitting_price {
        display: inline-block;
        vertical-align: top;
        width: 40%;
    }

    .fitting .fitting_price .price_row {
        display: block;
        margin-bottom: 3px;
        text-align: right;
    }

    .fitting .fitting_price .price_row:first-of-type {
        margin-top: 20px;
    }

    .fitting .fitting_price .price_row .price_row_title {
        display: inline-block;
        width: 55%;
        margin-right: 3%;
        text-align: right;
        vertical-align: middle;
    }

    .fitting .fitting_price .price_row .price_row_title span {
        font-size: 12px;
        font-weight: bold;
    }

    .fitting .fitting_price .price_row .price_row_box {
        display: inline-block;
        width: 39%;
        background: #C7C7E0;
        height: 23px;
        vertical-align: middle;
        line-height: 20px;
        text-align: center;
    }

    .accessories {
        height: 22px;
        margin: -4px 30px -2px;
        position: relative;
        display: block;
    }

    .accessories .accessory {
        display: inline-block;
        width: 24%;
        height: 32px;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .accessories .accessory:nth-of-type(1),
    .accessories .accessory:nth-of-type(2),
    .accessories .accessory:nth-of-type(3) {
        margin-right: 1.333333%;
    }

    .accessories .accessory .accessory-header {
        display: inline-block;
        width: 50%;
        height: 100%;
        background: #C7C7E0;
        font-size: 11px;
        font-weight: bold;
        white-space: normal;
    }

    .accessories .accessory .accessory-header span {
        display: block;
        padding: 4px 8px;
    }

    .accessories .accessory .accessory-cell {
        display: inline-block;
        width: 50%;
        height: 100%;
        background: #FFFBD5;
        text-align: center;
        white-space: normal;
    }

    .accessories .accessory .accessory-cell span {
        display: block;
        font-size: 12px;
        padding: 9px 8px 4px;
        margin: 0px 10px;
        border-bottom: 1px solid #000;
    }

    .footer {
        height: 40px;
        overflow: hidden;
        margin: 16px 30px 0;
        position: relative;
        display: block;
        font-size: 0;
    }

    .footer .store_details {
        display: inline-block;
        vertical-align: top;
        width: 60%;
        color: #415280;
    }

    .footer .store_details p {
        margin: 0;
    }

    .footer .copy {
        position: relative;
        display: inline-block;
        vertical-align: top;
        width: 40%;
    }

    .footer .copy p {
        margin: 0;
        padding-top: 8px;
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: right;
        color: #fe0000;
    }

    .footer .copy_black {
        position: relative;
        display: inline-block;
        vertical-align: top;
        width: 40%;
    }

    .footer .copy_black p {
        margin: 0;
        padding-top: 8px;
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: right;
    }

    img {
        -webkit-filter: grayscale(100%);
        /* Safari 6.0 - 9.0 */
        filter: grayscale(100%);
    }
    </style>
</head>

<body>

    <div class="top_section">
        <div class="logo_section">
            {{-- Link src to Store logo --}}
            <img class="logo" src="images/united_carpets/logo.png">
            <p style="text-transform:uppercase;margin:0;color:#415280;font-weight:bold;">Store: {{ $store->store_name }}
            </p>
            <p style="text-transform:uppercase;margin:0;color:#415280;">
                {{ $store->address_line_1 }},
                {{ $store->address_line_2 }},
                {{ $store->address_city }},
                {{ $store->address_postcode }}.
            </p>
            <p style="text-transform:uppercase;margin:3px 0 0 0;color:#415280;font-weight:bold;">
                Tel No: {{ $store->store_phone }}
            </p>
        </div>
        <div class="details_section_1">
            <div class="box" style="border:2px solid #000;">
                <strong>Email:</strong>
                <span>{{ $customer->email }}</span>
            </div>
            <div class="box">
                <strong>Customer Name:</strong>
                <span>{{ $customer->name }}</span>
            </div>
            <div class="box" style="height: 30px;">
                <strong>Address:</strong>
                <span style="line-height: 1">
                    {{ $customer->address_line_1 }}<br />
                    {{ $customer->address_line_2 }}<br />
                    {{ $customer->address_city }}<br />
                </span>
            </div>
            <div class="box">
                <strong>Postcode:</strong>
                <span>{{ $customer->address_postcode }}</span>
            </div>
            <div class="box">
                <strong>Tel No:</strong>
                <span>{{ $customer->phone }}</span>
            </div>
        </div>
        <div class="details_section_2">
            <p style="font-size:23px;font-weight:bold; line-height:0;">INVOICE</p>
            <p style="text-transform:uppercase;margin:0px 0 12px 0;font-size:7px; line-height:0;">
                SALE SUBJECT TO TERMS & CONDITIONS OVERLEAF
            </p>
            <div class="box" style="height: 30px;">
                <strong>Invoice:</strong><br>
                <strong style="font-size:18px">{{ rand(10, 100) }}</strong>
            </div>
            <div class="box">
                <strong>Date:</strong>
                <span>{{ \Carbon\Carbon::make($invoice->created_at)->toDateString() }}</span>
            </div>
            <div class="box">
                <strong>Sales Person:</strong>
                <span>{{ $user->name }}</span>
            </div>
        </div>
    </div>
    <div class="item_table">
        <div class="table">
            <div class="table-header">
                <span class="table-cell cell-description">Item</span>
                <span class="table-cell cell-colour">Description</span>
                <span class="table-cell cell-size">Size</span>
                <span class="table-cell cell-quantity">Area (m²)</span>
                <span class="table-cell cell-selling-price empty">&nbsp; Item Price</span>
            </div>

            @foreach($invoice->items()->get() as $item)
            <div class="table-row">
                <span class="table-cell cell-description">{{ $item->getMeta('title')?->value }}</span>
                <span class="table-cell cell-colour"
                    style="font-size: xx-small">{{ Str::limit($item->getMeta('description')?->value, 15) }}</span>
                <span
                    class="table-cell cell-size">{{ $item->getMeta('Length')?->value . ' x ' . $item->getMeta('Width')?->value }}</span>
                <span
                    class="table-cell cell-quantity">{{ ($item->getMeta('Length')?->value * $item->getMeta('Width')?->value) ?? 'N/A' }}</span>
                <span class="table-cell cell-selling-price empty">{{ $item->item_total ?? 'N/A' }}</span>
                <!-- <span class="table-cell cell-selling-price empty">&nbsp;</span> -->
            </div>
            @endforeach

            {{-- This code is responsable to making sure there are always 8 rows on the invoice --}}
            @if($count < 8) @for($x=$count; $x < 8; $x++) <div class="table-row">
                <span class="table-cell cell-description">&nbsp;</span>
                <span class="table-cell cell-colour">&nbsp;</span>
                <span class="table-cell cell-size">&nbsp;</span>
                <span class="table-cell cell-quantity">&nbsp;</span>
                <span class="table-cell cell-selling-price empty">&nbsp;</span>
                <!-- <span class="table-cell cell-code">&nbsp;</span> -->
        </div>
        @endfor
        @endif
    </div>
    </div>

    <div class="accessories">
        <!-- <div class="accessory">
        <div class="accessory-header">
                <span>
                    UNDERLAY
                </span>
        </div>
        <div class="accessory-cell">
            <span>N/A</span>
        </div>
    </div> -->
        <!-- <div class="accessory">
        <div class="accessory-header">
            <span>Door Bar (3ft/9ft)</span>
        </div>
        <div class="accessory-cell">
            <span>N/A</span>
        </div>
    </div> -->
        <!-- <div class="accessory">
        <div class="accessory-header">
            <span>Spray Adhesive</span>
        </div>
        <div class="accessory-cell">
            <span>N/A</span>
        </div>
    </div> -->
        <!-- <div class="accessory">
        <div class="accessory-header">
            <span>Gripper Sticks</span>
        </div>
        <div class="accessory-cell">
            <span>N/A</span>
        </div>
    </div> -->
    </div>

    <div class="totals">
        <div class="totals_details">
            <!-- <div class="container">
            <p style="font-size:11px"><strong>Customers own sizes:</strong> N/A</p>
        </div> -->
            <!-- <div class="container">
            <p><strong>NEXT STEPS</strong></p>
            <p>A fitter introduced by us will make direct contact with you to agree their engagement with you and subject to that to make necessary arrangements.</p>
        </div> -->
        </div>
        <div class="totals_price">
            @foreach($invoice->pricings as $price)
            @if($price->name == 'formular')
            @php $totalDisplayed = false; @endphp



            @else
            <!-- Other pricing attributes-->
            <div class="price_row">
                <div class="price_row_title">
                    <span>{{ ucfirst($price->name) }} &pound;:</span>
                </div>
                <div class="price_row_box">
                    <span>{{ number_format($price->value, 2) }}</span>
                </div>
            </div>
            @endif

            @endforeach

            <!-- Total price -->
            @if (!$totalDisplayed)
            <div class="price_row">
                <div class="price_row_title">
                    <span>Total &pound;:</span>
                </div>
                <div class="price_row_box">
                    <span>{{ number_format($invoice->getTotalAttribute(), 2) }}</span>
                </div>
            </div>
            @php $totalDisplayed = true; @endphp
            @endif
        </div>
      
        
    </div>


    <footer class="footer" style="page-break-after:always;">
        <div class="store_details">
            <p>
                <strong>{{$company->company_name}}</strong>
            </p>
            <p>
                {{$company->company_address}},
               
            </p>
            <p>
                Company Registration No. {{$company->company_number}}
                <span style="margin-left:10px;">VAT Registration No.  {{$company->vat_number}}</span>
            </p>
        </div>
        <div class="copy">
            <p>CUSTOMER</p>
        </div>
    </footer>

    <div class="top_section">
    <p align=center style="color: black;  font-size: 20px;">
    Terms and Conditions
    </p>

    <br><br>
    <p style="color: black;  font-size: 18px;line-height: 30px;"> {{ strip_tags($company->terms_conditions) }} </p>
   
  
    </div>

</body>

</html>