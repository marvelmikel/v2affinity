@extends('voyager::master')

@section('page_title', __('Products'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('Products') }}</h3>
                <div style="display:flex;">
                @can('add', app(\App\Models\Product::class))
                    <a href="#" style="margin-right:2px"
                        class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1 add-product-btn">
                        <i class="voyager-plus"></i>Add New</a>
                        @endcan
                </div>
            </div>
            <div class="clear"></div>
            <div class="card">

                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>



            <!-- Add  product  modal -->
            <div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="{{ __('voyager::generic.close') }}"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-data"></i> Add New Product</h4>
                        </div>
                        <form action="{{ route('voyager.products.store') }}" method="post">
                            @csrf()
                            <div class="modal-body" style="overflow:scroll">


                                <div>
                                    <label for=""> Title </label>
                                    <input name="title" type="text" class="form-control"></input>
                                </div>

                                <div>
                                    <label for=""> Description </label>
                                    <input name="description" type="text" class="form-control"></input>
                                </div>


                                <div style="margin: 10px 0;">
                                    <label for="">Type </label>
                                    <select class="form-control" name="type" id="">
                                        <option value="carpet">Carpets & Roll Items</option>
                                        <option value="tile">Pack Items</option>
                                        <option value="rollend">Roll End</option>
                                        <option value="underlay">Underlay</option>
                                        <option value="others">Other Stocks</option>

                                    </select>
                                </div>

                                <div style="margin: 10px 0;">
                                    <label for="">Availability </label>
                                    <select class="form-control" name="in_stock" id="">
                                        <option value="1">In Stock</option>
                                        <option value="0">Out of Stock</option>
                                    </select>
                                </div>

                                <input type="hidden" name="product_id" class="form-control"></input>

                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1 add-product-btn mx-3 pull-right" data-dismiss="modal">{{
                                    __('voyager::generic.close') }}</button>
                                <button type="submit" style="background-color: #C82090;" class="btn btn-primary  pull-left" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </div><!-- .row -->
    </div><!-- .col-md-12 -->
</div><!-- .page-content container-fluid -->
@stop

@section('javascript')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}



<script>

    $(document).ready(function(){
        $('.add-product-btn').click(function(e){
            e.preventDefault();
            let productid = $(this).data('productid')
            console.log(productid)
            $('input[name="product_id"]').val(productid)
            $('#add_pricing_column_modal').modal('show');
        })
    })
</script>
@endsection

