<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Affinity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "red",
                    },
                    container: {
                        center: true,
                    },
                    fontFamily: {
                        Agbalumo: ["Agbalumo", "sans-serif"],
                        Quicksand: ["Quicksand", "serif"],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-slate-200">
    <div class="container w-full bg-white p-3 md:p-6 md:max-w-4xl">
        <div id="header" class="flex flex-wrap my-3 space-y-4 justify-between align-middle gap-0 h-auto md:flex-nowrap">
            <div class="flex flex-col flex-nowrap justify-around w-full md:basis-1/3">
                <!-- Store Details -->
                <div class="logo text-red-500 text-7xl font-Quicksand font-extrabold">
                    @if ($store->store_logo)
                    <img src="{{ url($store->store_logo) }}" alt="Store Logo" class="h-9">
                    @else
                    <img src="{{ url('images/affinity-email-logo.png') }}" alt="Affinity" class="h-9">
                    @endif
                </div>

                <div class="address text-xs">
                    <h6 class="font-bold">STORE: {{ $store->store_name}}</h6>
                    <p>{{ $store->address_line_1}}, {{ $store->address_line_2}}, {{ $store->address_city}}
                        {{ $store->address_postcode}}.
                    </p>
                    <h6 class="font-bold">TEL NO: {{ $store->store_phone}}</h6>
                </div>
            </div>
            <!-- Customer details -->
            <div class="w-full md:basis-2/3 md:flex-nowrap">
                <table class="border-separate border-spacing-1 w-full text-xs">
                    <tbody class="bg-slate-200">
                        <tr>
                            <td class="p-1">
                                <span class="font-bold"> Email:</span>
                                {{ $customer->email }}
                            </td>
                            <td class="p-1 text-xl/5 font-bold bg-white">INVOICE</td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <span class="font-bold"> Customer Name:</span>
                                {{ $customer->name }}
                            </td>
                            <td class="p-1 text-xs bg-white">
                                {{ $customer->email }}
                            </td>
                        </tr>

                        <tr class="relative">
                            <td class="p-1 flex flex-col text-xs/none">
                                <span> <span class="font-bold">Address: </span>
                                    {{ $customer->address_line_1 }}<br />
                                    {{ $customer->address_line_2 }}<br />
                                    {{ $customer->address_city }}.<br /></span>

                            </td>
                            <td class="p-1 flex-col font-bold">
                                <span> Invoice:</span> <br />
                                <span class="text-lg">{{ $invoice->invoice_number }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <span class="font-bold"> Postcode:</span>
                                {{ $customer->address_postcode }}
                            </td>
                            <td class="p-1">
                                <span class="font-bold"> Date:</span>
                                <span class="whitespace-nowrap">
                                    {{ \Carbon\Carbon::make($invoice->created_at)->toDateString() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <span class="font-bold"> Tel No. :</span>
                                {{ $customer->phone }}
                            </td>
                            <td class="p-1">
                                <span class="font-bold"> Sales Person:</span>
                                {{ $user->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overflow-auto rounded-lg">
            <table class="w-full border-separate border-spacing-x-1 text-center">
                <thead>
                    <tr>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Item</th>
                        <th class="whitespace-normal bg-slate-300 p-2">Description</th>

                        <th class="whitespace-normal w-20 bg-slate-300 p-2">Size</th>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Area m²</th>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Pack Qty </th>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Amount</th>
                    </tr>
                </thead>
                @foreach($invoice->items()->get() as $item)
                <tbody>
                    <tr>
                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ $item->getMeta('title')?->value }}
                        </td>
                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ Str::limit($item->getMeta('description')?->value, 50) }}
                        </td>
                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ ($item->getMeta('Length')?->value . ' x ' . $item->getMeta('Width')?->value) ?? 'N/A'}}
                        </td>
                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ ($item->getMeta('Length')?->value * $item->getMeta('Width')?->value) ?? 'N/A' }}
                        </td>
                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ evaluate_formular($item->getMeta('packs_count')?->value ,'InvoiceItemMeta', $item->id, $item->getMeta('packs_count')?->modifier ) ?? 'N/A'}}
                        </td>

                        <td class="bg-purple-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            {{ $item->item_total ?? 'N/A' }}
                        </td>

                    </tr>



                </tbody>
                @endforeach
            </table>
        </div>

        <table class="w-full border-separate border-spacing-x-1 text-center my-10">
            @foreach($invoice->pricings as $price)
            @if($price->name == 'formular')
            @php $totalDisplayed = false; @endphp


            @else
            <!-- Other pricing attributes-->
            <tbody>
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        {{ ucfirst($price->name) }} £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        {{ number_format($price->value, 2) }}
                    </td>
                </tr>


                @endif

                @endforeach

                <!-- Total pricing -->
                @if (!$totalDisplayed)
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        Total £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        {{ number_format($invoice->getTotalAttribute(), 2) }}
                    </td>
                </tr>
                @php $totalDisplayed = true; @endphp
                @endif
            </tbody>
        </table>

        <div class="footer py-4 flex flex-col-reverse items-center justify-between md:flex-row md:justify-between">
            <div class="address text-xs text-slate-500 w-full text-center md:text-left md:w-auto">
                <h6 class="font-bold"> {{$company->company_name }}</h6>
                <p>{{$company->company_address}}.</p>
                <p>
                    Company Registration No. {{$company->company_number}}, VAT Registration No.
                    {{$company->vat_number}}.
                </p>
            </div>
            <span class="text-primary font-bold text-2xl mb-5 md:mb-0">CUSTOMER</span>
        </div>

        <div class="container w-full bg-white p-3 md:p-6 md:max-w-4xl font-semibold">
            <h2 class="text-center font-bold">Terms and conditions</h2>

            <ol class=" text-xs font-semibold" style="line-height: 28px;">

                <p>{!! $company->terms_conditions !!}</p>


            </ol>
            <br>

            <div class="flex justify-center">
                <a href="{{ route('voyager.invoices.pdf', $invoice->id) }}" class="flex items-center bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Print Invoice
                </a>


            </div>

        </div>
    </div>
</body>

</html>