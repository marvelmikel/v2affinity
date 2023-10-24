@extends('voyager::master')

@section('page_title', __('Create Invoice'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager.wallet"></i>
        New Invoice
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="{{ route('voyager.invoices.store') }}"
                          method="POST">

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

                          
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control" type="text" value="{{ old('title') }}" name="title" id="">
                            </div>

                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">
                                    {{ old('description') }}
                                </textarea>
                              
                            </div>

                        </div><!-- panel-body -->
                      
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
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
