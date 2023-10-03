<div x-init="const interval = setInterval(() => { $wire.asyncRender(),clearInterval(interval); }, 1000)" >

    <header class="mb-6">
        <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Your Subscriptions</h2>
        <p class="font-medium lg:text-lg text-slate-500">Please find your subscription details below.</p>
    </header>

    <section>
        <header class="grid grid-cols-12 gap-6 font-medium text-slate-400 text-sm tracking-wider uppercase py-2">
            <p class="col-span-12 lg:col-span-3">Package</p>
            <p class="hidden lg:block col-span-2">Status</p>
            <p class="hidden lg:block col-span-2">Price</p>
            <p class="hidden lg:block col-span-2">Next Due</p>
            <p class="hidden lg:block col-span-3"></p>
        </header>
        <ul class="border-y border-slate-200 divide-y divide-slate-200">
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
                <li class="grid grid-cols-12 items-center gap-6 py-4">
                    <p class="col-span-9 lg:col-span-3 leading-tight">
                        <strong class="text-slate-600 font-semibold">{{ $plans[$sub->plan_id]['name'] }}</strong><br>
                        <span class="text-slate-400">{{ $plans[$sub->plan_id]['description'] }}</span>
                    </p>
                    <p class="col-span-3 lg:col-span-2 text-slate-600 font-semibold">
                        <span class="px-4 py-1.5 text-white rounded @if($sub['status'] == 'Active') bg-green-600 @else bg-red-500  @endif">{{ $sub['status'] }}</span>
                    </p>
                    <p class="col-span-6 lg:col-span-2 leading-tight">
                        <strong class="text-slate-600 font-semibold">
                            @php
                                $total = $plans[$sub->plan_id]['price'];
                                foreach(json_decode($sub['addOns'],true) as $addon){
                                    $total += $addon['amount'] * $addon['quantity'];
                                }
                            @endphp
                            £{{ number_format($total, 2) }}
                        </strong><br>
                        <span class="text-slate-400">per {{ $period }}</span>
                    </p>
                    <p class="col-span-6 lg:col-span-2 text-slate-600 font-semibold">
                        <label class="text-slate-400 font-normal block lg:hidden">Next Due:</label>
                        {{ \Carbon\Carbon::parse($sub['nextBillingDate'])->format('jS F Y') }}
                    </p>
                    <p class="col-span-12 lg:col-span-3 gap-4 flex">
                        @if($sub->status !== 'Canceled')
                            <x-button-link href="{{ route('subscription-edit', [ $sub->id ]) }}" format="wire">Edit</x-button-link>
                            <x-button-link href="{{ env('APP_URL') }}" target="_blank" format="wire">Go to app <i class="ml-2 fa-regular fa-up-right-from-square"></i></x-button-link>
                        @endif
                    </p>
                </li>
            @endforeach
        </ul>
    </section>
    <footer class="mt-6">
        {{ $subs->links() }}
    </footer>
</div>
