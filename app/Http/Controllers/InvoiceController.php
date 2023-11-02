<?php

namespace App\Http\Controllers;

use App\DataTables\InvoicesDataTable;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceItemMeta;
use App\Models\InvoicePricing;
use App\Models\Product;
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
        return view('voyager::invoices.create');
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
            'title' => 'required',
            'description' => 'required',
            'note' => 'sometimes',
            'due_at' => 'required',
            'store_id' => 'required',
            'customer_email' => 'required',
            'customer_name' => 'required',
            'customer_address_line_1' => 'required',
            'customer_address_line_2' => 'sometimes',
            'customer_phone_number' => 'required',
            'customer_address_city' => 'sometimes',
            'customer_address_country' => 'sometimes',
            'customer_address_postcode' => 'sometimes',
        ]);

        $invoiceData =
        $invoice = Invoice::create($request->all());

        $customer = Customer::updateOrCreate(['email' => $request->customer_email],[
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

        $invoice->update(['customer_id' =>  $customer->id]);


        // add first item here
        // $this->addItem($invoice->id);
        // $this->addOptions($invoice->id);
        $this->addPricing($invoice->id);

        //
       return redirect()->route('voyager.invoices.edit', $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */
    public function show($id)
    {
        return view('voyager::invoices.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit(Request $request,  $id)
    {
        $invoice = Invoice::find($id)->load('items', 'pricings');
        if( $invoice->items->count() < 1 ){
            // $this->addItem($request, $invoice->id);
        }

        $this->addPricing($invoice->id);

        $formular = $invoice->getPricing('formular')->value;

        // cal this method when opening invoice or editing invoice
        $invoice->calculateSubtotal();

        $total_amount = evaluate_formular($formular, 'InvoicePricing' );

        $products  = Product::all();

        // dd($invoiceSubtotal);
        return view('voyager::invoices.edit', compact('invoice', 'total_amount', 'products'));



    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        foreach($productids as $productid){
            if($product = Product::find($productid)->first() ){

                if(InvoiceItem::where('invoice_id', $invoice->id)->where('product_id', $product->id)->exists() ){
                    continue;
                }

                if($meta = $product->meta->toArray() ){
                    $item = InvoiceItem::create( ['invoice_id' => $invoice->id, 'product_id' => $product->id] );
                    foreach ($meta as $met ) {
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
    public function saveItem(Request $request, $invoiceId,  $itemId)
    {
        $invoiceItem = InvoiceItem::find($itemId);
        $invoice = Invoice::find($invoiceId);
        $meta= $request->all();
        foreach ($meta as $me) {
            InvoiceItemMeta::where('identifier', $me[1])->where('invoice_item_id', $invoiceItem->id )->first()->update(['value' => $me[0]]);
        }


        // recalculate invoice subtotal here whenever an item is saved
        $invoice->calculateSubtotal();


        return redirect()->back()->with([
            'message' =>' Invoice item saved successfully'
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
            'message' =>' Invoice item deleted successfully'
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
        $meta= $request->all();

        $meta= $request->except(['_method', '_token']);

        foreach ($meta as $me) {
            InvoicePricing::where('identifier', $me[1])->first()->update(['value' => $me[0]]);
        }

        return redirect()->back()->with([
            'message' =>' Invoice pricing saved successfully'
        ]);

    }

    public function generatePdf(Request $request, Invoice $invoice)
    {
        $pdf = PDF::loadView('voyager::invoices.pdf', [
            'invoice' => $invoice,
            'customer' => $invoice->customer,
            'user' => auth()->user(),
            'count' => $invoice->items->count(),
        ]);

        return $pdf->stream('invoice.pdf');
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
            'name' => $request->name,
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
    public function addPricing($id)
    {
        if(!$invoice = Invoice::find($id)){
            return;
        }

        $meta = [
            [ 'name' => 'subtotal', 'value' => 0],
            [ 'name' => 'tax', 'value' => 0],
            [ 'name' => 'discount', 'value' => 0],
        ];

        foreach ($meta as $met ) {
            if(!$invoice->getPricing($met['name'])){
                $invoice->pricings()->create($met);
            }

        }

        //add def formular here
        if($invoice->getPricing('subtotal') &&  $invoice->getPricing('tax') && $invoice->getPricing('discount') ){
            $subtotal = $invoice->getPricing('subtotal');
            $tax = $invoice->getPricing('tax');
            $discount = $invoice->getPricing('discount');

            $invoice->pricings()->updateOrCreate([
                'name' => 'formular',
                'value' => "$subtotal->identifier-$subtotal->identifier*$tax->identifier-$subtotal->identifier*$discount->identifier"],
                [
                    'name' => 'formular',
                    'value' => "$subtotal->identifier-$subtotal->identifier*$tax->identifier-$subtotal->identifier*$discount->identifier"
                ]);
        }
        return redirect()->route('voyager.invoices.edit', $invoice->id);
    }
    public function delete($id)
{
    $invoice = Invoice::findOrFail($id);

    $invoice->delete();

    // Redirect back to the initial page
    return redirect()->route('voyager.invoices.index')->with('success', 'Invoice deleted successfully');
}


}
