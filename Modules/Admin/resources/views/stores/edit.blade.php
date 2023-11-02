@extends('voyager::master')

@section('page_title', __('Build Store'))

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
    <i class="icon voyager-shop"></i>
    Store Information
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="" method="POST">



                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Store Name</label>
                                <input class="form-control" type="text" value="" name="title" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Email</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Store Phone</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Address City</label>
                                <input type="address" class="form-control" type="text" value="" name="due_at" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Address Country</label>
                                <input type="text" class="form-control" type="text" value="" name="customer_email"
                                    id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Company Registration No.</label>
                                <input type="text" class="form-control" value="" name="customer_email" id="">
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Store Logo</label>
                                <input type="text" class="form-control" type="text" value=""
                                    name="customer_address_line_2" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="name">VAT Registration No.</label>
                                <input type="text" class="form-control" value="" name="customer_address_country" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Next Invoice Number</label>
                                <input type="number" class="form-control" value="" name="customer_address_country"
                                    id="">
                            </div>


                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Store Address Postcode</label>
                                <input type="text" class="form-control" type="text" value=""
                                    name="customer_address_city" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Address Line 1</label>
                                <input type="text" class="form-control" type="text" value=""
                                    name="customer_address_country" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Store Address Line 2</label>
                                <input type="text" class="form-control" type="text" value=""
                                    name="customer_address_postcode" id="">
                            </div>
                        </div>

                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Update Store</button>
                    </div>
                </form>

            </div>

            <br>
            <br>

            <!-- Store Employees -->
            <div class="card">
                <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                    <h3><i class="voyager-people"></i> {{ __('Store Employees') }}</h3>
                </div>
                <div class="clear"></div>
                <br>
                <div style="max-height: 500px; overflow-y: auto;">

                <table class="table " style="width:100%; margin: 40px 0;">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action=" ">

                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>

                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            <tr>
                                <td><input disabled readonly class="form-control" type="text" name="" value="test"></td>

                                <td><input readonly class="form-control" type="text" name="" value="test"></td>

                                <td colspan="3">
                                    <a href="#" data-toggle="modal" data-target="#add_item_column_modal"
                                        class="btn btn-secondary btn-xs add-pricing-column-btn"
                                        style="text-decoration: none;">
                                        <i class="voyager-eye"></i>View User Info
                                    </a>

                                </td>

                            </tr>
                            
                            

                        </form>
                    </tbody>
                </table>
                </div>
            </div>

        </div>



        <!-- store Email Settings -->
        <div class="col-md-6 ">
            <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
                <h3><i class="voyager-mail"></i> {{ __('Store Email Settings') }}</h3>
                <!-- <div>
                    <a href="" class="btn btn-primary btn-xs"><i class="voyager-plus"></i>Add New Item</a>
                </div> -->
            </div>
            <div class="clear"></div>
            <br>
            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="" method="POST">



                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Host</label>
                                <input class="form-control" type="text" value="" name="title" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Port</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Username</label>
                                <input class="form-control" type="text" value="" name="description" id="">
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Password</label>
                                <input type="address" class="form-control" type="text" value="" name="due_at" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">From Address</label>
                                <input type="text" class="form-control" type="text" value="" name="customer_email"
                                    id="">
                            </div>
                        </div>

                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Save Store Email Settings</button>
                    </div>
                </form>

            </div>
        </div><!-- .row -->
    </div>


    <!-- view employee info modal -->
    <div class="modal modal-info fade" tabindex="-1" id="add_item_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i>Employee Information</h4>
                </div>
                <form action="" method="post">
                    @csrf()
                    <div class="modal-body" style="overflow:scroll">


                        <div>
                            <label style="color:black; font-style:bolder;" for="">Name </label>
                            <input name="name" type="text" class="form-control" value="mike"></input>
                        </div>

                        <div style="margin: 10px 0;">
                            <label style="color:black; font-style:bolder;" for=""> Email Address </label>
                            <input name="" type="text" class="form-control" value="mike"></input>
                        </div>

                        <!-- <input type="hidden" name="item_id" class="form-control"></input> -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline mx-3 pull-right"
                            data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-danger pull-left" "><i class="voyager-trash"></i>{{ __('voyager::generic.delete') }}</button>
                    </div> 
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>
@stop
@section('javascript')
    <!-- <script type=" text/javascript">
                            $(document).ready(function () {
                            $('.add-column-btn').click(function (e) {
                            e.preventDefault();
                            let invoiceitemid = $(this).data('invoiceitemid')
                            console.log(invoiceitemid)

                            $('input[name=" item_id"]').val(invoiceitemid)
                            $('#add_item_column_modal').modal('show');
                            })
                            $('.add-pricing-column-btn').click(function (e) {
                            e.preventDefault();
                            let invoiceid = $(this).data('invoiceid')

                            console.log(invoiceid)
                            $('input[name="invoice_id"]').val(invoiceid)

                            $('#add_pricing_column_modal').modal('show');
                            })
                            })
                            $(document).ready(function () {
                            $('#multiple-checkboxes').multiselect({
                            includeSelectAllOption: true,
                            });
                            });
                            </script> -->

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer>
                            </script>
                            <script
                                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
                            </script>
                            <link rel="stylesheet"
                                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
                            @endsection