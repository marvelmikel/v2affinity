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
    $companyId = auth()->user()->company_id;
    $dataTable->addScope(new class($companyId) implements \Yajra\DataTables\Contracts\DataTableScope {
        private $companyId;

        public function __construct($companyId)
        {
            $this->companyId = $companyId;
        }

        public function apply($query)
        {
            return $query->where('company_id', $this->companyId);
        }
    });

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
            'type' => $request->type,
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

        // dd($meta);

        foreach ($meta as $me) {
            if($product_meta = ProductMeta::where('identifier', $me[2])->first()){
                $product_meta->update([ 'title' => $me[0], 'value' => $me[1], 'visibility' => $me[3]]);
            }
        } 


        
        $product = Product::find($id);

        if($product->type == 'carpet'){
            $length = $product->getMeta('length');
            $width = $product->getMeta('width');
           
       }


        $product->update([
            'title' => $product->getMeta('title')->value,
            'description' => $product->getMeta('description')->value,
        ]);

        return redirect()->route('voyager.products.index');
 
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
            'name' =>  strtolower($request->name),
            'title' => $request->title,
            'value' => $request->value,
            'visibility' => $request->type == 'formular' ? 'readonly' : $request->visibility,
            'type' => $request->type
        ]);
        return redirect()->back()->with([
            'message' =>' Product attribut added successfully'
        ]);   
            
    }

    /**
     * 
     *
     * @param  int  $id
     * @return 
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        $product->delete();
    
        // Redirect back to the initial page
        return redirect()->route('voyager.products.index')->with('success', 'Product deleted successfully');
    }


    /**
     * 
     *
     * @param  int  $id
     * @return 
     */
    public function deleteMeta($id)
    {
        $meta = ProductMeta::findOrFail($id);
    
        $meta->delete();
    
        // Redirect back to the initial page
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
    



}
