<?php

namespace App\Http\Controllers;

use App\DataTables\InvoicesDataTable;
use App\Models\Customer;
use App\Models\Company;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceItemMeta;
use App\Models\InvoicePricing;
use App\Models\Product;
use App\Models\Store;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoicesDataTable $dataTable)
    {

        return $dataTable->render('voyager::invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $store = auth()->user()->store; // Assuming the store relationship is defined on the User model

        $invoice = new Invoice(); // Create a new instance of the Invoice model

        return view('voyager::invoices.create', compact('store', 'invoice'));
    }



    public function generatePdf(Request $request, Invoice $invoice, Store $storeModel)
    {
        $store = $storeModel::find($invoice->store_id);

        if (!$store) {
            throw new \Exception(404, 'Store not found');
            // Or use abort(404, 'Store not found') to return a 404 error response

            // Alternatively, you can display a flash message and redirect back:
            return redirect()->back()->with('error', 'Store not found');
        }


        // Fetch the company data here
        $company = Company::find($invoice->company_id);

        // Fetch the store_logo URL here
    $storeLogoUrl = $store->store_logo;

        $pdf = PDF::loadView('voyager::invoices.pdf', [
            'invoice' => $invoice,
            'customer' => $invoice->customer,
            'user' => auth()->user(),
            'count' => $invoice->items->count(),
            'store' => $store,
            'company' => $company,
            'storeLogoUrl' => $storeLogoUrl,
        ]);

        return $pdf->stream('invoice.pdf');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'sometimes',
            'store_id' => 'required',
            'customer_email' => 'required',
            'customer_name' => 'required',
            'customer_address_line_1' => 'required',
            'customer_address_line_2' => 'sometimes',
            'customer_phone_number' => 'required',
            'customer_address_city' => 'sometimes',
            'customer_address_country' => 'sometimes',
            'customer_address_postcode' => 'sometimes',
            'invoice_number' => 'nullable', // Add validation rule for invoice_number field
        ]);

        // Check if the user has a company_id
        if (!auth()->user()->company_id) {
            return redirect()->back()->with([
                'message' => 'You do not have a company, please create a company first.',
                'alert-type' => 'warning',
            ]);
        }

        // Check if the user has a store_id
        if (!auth()->user()->store_id) {
            return redirect()->back()->with([
                'message' => 'Store not assigned. Please contact your administrator.',
                'alert-type' => 'error',
            ]);
        }

        $store = auth()->user()->store;
        $invoice = new Invoice(); // Create a new instance of the Invoice model



        // Generate a unique two-digit random number
        $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);

        // Extract the first character of each word in the store name and convert to uppercase
        $storeNameParts = explode(' ', $store->store_name);
        $storeShortCode = '';
        foreach ($storeNameParts as $part) {
            $storeShortCode .= strtoupper(substr($part, 0, 1));
        }


        // Generate the invoice number in the format "INV-{store_name}-{random number}"
        $invoiceNumber = 'INV-' . $storeShortCode . '-' . $randomNumber;




        // Check if invoice_number is set in the request and not empty
        if ($request->filled('invoice_number')) {
            $invoiceNumber = $request->invoice_number;
        }

        // Add the user_id, company_id, and invoice_number to the request data
        $requestData = $request->all();
        $requestData['user_id'] = auth()->user()->id;
        $requestData['company_id'] = auth()->user()->company_id;
        $requestData['invoice_number'] = $invoiceNumber;

        // Create the invoice with user_id, company_id, and invoice_number
        $invoice = Invoice::create($requestData);

        $customer = Customer::updateOrCreate(['email' => $request->customer_email], [
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id,
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'address_line_1' => $request->customer_address_line_1,
            'address_line_2' => $request->customer_address_line_2,
            'phone' => $request->customer_phone_number,
            'address_city' => $request->customer_address_city,
            'address_country' => $request->customer_address_country,
            'address_postcode' => $request->customer_address_postcode,
            'store_id' => $request->store_id,
        ]);

        $invoice->update(['customer_id' => $customer->id]);

        // Add first item here
        // $this->addItem($invoice->id);
        // $this->addOptions($invoice->id);
        $this->addPricing($invoice->id);

        return redirect()->route('voyager.invoices.edit', $invoice->id);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */

    public function show($id)
    {
        $invoice = Invoice::find($id);

        // Fetch related data
        $customer = Customer::find($invoice->customer_id);
        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        $pricing = InvoicePricing::where('invoice_id', $invoice->id)->first();
        $store = Store::find($invoice->store_id);
        $users_id = $invoice->user_id;
        $user = User::find($users_id);
        $company = Company::find($invoice->company_id);

        return view('voyager::invoices.show', compact('invoice', 'customer', 'items', 'pricing', 'store', 'user', 'company'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit(Request $request,  $id)
    {
        $companyId = auth()->user()->company_id;
        $invoice = Invoice::find($id)->load('items', 'pricings');
        if ($invoice->items->count() < 1) {
            // $this->addItem($request, $invoice->id);
        }

        // evaluate_formular("ceil(area32338/unitarea32337)+(area32338/unitarea32337*allowance32336/100)", 'InvoiceItemMeta', 13 );

        // dd(evaluate_formular("P11*(2*P12)", 'InvoicePricing' ));
        // dd(evaluate_formular("unitprice214*packscount221", 'InvoiceItemMeta', 1, '2dp' ));


        $this->addPricing($invoice->id);

        $formular = $invoice->getPricing('formular')->value;

        // cal this method when opening invoice or editing invoice
        $invoice->calculateSubtotal();

        $total_amount = 0;

//        $total_amount = evaluate_formular($formular, 'InvoicePricing');

        $products  = Product::where('company_id', $companyId)->get();

        // dd($invoiceSubtotal);
        return view('voyager::invoices.edit', compact('invoice', 'total_amount', 'products', 'companyId'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request,  $id)
    {
        $invoice = Invoice::find($id);
        $customer = $invoice->customer;

        $customer->updateOrCreate(['email' => $request->customer_email], [
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id,
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'address_line_1' => $request->customer_address_line_1,
            'address_line_2' => $request->customer_address_line_2,
            'phone' => $request->customer_phone_number,
            'address_city' => $request->customer_address_city,
            'address_country' => $request->customer_address_country,
            'address_postcode' => $request->customer_address_postcode,
            'store_id' => $request->store_id,
        ]);

        $invoice->update($request->all());
        return redirect()->back()->with([
            'message' => ' Invoice updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        // Redirect back to the initial page
        return redirect()->route('voyager.invoices.index')->with('success', 'Invoice deleted successfully');
    }


    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function addItem(Request $request, $id)
    {
        $productids = $request->validate([
            'product_ids' => 'required',
        ]);
        $invoice = Invoice::find($id);

        foreach ($productids as $productid) {
            if ($product = Product::find($productid)->first()) {

                    // Remove the condition to skip existing items
                // if (InvoiceItem::where('invoice_id', $invoice->id)->where('product_id', $product->id)->exists()) {
                //     continue;
                // }

                if ($meta = $product->meta->toArray()) {
                    $item = InvoiceItem::create(['invoice_id' => $invoice->id, 'product_id' => $product->id]);
                    foreach ($meta as $met) {
                        $item->meta()->create($met); // create all meta first
                    }
                }
            }
        }

        return redirect()->route('voyager.invoices.edit', $invoice->id);
    }



    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function saveItem(Request $request, $invoiceId, $itemId)
    {
        $invoiceItem = InvoiceItem::find($itemId);
        $invoice = Invoice::find($invoiceId);



        $invoiceItem->update($request->except(['_method', '_token']));

         $meta = $request->all();


        foreach ($meta as $me) {
            if (isset($me[1])) { // Check if array key 1 is set
                $value = !empty($me[0]) ? $me[0] : 0; // Set default value of 0 if $me[0] is empty
                InvoiceItemMeta::where('identifier', $me[1])->where('invoice_item_id', $invoiceItem->id)->first()->update(['value' => $me[0]]);
            }
        }



        if($meta = $request->add_allowance){
            if($meta[0] == 'on'){
                 if($invoiceItem->getMeta('allowance') && $invoiceItem->getMeta('add_allowance')){
                    $allowance = $invoiceItem->getMeta('allowance');
                    $defaultAllowance = $invoiceItem->getMeta('default_allowance');
                    $addAllowance = $invoiceItem->getMeta('add_allowance');
                    $allowance->update(['value' => $defaultAllowance->value]);
                    $addAllowance->update(['value' => 'yes']);
                 }
            }else{
             if($invoiceItem->getMeta('allowance') && $invoiceItem->getMeta('add_allowance') ){
                $allowance = $invoiceItem->getMeta('allowance');
                $addAllowance = $invoiceItem->getMeta('add_allowance');
                $allowance->update(['value' => 0]);
                $addAllowance->update(['value' => 'no']);
             }
            }
         }





        // Recalculate invoice subtotal here whenever an item is saved
        $invoice->calculateSubtotal();

        return redirect()->back()->with([
            'message' => 'Invoice item saved successfully'
        ]);
    }

    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function deleteItem(Request $request, $invoiceId,  $itemId)
    {
        $invoiceItem = InvoiceItem::find($itemId);
        $invoice = Invoice::find($invoiceId);

        $invoiceItem->delete();

        // recalculate invoice subtotal here whenever an item is deleted
        $invoice->calculateSubtotal();


        return redirect()->back()->with([
            'message' => ' Invoice item deleted successfully'
        ]);
    }


    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function savePricing(Request $request, $invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $meta = $request->except(['_method', '_token']);

        // dd($meta);

        // Initialize the subtotal value to zero
        $subtotal = 0;

        foreach ($meta as $key => $me) {
            $pricingItem = InvoicePricing::where('identifier', $me[2])->first();

            if ($pricingItem) {
                $pricingItem->update(['value' => $me[0], 'type' => $me[1]]);
            }
        }

        if ($invoice->getPricing('subtotal') &&  $invoice->getPricing('tax') && $invoice->getPricing('discount')) {


            $subtotalCol = $invoice->getPricing('subtotal');
            $taxCol = $invoice->getPricing('tax');
            $discountCol = $invoice->getPricing('discount');

            $subtotal = $subtotalCol->identifier;

            if ($taxCol->type == 'percentage') {
                $tax = "($subtotal*(0.01*$taxCol->identifier))";
            } else {
                $tax = $taxCol->identifier;
            }

            $formular = "($subtotal+$tax)";

            //check pricing that should be added to formular -

            foreach ($meta as $met) {
               if( isset($met[3]) && $met[3]  != null){
                $formular =  $formular  .$met[3] . '(' . $met[2] . ')';
                //dd($formular);
               }
            }
            $invoice->pricings()->updateOrCreate(
                [
                    'name' => 'formular'
                ],
                [
                    'name' => 'formular',
                    'value' => "$formular"
                ]
            );
        }


        return redirect()->back()->with([
            'message' => 'Invoice pricing saved successfully'
        ]);
    }









    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function addItemMetaColumn(Request $request, $invoiceId)
    {
        $invoiceItem = InvoiceItem::find($request->item_id);
        $invoiceItem->meta()->create([
            'name' =>  strtolower(str_replace(' ', '_', $request->title)),
            'title' => $request->title,
            'value' => $request->value
        ]);
        return redirect()->back();
    }

    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function addPricingColumn(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->pricings()->create([
            'name' => $request->name,
            'value' => $request->value,
            'operation' => $request->operation,
            'visibility' => $request->visibility
        ]);
        return redirect()->back();
    }






    /**
     *
     *
     * @param  int  $id
     * @return
     */
    public function addPricing($id)
    {
        if (!$invoice = Invoice::find($id)) {
            return;
        }

        $meta = [
            ['name' => 'subtotal', 'value' => 0, 'type' => 'value'],
            ['name' => 'tax', 'value' => 20, 'type' => 'percentage'], // value, percentage, formular
            ['name' => 'discount', 'value' => 0, 'type' => 'percentage'], // value, percentage, formula
        ];

        foreach ($meta as $met) {
            if (!$invoice->getPricing($met['name'])) {
                $invoice->pricings()->create($met);
            }
        }


        //add def formular here
        if ($invoice->getPricing('subtotal') &&  $invoice->getPricing('tax') && $invoice->getPricing('discount')) {
            $subtotalCol = $invoice->getPricing('subtotal');
            $taxCol = $invoice->getPricing('tax');
            $discountCol = $invoice->getPricing('discount');

            $subtotal = $subtotalCol->identifier;

            if ($taxCol->type == 'percentage') {
                $tax = "($subtotal*(0.01*$taxCol->identifier))";
            } else {
                $tax = $taxCol->identifier;
            }

            if ($discountCol->type == 'percentage') {
                $discount = "($subtotal+$tax)*(0.01*$discountCol->identifier)";
            } else {
                $discount = $discountCol->identifier;
            }

            if (!$invoice->getPricing('formular')) {
                $invoice->pricings()->create([
                    'name' => 'formular',
                    'value' => "($subtotal+$tax)"
                ]);
            }
        }
        return redirect()->route('voyager.invoices.edit', $invoice->id);
    }


}
