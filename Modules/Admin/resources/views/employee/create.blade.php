@extends('voyager::master')

@section('page_title', __('Create User'))

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title">
    <i class="voyager-basket"></i>
    Add New Employee for {{ Auth::user()->company->company_name ?? '' }}
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form class="form-edit-add" role="form" action="{{ route('voyager.employee.store')}}" method="POST"
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
                                    @foreach(\Modules\Admin\Models\Role::where('name', '!=', 'admin')->where('id', '>',
                                    Auth::user()->role_id)->get() as $role)
                                    <option value="{{ $role->id }}" @if(old('role_id')==$role->id) selected
                                        @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4 form-group">
                                <label for="password">Password</label> 
                                <span style="border: 1px solid whitesmoke; border-radius: 5px; padding: 2px 10px;" class="float-right cursor-pointer" onclick='password = Password.generate(16), document.getElementsByClassName("password").forEach(input =>{
                                    input.value = password
                                })' >Generate</span>
                                <input class="form-control password" type="text" name="password" id="password" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input class="form-control password" type="text" name="cpassword" id="password" required>
                            </div>

                        </div>

                    </div><!-- panel-body -->




                    <div class="panel-footer">
                        <button type="submit" class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1">Save Employee</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>

var Password = {
 
 _pattern : /[a-zA-Z0-9_\-\+\.]/,
 
 
 _getRandomByte : function()
 {
   // http://caniuse.com/#feat=getrandomvalues
   if(window.crypto && window.crypto.getRandomValues) 
   {
     var result = new Uint8Array(1);
     window.crypto.getRandomValues(result);
     return result[0];
   }
   else if(window.msCrypto && window.msCrypto.getRandomValues) 
   {
     var result = new Uint8Array(1);
     window.msCrypto.getRandomValues(result);
     return result[0];
   }
   else
   {
     return Math.floor(Math.random() * 256);
   }
 },
 
 generate : function(length)
 {
   return Array.apply(null, {'length': length})
     .map(function()
     {
       var result;
       while(true) 
       {
         result = String.fromCharCode(this._getRandomByte());
         if(this._pattern.test(result))
         {
           return result;
         }
       }        
     }, this)
     .join('');  
 }    
   
};


</script>
@stop