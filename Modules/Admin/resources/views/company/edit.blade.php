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
 List of  Companies
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="" method="POST" enctype="multipart/form-data">
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
                                <label for="name">Company Name</label>
                                <input class="form-control" type="text" value="" name="name" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Company Email</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="name">Company Contact</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>

                        </div>

                        <div class="form-group row">
                        <div class="col-md-4">
                                <label for="name">Company Address</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Company Number</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Vat Number</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                            <label for="name">Store Logo</label>
                              
                                <img src="" alt="Store Logo" style="width: 50%; height: auto;">
                            </div>

                            <input type="file" value="" name="store_logo" id="">
                        </div>
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>

              <!-- Subcription History -->
          <header class="flex justify-between items-center mb-6 " style="border: 1px solid #3330;">
                <div>
                    <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">  <i class="voyager-paypal"></i> Subscription History</h2>
                    <p class="font-medium lg:text-lg text-slate-500">Please find your subscription history below.</p>
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
                                            <th>Trial Period</th>
                                            <th>Billing Cycle</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subscriptionTableBody">
                                   
                                        <tr role="row">
                                            <td>i</td>
                                            <td>dndjhd</td>
                                            <td>dnd</td>
                                            <td>dndnd</td>
                                            <td>dsjhdhd</td>
                                            <td>dbdbd</td>
                                            <td>dndndndndnd</td>
                                        </tr>
                                     
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection