@extends('voyager::master')

@section('page_title', __('Companies'))

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
    <i class="voyager-company"></i>
    Company
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    <!-- CSRF TOKEN -->
                    @csrf
                    @method('PUT')
 
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
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Company Name</label>
                                <input class="form-control" type="text" value="{{ $companyData['company_name'] }}" name="company_name" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Company Address</label>
                                <input class="form-control" type="text" value="{{ $companyData['company_address'] }}" name="company_address" id="">
                            </div>



                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Company Phone</label>
                                <input class="form-control" type="text" value="{{ $companyData['company_phone'] }}" name="company_phone" id="">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Company Email</label>
                                <input class="form-control" type="text" value="{{ $companyData['company_email'] }}" name="company_email" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Company Reg Number</label>
                                <input class="form-control" type="text" value="{{ $companyData['company_number'] }}" name="company_number" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700"> VAT Percentage (%)</label>
                                <input class="form-control" type="text" value="{{ $companyData['vat_percentage'] }}" name="vat_percentage" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Vat Number</label>
                                <input class="form-control" type="text" value="{{ $companyData['vat_number'] }}" name="vat_number" id="">
                            </div>



                        </div>




                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="terms_conditions" style="font-weight:bolder;">
                                    <h3 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Terms & Conditions</h3>
                                </label>
                                <input type="hidden" name="terms_conditions" id="terms_conditions" class="form-control richTextBox" style="font-size:20px;" value="{{ $companyData['terms_conditions'] }}">
                                <trix-editor input="terms_conditions" class="trix-content"></trix-editor>
                            </div>


                            <div class="col-md-4">
                                <label  for="name" class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Acive Status</label>
                                <select class="form-control" name="active" id="">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ $companyData['active'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $companyData['active'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                        </div>

                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>


                   


                </form>

            </div>

            <!-- invoice History -->
            <header class="flex justify-between items-center mb-6 " style="border: 1px solid #3330;">
                <div>
                    <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700"> <i class="voyager-documentation"></i> Invoice History</h2>
                    <p class="font-medium lg:text-lg text-slate-500">Invoice history below.</p>
                </div>
            </header>

            <div class="container-fluid" style="padding-left:0px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                               <table id="invoicehistory" class="table table-striped first" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Invoice Number</th>
                                            <th>Store Assigned</th>
                                            <th>Customer Name</th>
                                            <th>Created At</th>
                                            <th>Deleted At</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End invoice History -->

            

          




            <!-- Subcription History -->
            <header class="flex justify-between items-center mb-6 " style="border: 1px solid #3330;">
                <div>
                    <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700"> <i class="voyager-paypal"></i> Subscription History</h2>
                    <p class="font-medium lg:text-lg text-slate-500">Subscription history below.</p>
                </div>
            </header>

            <div class="container-fluid" style="padding-left:0px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Subscription ID</th>
                                            <th>Plan Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subscriptionTableBody">
                                        @foreach ($subscriptionHistory as $subscription)
                                        <tr role="row">
                                            <td>{{ $subscription->id}}</td>
                                            <td>{{$plan->name ?? 'no plan' }} <br> {{ $plan->description ?? 'no plan' }} </td>
                                            <td>£ {{$plan->price ?? '' }}</td>
                                            <td>{{ $subscription->status  ?? '' }}</td>
                                            <td>{{ $subscription->created_at  ?? '' }}</td>
                                            <td>
                                                <a href='' style='margin-right:2px' class='btn m- btn-primary btn-xs'><i class='voyager-eye'></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Subcription History -->

        </div>


    </div>
</div>
@stop
@section('javascript')


 <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#invoicehistory').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.company.invoice-history', $company->id) }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'store.store_name',
                        name: 'store.store_name'
                    },
                    {
                        data: 'customer.name',
                        name: 'customer.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });



        });
    </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection