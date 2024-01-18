<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
            <ol class="breadcrumb hidden-xs">
                @php
                $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                $url = route('voyager.dashboard');
                @endphp
                @if(count($segments) == 0)
                <li class="active"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</li>
                @else
                <li class="active">
                    <a href="{{ route('voyager.dashboard')}}"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                </li>
                @foreach ($segments as $segment)
                @php
                $url .= '/'.$segment;
                @endphp
                @if ($loop->last)
                <li>{{ ucfirst(urldecode($segment)) }}</li>
                @else
                <li>
                    <a href="{{ $url }}">{{ ucfirst(urldecode($segment)) }}</a>
                </li>
                @endif
                @endforeach
                @endif
            </ol>
            @show
        </div>
        <ul class="nav navbar-nav @if (__('voyager::generic.is_rtl') == 'true') navbar-left @else navbar-right @endif">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ $user_avatar }}" class="profile-img"> <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="{{ $user_avatar }}" class="profile-img">
                        <div class="profile-body">
                            <h5>{{ Auth::user()->name }}</h5>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                    @foreach($nav_items as $name => $item)
                    <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="' .$item['classes'].'"' : '' !!}>
                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                        <form action="{{ route('voyager.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-block">
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                {{__($name)}}
                            </button>
                        </form>
                        @else
                        <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                            <i class="{!! $item['icon_class'] !!}"></i>
                            @endif
                            {{__($name)}}
                        </a>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
        </ul>
        <div class="analytics-container">

            {{-- Get date subscription was created--}}
            @php 
                $trial = null;
                $subscription = auth()->user()->subscriptions->where('status', 'Active')->first();
                if ($subscription && $subscription->status !== 'Cancelled') {
                    $trial = \Illuminate\Support\Carbon::parse( $subscription->created_at )->addDays(7);
                    $trialIsActive = $trial->isFuture();
                } else {
                    $trial = Auth::user()->company->trial_ends_at;
                    $trialIsActive = \Illuminate\Support\Carbon::parse($trial)->isFuture();
                }
            @endphp

            {{-- Show warning message for trial period --}}
            @if( $trial  && $trialIsActive  )
                @if(Auth::user()->role_id !== 1)
                    <p style="border-radius: 4px; padding: 20px; background-color: #FFCCCC; border: 1px solid #EF4444; margin: 0; color: #000; text-align:center;">
                        <code>IMPORTANT</code>: You have {{ $trial->diffInDays(now()) }} day(s) left in your trial. Please: <a href="#" data-toggle="modal" data-target="#add_item_column_modal">click here</a> to read more information about this period.
                    </p>
                @endif
            @elseif(!$subscription && !$trialIsActive)
                 @if(Auth::user()->role_id !== 1)
                    <p style="border-radius: 4px; padding: 20px; background-color: #FFCCCC; border: 1px solid #EF4444; margin: 0; color: #000; text-align:center;">
                        <code>IMPORTANT</code>: You don't have an active subscription. Go to: <a href="{{ route('company.subscriptions') }}">Billing</a> .
                    </p>
                @endif
            @endif

        </div>
    </div>
</nav>

<!-- trial message  modal -->
<div class="modal fade" tabindex="-1" id="add_item_column_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('About Your Trial Period') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('1. You have a 7 day trial period from the date you start your subscription.') }}<br>
                    {{ __('2. This period is to familiarise yourself with our system.') }}<br>
                    {{ __('3. During your trial, you can create or add up to 3 users and assigned them to a store.') }}<br>
                    <b>{{ __('4. After the trial, all data will be reset so please do not use the system for actual surveys.') }}</b><br>
                    {{ __('5. You may change your subscription plan and number of licenses before your next billing date.') }}<br>
                    {{ __('6. We will only start charging you once the trial period is over.') }}
                </p>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>