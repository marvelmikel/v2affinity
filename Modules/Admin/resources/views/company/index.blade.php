@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

 <!-- Company Information -->
    <h1 class="page-title">
        <i class="voyager-company"></i>
      Update Company Information
    </h1>
   
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action=""
              method="POST" enctype="multipart/form-data" autocomplete="off">
           
                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}
            <!-- PUT Method if we are editing -->
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            
                        <div class="form-group">
                        <label for="company_name">{{ __('Company Name') }}</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="{{ __('Company Name') }}"
                               value="{{ old('company_name', $company->company_name ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="company_email">{{ __('Company Email') }}</label>
                        <input type="email" class="form-control" id="company_email" name="company_email" placeholder="{{ __('Company Email') }}"
                               value="{{ old('company_email', $dataTypeContent->company_email) }}">
                    </div>

                    <div class="form-group">
                        <label for="company_address">{{ __('Company Address') }}</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" placeholder="{{ __('Company Address') }}"
                               value="{{ old('company_address', $dataTypeContent->company_address) }}">
                    </div>

                    <div class="form-group">
                        <label for="company_phone">{{ __('Company Phone') }}</label>
                        <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="{{ __('Company Phone') }}"
                               value="{{ old('company_phone', $dataTypeContent->company_phone) }}">
                    </div>

                    <div class="form-group">
                        <label for="company_number">{{ __('Company Number') }}</label>
                        <input type="text" class="form-control" id="company_number" name="company_number" placeholder="{{ __('Company Number') }}"
                               value="{{ old('company_number', $dataTypeContent->company_number) }}">
                    </div>

                    <div class="form-group">
                        <label for="vat_number">{{ __('Vat Number') }}</label>
                        <input type="text" class="form-control" id="vat_number" name="vat_number" placeholder="{{ __('Vat Number') }}"
                               value="{{ old('vat_number', $dataTypeContent->vat_number) }}">
                    </div>
                            <button type="submit" class="btn btn-success pull-right save">
                {{ __('Update Conpany Information') }}
            </button>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

           
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
            <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
