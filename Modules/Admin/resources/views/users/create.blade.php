@extends('voyager::master')

@section('page_title', __('Create User'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title">
    <i class="voyager-basket"></i>
    Create New User for {{ Auth::user()->company->company_name }}
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="{{ route('voyager.users.store')}}" method="POST"
                    enctype="multipart/form-data">

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
                            <div class="col-md-4 form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="text" name="email" id="email" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="store_id">Select Store </label>
                                <select class="form-control" name="store_id" id="store_id" required>
                                    <option value="">Select a Store</option>
                                    @foreach(\App\Models\Store::where('company_id', $company_id)->get() as $store)
                                    <option value="{{ $store->id }}" @if(old('store_id')==$store->id) selected
                                        @endif>{{ $store->store_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 form-group">
                                <label for="role_id">User Role </label>
                                <select class="form-control" name="role_id" id="role_id" required>
    <option value="">Select a User Role</option>
    @foreach(\Modules\Admin\Models\Role::where('name', '!=', 'admin')->where('id', '>', Auth::user()->role_id)->get() as $role)
        <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif>{{ $role->name }}</option>
    @endforeach
</select>

                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input class="form-control" type="password" name="cpassword" id="cpassword" required>
                            </div>

                        </div>

                    </div><!-- panel-body -->




                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>

</script>
@stop