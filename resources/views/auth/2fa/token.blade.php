<x-guest-layout>

    @if(session()->has('error'))
        <p class="alert alert-info">
            {!! session()->get('error') !!}
        </p>
    @endif

    <form method="POST" action="{{ route('auth.2fa.store') }}">
        {{ csrf_field() }}
        
        <h1>Two Factor Verification</h1>
        <br>
       

        <p class="text-muted">
            For security reasons, you must provide the two factor code sent to your email address
            @if ($reason)
                {{ ' because ' . $reason }}
            @endif
            .
        </p>

        <br>
        

        <div class="input-group mb-3">
            
            
            <input  name="token" 
                    type="text" 
                    class="form-control w-full rounded {{ $errors->has('token') ? 'is-invalid' : '' }}" 
                    required 
                    autofocus 
                    placeholder="Two Factor Code" />

            @if($errors->has('token'))
                <div class="invalid-feedback">
                    {{ $errors->first('token') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-6">
                {{-- <button type="submit" class="btn btn-primary px-4">
                    Verify
                </button> --}}
                 <x-primary-button type="submit" class="mx-auto">
                    {{ __('Verify') }}
                </x-primary-button>

            </div>
        </div>

        <br>
        <hr>
        <a class="btn btn-link" href="{{ url('/login') }}">
            Need a new code ?
        </a>
    </form>

</x-guest-layout>