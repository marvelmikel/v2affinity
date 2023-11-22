@extends('voyager::master')

@section('page_title', __('Build Product'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@stop

@section('page_header')
<h1 class="page-title">
    <i class="voyager-news"></i>
    Build Product
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="card" style="padding: 50px;">
                <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                    <h3><i class="voyager-credit-card"></i> {{ __('Product Attributes') }}</h3>
                </div>
                <div class="clear"></div>
                <br>

                <table class="table " style="width:100%; margin: 40px 0;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Indentifier</th>
                            <th>Display</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('voyager.products.update', $product->id) }} " method="POST">
                        @method('patch')
                            @csrf
                            @foreach($product->meta as $meta)
                            @if($meta->name != 'formular' && $meta->name != 'length' && $meta->name != 'width' && $meta->value != 0)
                            <tr>
                                <td><input class="form-control" type="text" name="{{ $meta->name }}[]" value="{{ $meta->title == 'length' ? 'Required Length(m)' : ($meta->title == 'width' ? 'Required Width(m)' : $meta->title) }}"></td>
                                <td><input class="form-control" type="text" name="{{ $meta->name }}[]" value="{{ $meta->value }}"></td>
                                <td><input readonly style="background-color: white;" class="form-control" type="text" name="{{ $meta->name }}[]" value="{{ $meta->identifier }}"></td>
                                <td>
                                    <select class="form-control" name="{{ $meta->name }}[]" id="">
                                        <option value="hidden" {{ $meta->visibility === 'hidden' ? 'selected' : '' }}>hidden</option>
                                        <option value="readonly" {{ $meta->visibility === 'readonly' ? 'selected' : '' }}>readonly</option>
                                        <option value="visible" {{ $meta->visibility === 'visible' ? 'selected' : '' }}>visible</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ route('product-meta.delete', $meta->id) }}" style="text-decoration: none;" class="btn btn-danger btn-xs">
                                        <i class="voyager-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach

                            <!-- formula here -->
                            <tr>
                                <td><input  readonly class="form-control" type="text" name="formular[]" value="formular"></td>
                                <td><input class="form-control" type="text" name="formular[]" value="{{ $product->getMeta('formular')->value }}"></td>
                                <td><input readonly style="background-color: white;" class="form-control" type="text" name="formular[]" value="{{ $product->getMeta('formular')->identifier }}"></td>
                                <td><input class="form-control" type="text" name="formular[]" value="{{ $product->getMeta('formular')->visibility }}"></td>

                            </tr>


                            <tr>
                                <td colspan="3"><a href="#add_pricing_column_modal" data-toggle="modal" data-productid="{{ $product->id  }}" class="btn btn-secondary btn-xs add-product-column-btn"><i class="voyager-plus"></i>Add Product Attribute </a> </td>
                            </tr>


                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-xs"><i class="voyager"></i>Save
                                        Product</button>
                                </td>
                            </tr>

                        </form>
                    </tbody>
                </table>
            </div>
        </div>


    </div>





    <!-- Add invocie product column modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add Product Attribute</h4>
                </div>
                <form action="{{ route('voyager.products.add-product-column', $product->id) }}" method="post">
                    @csrf()
                    <div class="modal-body" style="overflow:scroll">


                        <div>
                            <label for=""> Column Name </label>
                            <input name="name" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Title </label>
                            <input name="title" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Default Value </label>
                            <input name="value" type="text" class="form-control"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Visibility </label>
                            <select class="form-control" name="visibility" id="">
                                <option value="visible">Visible</option>
                                <option value="readonly">Readonly</option>
                                <option value="hidden">Hidden</option>
                            </select>
                        </div>

                        <div style="margin: 10px 0;">
                            <label for=""> Column Type </label>
                            <select class="form-control" name="type" id="">
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="formular">Formular</option>
                                <option value="hidden">Hidden</option>
                            </select>
                        </div>

                        <input type="hidden" name="product_id" class="form-control"></input>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{
                            __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    </div>
@stop

@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {
            
           
                
            $('.add-product-column-btn').click(function (e) { 
                e.preventDefault(); 
                let productid= $(this).data('productid')
                console.log(productid) 
                $('input[name="product_id" ]').val(productid) 
                // $('#add_pricing_column_modal').modal('show');
             }) 
        })
    </script>
@stop