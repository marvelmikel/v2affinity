@push('styles')
    <link rel="stylesheet" href="{{ asset( '/assets/css/main.css' ) }}">
@endpush
@if(session()->has('message'))
    @if( is_array(session('message')) ) 
        @foreach(session('message') as $msg)
        <div class="alert alert-info alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info!</strong> {!! $msg !!}
        </div>
        @endforeach
    @else
        <div class="alert alert-info alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info!</strong> {!! session('message') !!}
        </div>
    @endif
@endif

@if(session()->has('success'))
   @if( is_array(session('success')) ) 
        @foreach(session('success') as $msg)
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info!</strong> {!! $msg !!}
        </div>
        @endforeach
    @else
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info!</strong> {!! session('success') !!}
        </div>
    @endif
@endif

@if(session()->has('warning'))
    
    @if( is_array(session('warning')) ) 
        @foreach(session('warning') as $msg)
        <div class="alert alert-warning alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> {!! $msg !!}
        </div>
        @endforeach
    @else
        <div class="alert alert-warning alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> {!! session('warning') !!}
        </div>
    @endif

@endif

@if(session()->has('error'))
    @if( is_array(session('error')) ) 
        @foreach(session('error') as $msg)
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> {!! $msg !!}
        </div>
        @endforeach
    @else
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> {!! session('error') !!}
        </div>
    @endif
@endif


@if(session()->has('danger'))
   @if( is_array(session('danger')) ) 
        @foreach(session('danger') as $msg)
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Danger!</strong> {!! $msg !!}
        </div>
        @endforeach
    @else
        <div class="alert alert-info alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Danger!</strong> {!! session('danger') !!}
        </div>
    @endif
@endif

@if($errors->any())
    @foreach($errors->all() as $msg)
    <div class="alert alert-danger alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {{ $msg }}
    </div>
    @endforeach
@endif




@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert').click(function(){
                $(this).hide()
            })
        })
</script>
@endpush


