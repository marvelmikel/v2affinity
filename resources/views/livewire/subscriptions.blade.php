    <!-- session messages -->
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (session()->has('alert-' . $msg))
        <div class="@if(in_array($msg, ['success','info'])) bg-green-100 border-green-500 @else bg-red-100 border-red-500 @endif border-l-4 font-semibold mb-6 px-4 py-2 rounded text-slate-600">
            {{ session('alert-' . $msg) }}
        </div>
        @endif
        @endforeach
    </div>
    </tr>
    <div x-init="const interval = setInterval(() => { $wire.asyncRender(),clearInterval(interval); }, 1000)" class="admin-section-title card" style="display:flex; justify-content: space-between;">
        <h3 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" style="margin-left: 10px;">
            <i class="voyager-paypal"></i>{{ __('Subscriptions Details') }}
        </h3>
    </div>
    <div class="clear"></div>
    <br>
    <div class="" style="overflow-y: auto;">
        <table class="table " style="margin: 40px 0;">
            <thead>
                <tr>
                    <th>PACKAGE</th>
                    <th>STATUS</th>
                    <th>PRICE</th>
                    <th>NEXT DUE</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-y border-slate-200 divide-y divide-slate-200">
                    @foreach($subs as $sub)
                    @php
                    switch($plans[$sub->plan_id]['billingFrequency']){
                    case "12":
                    $period = 'year';
                    break;
                    case "1":
                    default:
                    $period = 'month';
                    break;
                    }
                    @endphp
                    <td>
                        <p class="col-span-9 lg:col-span-3 leading-tight">
                            <strong class="text-slate-600 font-semibold"> {{ $plans[$sub->plan_id]['name'] }} </strong><br>
                            <span class="text-slate-400">{{ $plans[$sub->plan_id]['description'] }}</span>
                        </p>
                    </td>
                    <td class="col-span-3 lg:col-span-2 text-slate-600 font-semibold">
                        <span class="px-4 py-1.5 text-white rounded @if($sub['status'] == 'Active') bg-green-600 @else bg-red-500  @endif">
                            <i class="voyager-check">{{ $sub['status'] }}</i>
                            </button>
                    </td>
                    <td>
                        <strong class="text-slate-600 font-semibold"> @php
                            $total = $plans[$sub->plan_id]['price'];
                            foreach(json_decode($sub['addOns'],true) as $addon){
                            $total += $addon['amount'] * $addon['quantity'];
                            }
                            @endphp
                            £{{ number_format($total, 2) }}
                        </strong><br>
                        <span class="text-slate-400">per {{ $period }}</span>
                    </td>

                    <td>
                        <p class="col-span-6 lg:col-span-2 text-slate-600 font-semibold">
                            {{ \Carbon\Carbon::parse($sub['nextBillingDate'])->format('jS F Y') }}
                        </p>
                    </td>

                    <td>
                        @if($sub->status !== 'Canceled')
                        <x-button-link href="{{ route('subscription-edit', [$sub->id]) }}" format="wire" style="text-decoration: none;">
                            <i class="voyager-edit"></i> Edit
                        </x-button-link>

                        @endif
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>

    </div>