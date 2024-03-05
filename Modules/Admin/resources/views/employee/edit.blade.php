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
                <form class="form-edit-add" role="form" action="{{ route('employee.update', ['employeeId' => $employee->id]) }}" method="POST" enctype="multipart/form-data">

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
                                <input class="form-control" type="text" value="{{ $employee->name }}" name="name" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="name">Email</label>
                                <input class="form-control" type="text" value="{{ $employee->email}}" name="email" id="">
                            </div>

                            <div class="col-md-4">
                                <label for="store_id">Select Store</label>
                                <select class="form-control" name="store_id" id="store_id" required>
                                    <option value="">Select a Store</option>
                                    @php
                                    $company_id = auth()->user()->company_id ?? null; // Initialize $company_id with the user's company ID or null if it's not set
                                    $stores = \App\Models\Store::where('company_id', $company_id)->get(); // Retrieve stores based on the company_id
                                    @endphp
                                    @foreach($stores as $store)
                                    <option value="{{ $store->id }}" @if(old('store_id')==$store->id || $employee->store_id == $store->id) selected @endif>
                                        {{ $store->store_name ?? 'N/A'  }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="col-md-4">
                                <label for="role_id">User Role</label>
                                <select class="form-control" name="role_id" id="role_id" required>
                                    <option value="">Select a Role</option>
                                    @foreach ($usersRegisteredByCompany as $user)
                                    <option value="{{ $user->role_id }}" {{ $employee->role_id == $user->role_id ? 'selected' : '' }}>
                                        {{ $user->role->name ?? 'N/A'  }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="password">Password</label> 
                                <span style="border: 1px solid whitesmoke; border-radius: 5px; padding: 2px 10px;  background-color:#D95EAD;color:aliceblue" class="float-center cursor-pointer" onclick='password = Password.generate(16), document.getElementsByClassName("password").forEach(input =>{
                                    input.value = password
                                })' >Generate</span>
                                <input class="form-control password" type="text" name="password" id="password" value="{{ $employee->password}}">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection