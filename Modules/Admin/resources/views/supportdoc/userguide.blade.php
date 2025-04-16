@extends('voyager::master')

@section('page_title', __('Affinity User Guide v1'))

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-section-title">
                <h3><i class="voyager-book"></i> {{ __('User Guide v1') }}</h3>
                <!-- <div style="display:flex;">
                    testing
                </div> -->
                {{-- <div class="clear"></div>
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <div id="pspdfkit" style="height: 100vh"></div>
                        <script src="{{asset('assets/dist/pspdfkit.js')}}"></script>
                        <script>
                            PSPDFKit.load({
                                    container: "#pspdfkit",
                                    document: "{{ env('APP_URL') }}/support-docs/user-guide.pdf",
                                })
                                .then(function(instance) {
                                    console.log("PSPDFKit loaded", instance);
                                })
                                .catch(function(error) {
                                    console.error(error.message);
                                });
                        </script>
                    </div>
                </div> --}}
                <embed src="{{asset('support-docs/user-guide.pdf')}}" height="2000px" width="1500px" />
                <!-- .row -->
            </div><!-- .col-md-12 -->
        </div><!-- .page-content container-fluid -->
    </div><!-- .page-content container-fluid -->
    @stop
