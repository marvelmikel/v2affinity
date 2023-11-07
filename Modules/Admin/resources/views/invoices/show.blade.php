<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Affinity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Quicksand:wght@700&display=swap"
        rel="stylesheet" />
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
                    Affinity
                </div>
                <div class="address text-xs">
                    <h6 class="font-bold">STORE: {{ $store->store_name }}</h6>
                    <p>{{ $store->address_line_1}}, {{ $store->address_line_2}}, {{ $store->address_city}}
                        {{ $store->address_postcode}}.</p>
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
                                <span class="text-lg">{{ $store->next_invoice_number }}</span>
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
                        <th class="whitespace-normal w-20 bg-slate-300 p-2">Quantity</th>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Area</th>
                        <th class="whitespace-normal w-30 bg-slate-300 p-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Computer
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Good
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            x
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            5
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            N/A
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black"></td>
                    </tr>
                    <tr>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Computer
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Good
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            x
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            5
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            N/A
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black"></td>
                    </tr>
                    <tr>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Computer
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Good
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            x
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            5
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            N/A
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black"></td>
                    </tr>
                    <tr>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Computer
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            Good
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            x
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            5
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black">
                            N/A
                        </td>
                        <td class="bg-yellow-100 p-2 text-sm whitespace-normal border-b-2 border-black"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="w-full border-separate border-spacing-x-1 text-center my-10">
            <tbody>
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        Subtotal £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        0.00
                    </td>
                </tr>
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        Tax £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        0.00
                    </td>
                </tr>
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        Discount £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        0.00
                    </td>
                </tr>
                <tr>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap font-bold text-right">
                        Total £:
                    </td>
                    <td class="border-b-4 border-white p-1 text-sm whitespace-nowrap bg-slate-300">
                        0.00
                    </td>
                </tr>

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

            <ol
                class="list-inside list-decimal text-xs text-justify font-semibold p-2 md:p-8 md:text-left md:columns-2 gap-5">
                <li class="mt-3 space-y-2">
                    Interpretation
                    <p>
                        In these conditions and the invoice overeat, Customer means the
                        person or persons purchasing the goods as detailed on the invoice
                        overleaf. The Goods means the goods described on the invoice
                        Contract means the contract for the sate by the Company to the
                        Customer of the Goods constituted by these terms and including the
                        Invoice. The Company means
                    </p>
                    <p>
                        CHANCE PRIDE LTD T/A UNITED CARPETS WOODFLOOR AND BEDS 96-98
                        BOOTHFERRY ROAD, HULL, H04 6ER
                    </p>
                    <p>
                        The headings are for convenience only and do not affect
                        interpretation
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Legal Title
                    <p>
                        The Goods shall remain in the property of the Company until any
                        mones whatsoever which are owing to the Company by the Customer
                        have been paid. The Company reserves the right for its agents,
                        servants, employees to enter the premises of the Customer and
                        repossess the Goods, in the event of non-payment of the
                        outstanding balance
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Basis of the Sale
                    <p>
                        The Goods are sold by the Company on the terms contained in the
                        Sale of Goods act 1979, and/or the Consumer Rights Act 2015,
                        except as expressively varied by the invoice and/or by these
                        terms. No change may be made to the Contract unless agreed in
                        writing by the Company
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Orders and Specications
                    <p>
                        The Company may make any changes in the specification of the goods
                        which are required to conform with relevant safety or other
                        statutory requirements or which do not materialy affect their
                        quality of performanon.
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Where goods are ondered and leave the store
                    <p>
                        The Company is not lable for a refund but may offer a credit note
                        after any cancellation charges have been applied.
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Cancellations
                    <p>
                        If any Contract is cancelled by the Customer prior to delivery the
                        Customer will be able to pay the Company 20% (special order
                        Contracts 30%) of the price of the goods to cover expenses
                        incurred and this wit be deducted from any deposit or advance
                        payment paid by the Customer. The Contract cannot be cancelled by
                        the Customer after delivery. The Company may cancel the Contract
                        at any time before it confies the Customer that the Goods are
                        ready for delivery/collection if it is unable to fuil the Contract
                        due to any cause beyond its control in this event the Company's
                        only liability is to refund any deposit or advance paid by the
                        Customer
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Prios of Goods and Terms of Payment
                    <p>
                        The price of goods provided by the Company and the delivery charge
                        (if any) is set out on the Invoice Full payment of those amounts
                        is due upon delivery or collection of the goods as the case may
                        be. Your discount entitlement is set out below
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Discount Entitlement
                    <p>
                        We will reduce the price of the goods by way of a discount for you
                        as shown on the invoice
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Fitting Service
                    <ul class="list-inside list-none space-y-3">
                        <li class="space-y-2">
                            (a) We do not provide carpet fitting services and this forms no
                            part of any contract between you and ustis for you to engage a
                            carpet for and any fitting service is provided to you wholly and
                            exclusively underpursuant to such an engagement which is a
                            contract between you and a fitter.
                        </li>
                        <li class="space-y-2">
                            (b) If you wish to arrange for your floorcovering to be fitted,
                            you appoint us as your agent to arrange the fitting of your
                            product. There is an agency fter referal administration fee
                            payable for us to act as your agent based on them sold.

                            <p>
                                If free fiting is includest, we will pay the fitter on your
                                behalf unless the terms of any free fitting are different, in
                                which case those terms will apply instead
                            </p>
                            <p>
                                The agent fee includes: introduction to a flooring fitting
                                specialist and arranging the installation of your purchase
                                under a separate contractual agreement between you and them.
                                It also includes monitoring fitting standards, arranging a
                                pre-cut service to aid an efficient and speedy at home
                                installation and on the rare occasion of a complaint being
                                raised regarding the fitting, United Carpets will manage the
                                complaint between yourself and the fitting partner
                            </p>
                            <p>
                                We retain fut responsibility for the products and services we
                                supply, and the fitter is responsible for the standard and
                                quality of, and any liability ansing from, delivery and/or
                                instalation/ Payment for the fing is made directly to the
                                timer on the day your order is fitted.
                            </p>
                            <p>
                                The charges quoted are for the products shown on the order
                                only. If you require additional fitting services these can be
                                agreed with the fitter in advance and quoted for separately.
                            </p>
                            <p>
                                These addional terms and conditions are in conjunction with
                                the terms and conditions set out on your invoice
                            </p>
                        </li>
                        <li class="space-y-2">
                            (c) To make the introduction of is fitter requested you instruct
                            us to communicate your personal details, including a copy of the
                            invoice overleaf, to the fitter(s) to be introduced
                        </li>
                        <li class="space-y-2">
                            (d) We have agreed with the fibers we introduce the basis for
                            estimating the price of the fitting service and stars and other
                            surcharges (if any). The fiting estimate shown on the invoice
                            overeat for the fitting service is made accordingly as are the
                            stairs and other surcharges (if any) shown on the invoice. It
                            remains your responsibility to pay the finer in accordance with
                            your contract with him.
                        </li>
                        <li class="space-y-2">
                            (e) The fing estimate and stars and other surcharges (if any)
                            shown on the invoice are not held out by us or made by us for
                            and on behalf of the litter and are made in reliance on the
                            information you have provided to us, including in the "customer
                            service checkier on the invoice overeal Subject always to the
                            foregoing, the fitters we introduce have agreed with us that
                            they will after the fing service to you under the terms and
                            conditions set out below under "FITTING SERVICE TERMS AND
                            CONDITIONS. For the avoidance of doubt those terms and
                            conditions are not part of any contract between you and us but
                            may form part of a contract between you and the fitter. We do
                            not hold these terms and conditions out on behalf of the fitter
                            it is your responsibility to agree terms and conditions with the
                            filter which you consider to be satisfactory including as to
                            price and payment.
                        </li>
                        <li class="space-y-2">
                            (f) The fitter we introduce is considered by us to be properly
                            qualified to fit your floor covering However, we give no promise
                            or guarantee with respect to and accept no responsibility for
                            the quality of the fitting service. We accept no responsibilty
                            for any damage or lose you might suffer in connection with the
                            fitter's performance of his contract with you. If you are not
                            satisfied with the fitting service your only recourse is to the
                            fitter under your contract with him.
                        </li>
                    </ul>
                </li>
                <li class="mt-3 space-y-2">
                    General
                    <p>
                        Although the Company will always endeavour to meet all delivery or
                        collection agreements no liability will be accepted by the Company
                        for a claim of compensation should the agreed date be extended
                        from the original agreement made. No lability is accepted by the
                        Company in respect of the Good's supplied by the Company in
                        accordance with the Customer's own specification and/or
                        measurements. Nothing contained within these Terms and Conditions
                        of Sale does, nor will affect your statutory rights. All out pie
                        carpets, whatever their quality, method of construction or pile
                        content, may show a shading effect when in use (and in some cases
                        even without wear) though when and where it will occur cannot be
                        predicted Variously referred to as Water Marking, Pooling,
                        Tracking or Ple Pressure shading is characteristic of all textile
                        materials with a pile or nap, but the effect is especially
                        noticeable on plain velvet carpets or carpets with a high
                        proportion of oper ground in the pattem. Areas of shading are
                        inegular in shape and size and have a darker appearance then the
                        surrounding carpets when seen from one angle of the pile, which
                        may be permanent. The shading effect, which may be accentuated by
                        room lighting or certain areas of frequent use, does not affect
                        the quality of wearife of the carpet and is not a fault in
                        manufacture.. When carpets are selected from samples it is
                        occasionally found that variations occur in colour to the actual
                        carpet supplied. Every effort will, of course, be made to ensure
                        as exact a match as possible. but no guarantee of matching can be
                        given. The sizes as quoted for the width of carpet are
                        approximate. This can vary due to several factors and the
                        tolerance conforms with Brash Standards Institute No. 3855
                        allowing for a variation of +1.25% In the case of partial
                        completion of an order, which may occur for a variety of reasons,
                        the Company shall stil be entitled to payment proportional to the
                        amount of goods supplied
                    </p>
                </li>
                <li class="mt-3 space-y-2">
                    Cleaning
                    <p>
                        The Company recommends that carpets should be cleaned by
                        professionals. A dry-cleaning method only should be used when
                        cleaning woven carpets such as Wiltons and Axminsters as any other
                        method of cleaning may result in the carpet shrinking or
                        distorting.
                    </p>
                </li>
            </ol>
            <div class="flex justify-center">
                <a href="{{ route('voyager.invoices.pdf', $invoice->id) }}"
                    class="flex items-center bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Print Invoice
  </a>


            </div>

        </div>
    </div>
</body>

</html>