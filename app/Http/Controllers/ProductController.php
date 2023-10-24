<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return 
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('voyager::products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return 
     */
    public function create()
    {
        return view('voyager::products.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return 
     */
    public function store(CreateProductRequest $request)
    {

        // actually create blank product then redirect to eedit - lol
        if(!auth()->user()->company_id){
            return redirect()->back()->with([
                'message' => 'You do not have a company, please create company first.',
                'alert-type' => 'warning'
            ]);
        }
        $product = Product::create([
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        
        return redirect()->route('voyager.products.edit', $product->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return 
     */
    public function edit(Request $request,  $id)
    {
        $product = Product::find($id);
        
        

        // $this->addPricing($invoice->id);
        
        $formular = $product->getMeta('formular')->value;

        // cal this method when opening invoice or editing invoice
        // $product->calculateSubtotal();

        $total_amount = evaluate_formular($formular, 'Product' );


        // dd($invoiceSubtotal);
        return view('voyager::products.edit', compact('product', 'total_amount'));


       
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
        // dd($request->except(['_method', '_token']));
        $meta= $request->except(['_method', '_token']);

        foreach ($meta as $me) {
            if($product_meta = ProductMeta::where('identifier', $me[1])->first()){
                $product_meta->update(['value' => $me[0]]);
            }
        } 
        
        $product = Product::find($id);
        $product->update([
            'title' => $product->getMeta('title')->value,
            'description' => $product->getMeta('description')->value,
        ]);

        return redirect()->back();   
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
     * 
     *
     * @param  int  $id
     * @return 
     */
    public function addProductColumn(Request $request, $id)
    {
        $product = Product::find($id);
        $product->meta()->create([
            'name' => $request->name,
            'value' => $request->value,
            'visibility' => $request->name,
            'type' => $request->value
        ]);
        return redirect()->back()->with([
            'message' =>' Product attribut added successfully'
        ]);   
            
    }


}
