@extends('voyager::master')

@section('page_title', __('Employee'))

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
    <i class="voyager-people"></i>
   Employee Information
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
                                <label for="name">Name</label>
                                <input class="form-control" type="text" value="" name="name" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Email</label>
                                <input class="form-control" type="text" value="" name="email" id="">
                            </div>


                            <div class="col-md-4">
                                <label for="store_id">Select Store </label>
                                <select class="form-control" name="store_id" id="store_id" required>
                                    <option value="">Select a Store</option>
                                   
                                    <option value="">testing </option>
                                    <option value="">testing </option>
                                  
                                </select>

                            </div>

                        </div>

                        <div class="form-group row">
                        <div class="col-md-4">
                                <label for="store_id">User Role</label>
                                <select class="form-control" name="store_id" id="store_id" required>
                                    <option value="">Select a Store</option>
                                    <option value="">testing </option>
                                    <option value="">testing </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="name">Password</label>
                                <input type="text" class="form-control" type="text" value="" name="address_county" id="">
                            </div>
                        </div>
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>

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