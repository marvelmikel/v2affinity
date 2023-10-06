<?php

namespace App\Http\Controllers;

use App\DataTables\InvoicesDataTable;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
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
            'address_city' => $request->customer_address_city,
            'address_country' => $request->customer_address_country,
            'address_postcode' => $request->customer_address_postcode,
            'store_id' => $request->store_id,
        ]);

        $invoice->update(['customer_id' =>  $customer->id]);
        
        //
       return redirect()->route('voyager.invoices.edit', $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return 
     */
    public function edit(Request $request,  $id)
    {
        // dd($invoice);
        $invoice = Invoice::find($id)->load('items');
        if(!$invoice->items()->exists() ){

            $item = InvoiceItem::create(['invoice_id' => $invoice->id]);

            $meta = [
                [ 'name' => 'title', 'value' => ''],
                [ 'name' => 'description', 'value' => ''],
                [ 'name' => 'price', 'value' => 0],
                [ 'name' => 'quantity', 'value' => 0],
                [ 'name' => 'formular', 'value' => 'price*quantity'],
            ];
            foreach ($meta as $met ) {
                $item->meta()->create($met);
            }
            
        }

        
        return view('voyager::invoices.edit', compact('invoice'));
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
}
