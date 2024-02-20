<div x-data="{ load: @entangle('load').defer }" x-init="const interval = setInterval(() => { $wire.asyncRender(),clearInterval(interval); }, 1000)">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

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

    <div class="flash-message">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        @endif


        
    </div>



    @if($load['page'])
    <div class="flex items-center justify-center py-12 text-main-color w-full">
        <i class="fa-duotone fa-spinner-third fa-4x fa-spin "></i>
    </div>
    @else

    @php
    switch($plans[$subscription->plan_id]['billingFrequency']){
    case "12":
    $period = 'year';
    break;
    case "1":
    default:
    $period = 'month';
    break;
    }
    @endphp

    @if(!empty($edit))
    @switch($edit)
    @case('cancel')
    <form wire:key="cancel_form" @submit.prevent="load['edit'] = true, $wire.cancelSubscription()" class="space-y-6">
        <div>
            @csrf
            <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Cancel Subscription</h2>
            <p class="font-medium lg:text-lg text-slate-500">Are you sure you wish to cancel your subscription? This will deactivate your access to the affinity application.</p>
        </div>
        <fieldset class="grid grid-cols-2 gap-6">
            <p class="col-span-1">
                <x-label for="unsubscribe" required>Unsubscribe and Deactivate Account</x-label>
                <input id="unsubscribe" name="unsubscribe" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                <x-input-error :messages="$errors->get('unsubscribe')" class="mt-2" />
            </p>
        </fieldset>
        <div class="flex justify-between" style="border:1px solid #f3f7f900">
            <x-button wire:click="$set('edit', false)" format="wire" type="button" class="text-lg rounded-full">
                Cancel
            </x-button>
            <x-button type="submit" class="text-lg rounded-full">
                Cancel Subscription
            </x-button>
        </div>
    </form>
    @break
    @case('billing')
    <form wire:key="billing_form" @submit.prevent="load['edit'] = true, $wire.storeBilling()" class="space-y-6">
        <div>
            @csrf
            <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Billing Details</h2>
            <p class="font-medium lg:text-lg text-slate-500">Edit your billing details below.</p>
        </div>
        <fieldset class="grid grid-cols-2 gap-6">
            <p class="col-span-1">
                <x-label for="firstName" required>First Name</x-label>
                <x-input wire:model="billing.firstName" name="firstName" id="firstName" type="text" required />
                <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="lastName" required>Last Name</x-label>
                <x-input wire:model="billing.lastName" name="lastName" id="lastName" type="text" required />
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="streetAddress" required>Address Line 1</x-label>
                <x-input wire:model="billing.streetAddress" name="streetAddress" id="streetAddress" type="text" required />
                <x-input-error :messages="$errors->get('streetAddress')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="extendedAddress">Address Line 2</x-label>
                <x-input wire:model="billing.extendedAddress" name="extendedAddress" id="extendedAddress" type="text" />
                <x-input-error :messages="$errors->get('extendedAddress')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="locality" required>City</x-label>
                <x-input wire:model="billing.locality" name="locality" id="locality" type="text" required />
                <x-input-error :messages="$errors->get('locality')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="postcode" required>Postcode</x-label>
                <x-input wire:model="billing.postalCode" name="postalCode" id="postalCode" type="text" required />
                <x-input-error :messages="$errors->get('postalCode')" class="mt-2" />
            </p>
            <p class="col-span-1">
                <x-label for="phoneNumber">Phone Number</x-label>
                <x-input wire:model="billing.phoneNumber" name="phoneNumber" id="phoneNumber" type="tel" />
                <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
            </p>
        </fieldset>
        <div class="flex justify-between">
            <x-button wire:click="$set('edit', false)" format="wire" type="button" class="text-lg rounded-full">
                Cancel
            </x-button>
            <x-button type="submit" class="text-lg rounded-full">
                Save
            </x-button>
        </div>
    </form>
    @break
    @case('card')
    <div class="space-y-6">
        <div>
            <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Payment Details</h2>
            <p class="font-medium lg:text-lg text-slate-500">Edit your payment details below.</p>
        </div>
        <div>
            <div wire:ignore id="dropin-container"></div>
            <input type="col-span-12" id="paymentMethodNonce" name="paymentMethodNonce" />
            @error('paymentMethodNonce')
            <span class="block font-bold mt-2 text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-between">
            <x-button wire:click="$set('edit', false)" format="wire" type="button" class="text-lg rounded-full">
                Cancel
            </x-button>
            <x-button id="submit-button" type="submit" class="text-lg rounded-full">
                Save
            </x-button>
        </div>
        <script wire:ignore>
            // Build 3DS parameters
            var threeDSecureParameters = {
                amount: '{{ $total }}',
                email: '{{ auth()->user()->email }}',
                billingAddress: {
                    givenName: '{{ $billing['
                    firstName '] }}', // ASCII-printable characters required, else will throw a validation error
                    surname: '{{ $billing['
                    lastName '] }}', // ASCII-printable characters required, else will throw a validation error
                    phoneNumber: '{{ $billing['
                    phoneNumber '] }}',
                    streetAddress: '{{ $billing['
                    streetAddress '] }}',
                    extendedAddress: '{{ $billing['
                    extendedAddress '] }}',
                    locality: '{{ $billing['
                    locality '] }}',
                    region: 'GB-UKM', // ISO-3166-2 code
                    postalCode: '{{ $billing['
                    postalCode '] }}',
                    countryCodeAlpha2: 'GB'
                },
                additionalInformation: {
                    workPhoneNumber: '{{ $billing['
                    phoneNumber '] }}',
                    shippingGivenName: '{{ $billing['
                    firstName '] }}',
                    shippingSurname: '{{ $billing['
                    lastName '] }}',
                    shippingPhone: '{{ $billing['
                    phoneNumber '] }}',
                    shippingAddress: {
                        streetAddress: '{{ $billing['
                        streetAddress '] }}',
                        extendedAddress: '{{ $billing['
                        extendedAddress '] }}',
                        locality: '{{ $billing['
                        locality '] }}',
                        region: 'GB-UKM', // ISO-3166-2 code
                        postalCode: '{{ $billing['
                        postalCode '] }}',
                        countryCodeAlpha2: 'GB'
                    }
                },
            };

            var button = document.querySelector('#submit-button');

            braintree.dropin.create({
                authorization: '{{ $client }}',
                container: '#dropin-container',
                threeDSecure: true
            }, function(createErr, instance) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    instance.requestPaymentMethod({
                        threeDSecure: threeDSecureParameters
                    }, function(err, payload) {
                        if (err) {
                            // Handle errors in requesting payment method
                            console.log(err);
                        } else {
                            @this.storeCard(payload.nonce);
                        }
                    });
                });
            });
        </script>
    </div>
    @break
    @case('subscription')
    <form wire:key="subscription_form" @submit.prevent="load['edit'] = true, $wire.storeSubscription()" class="space-y-6">
        <div>
            <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Update Subscription</h2>
            <p class="font-medium lg:text-lg text-slate-500">Edit your subscription details below.</p>
        </div>
        <div>
            <header class="grid grid-cols-12 gap-6 font-medium text-slate-400 text-sm tracking-wider uppercase py-2">
                <p class="col-span-12 lg:col-span-6">Package</p>
                <p class="col-span-12 lg:block col-span-2">Price</p>
                <p class="col-span-12 lg:block col-span-2">Quantity</p>
                <p class="col-span-12 lg:block col-span-2">Line Total</p>
            </header>
            <ul class="border-y border-slate-200 divide-y divide-slate-200">
                <li class="grid grid-cols-12 items-center gap-6 py-4">
                    <p class="col-span-9 lg:col-span-6 leading-tight">
                        <strong class="text-slate-600 font-semibold">{{ $plans[$subscription->plan_id]['name'] }}</strong><br>
                        <span class="text-slate-400">{{ $plans[$subscription->plan_id]['description'] }}</span>
                    </p>
                    <p class="col-span-6 lg:col-span-2 leading-tight">
                        <strong class="text-slate-600 font-semibold">
                            £{{ number_format($plans[$subscription->plan_id]['price'], 2) }}
                        </strong><br>
                        <span class="text-slate-400">per {{ $period }}</span>
                    </p>
                    <p class="col-span-8 lg:col-span-2 text-slate-600 font-semibold">
                        <label class="lg:col-span-12 text-slate-400 font-semibold">Qty:</label>
                        <span class="text-slate-600 font-semibold">1</span>
                    </p>
                    <p class="col-span-12 lg:block col-span-2 text-slate-600 font-semibold">
                        £{{ number_format($plans[$subscription->plan_id]['price'], 2) }}
                    </p>
                </li>
                @foreach( $plans[$subscription->plan_id]['addOns'] as $addon)
                <li class="grid grid-cols-12 items-center gap-6 py-4">
                    <p class="col-span-12 lg:col-span-6 leading-tight">
                        <strong class="text-slate-600 font-semibold">{{ $addon['name'] }}</strong><br>
                        <span class="text-slate-400">{{ $addon['description'] }}</span>
                    </p>
                    <p class="col-span-4 lg:col-span-2 leading-tight">
                        <strong class="text-slate-600 font-semibold">£{{ number_format($addon['amount'], 2) }}</strong><br>
                        <span class="text-slate-400">per {{ $period }}</span>
                    </p>
                    <p class="lg:col-span-12 text-slate-600 font-semibold" style="border:1px solid #fff">
                        <label for="addons[{{ $addon['id'] }}][quantity]" class="lg:col-span-12 text-slate-600 font-semibold">Qty:</label>
                        @php
                        $existingAddons = json_decode($this->subscription['addOns'], true);
                        $addonIndex = array_search($addon['id'], array_column($existingAddons, 'id'));
                        @endphp

                        <input wire:model="extras.addons.{{ $addon['id'] }}.quantity" wire:change="calcTotal()" type="number" min="{{ $existingAddons ? $existingAddons[$addonIndex]['quantity'] : 0 }}" step="1" id="addons[{{ $addon['id'] }}][quantity]" name="addons[{{ $addon['id'] }}][quantity]" class="w-full border-slate-300 text-slate-600 shadow-sm rounded" />

                        <a href="/"><span id="error-message-{{ $addon['id'] }}" class="text-red-500 text-sm"></span></a>

                        <script>
                            const input = document.getElementById('addons[{{ $addon['id']}}][quantity]');
                            const errorMessage = document.getElementById('error-message-{{ $addon['id']}}');
                            input.addEventListener('click', function() { errorMessage.innerHTML = 'Please click to contact support.';});
                        </script>



                    </p>
                    <p class="col-span-12 lg:block col-span-2 text-slate-600 font-semibold">
                        @if(!empty($extras['addons'][$addon['id']]) && !empty($extras['addons'][$addon['id']]['quantity']))
                        £{{ number_format($addon['amount'] * $extras['addons'][$addon['id']]['quantity'], 2) }}
                        @else
                        £0.00
                        @endif
                    </p>
                </li>
                @endforeach
            </ul>

            <footer class="flex gap-6 items-center p-2 text-lg justify-between" >
                <p class="w-1/2 lg:w-1/6 font-semibold text-slate-600 text-sm tracking-wider uppercase">Total</p>
                <p class="w-1/2 lg:w-1/6 leading-tight">
                    <strong class="text-slate-600 font-semibold">£{{ number_format($extras['total'], 2) }}</strong><br>
                    <span class="text-slate-400">per {{ $period }}</span>
                </p>
            </footer>
        </div>
        <div class="flex justify-between" style="border:1px solid #fff">
            <x-button wire:click="$set('edit', false)" format="wire" type="button" class="text-lg rounded-full">
                Cancel
            </x-button>
            <x-button format="wire" type="button" @click="$wire.cancelSubscription()" class="rounded-full">
                <i class="fa-solid fa-pencil mr-2"></i>Switch Plan
            </x-button>
            <x-button type="submit" class="text-lg rounded-full">
                Save
            </x-button>
        </div>
    </form>


    <!-- Start Switch Plan Modal -->
    @break
    @case('switch')
    @php
    $plan = collect($plans)->where('id', '!=', $subscription->plan_id)->first();
    @endphp
    <form wire:key="subscription_switch" @submit.prevent="load['edit'] = true, $wire.storeSubscription(1)" class="space-y-6">
        <div>
            <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Switch Plans</h2>
            <p class="font-medium lg:text-lg text-slate-500">Edit your subscription details below.</p>
        </div>

        <ul class="grid w-full gap-6 md:grid-cols-2 mb-6">
            @php
            switch($plan['billingFrequency']){
            case "12":
            $period = 'year';
            break;
            case "1":
            default:
            $period = 'month';
            break;
            }
            @endphp
            <li>
                <input wire:model="inputPlan.plan_id" wire:click="calcTotalSwitch" type="radio" id="{{ $plan['id'] }}" name="plan" value="{{ $plan['id'] }}" class="col-span-12 peer" required>

                <label for="{{ $plan['id'] }}" class="group inline-flex flex-col gap-1.5 w-full px-5 py-3 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:text-purple-600 hover:text-slate-600 hover:bg-slate-100">
                    <span class="font-medium text-slate-400 text-sm tracking-wider uppercase">{{ $period }}ly</span>
                    <div class="flex items-center justify-between" style="border: 1px solid #3330;">
                        <p class="leading-none">
                            <strong class="block text-2xl text-slate-700 font-semibold">
                                £{{ number_format($plan['price'], 2) }}
                                <span class="text-base text-slate-500">/ {{ $period }}</span>
                            </strong>
                            <span class="font-medium text-slate-400 text-sm">inc. VAT</span>
                        </p>
                        <i class="fa-circle-check fa-solid group-peer-checked:opacity-100 opacity-0 text-2xl text-green-500"></i>
                    </div>
                </label>


            </li>
        </ul>

        @if(!empty($inputPlan['plan_id']))
        <div>
            <header class="flex gap-6 font-medium text-slate-400 text-sm tracking-wider uppercase py-2" style="border: 1px solid #fff;">
                <p class="w-full lg:w-1/2">Package</p>
                <p class="col-span-12 lg:block w-1/6">Price</p>
                <p class="col-span-12 lg:block w-1/6">Quantity</p>
                <p class="col-span-12 lg:block w-1/6">Line Total</p>
            </header>
            <ul class="border-y border-slate-200 divide-y divide-slate-200">
                @foreach($plan['addOns'] as $addon)
                @php $this->setQuantity($addon) @endphp
                <li class="grid grid-cols-12 items-center gap-6 py-4">
                    <p class="col-span-12 lg:col-span-6 leading-tight">
                        <strong class="text-slate-600 font-semibold">{{ $addon['name'] }}</strong><br>
                        <span class="text-slate-400">{{ $addon['description'] }}</span>
                    </p>
                    <p class="col-span-4 lg:col-span-2 leading-tight">
                        <strong class="text-slate-600 font-semibold">£{{ number_format($addon['amount'], 2) }}</strong><br>
                        <span class="text-slate-400">per {{ $period }}</span>
                    </p>
                    <p class="col-span-8 lg:col-span-2 flex items-center gap-2">
                        <label for="addons[{{ $addon['id'] }}][quantity]" class="text-slate-600 font-semibold">Qty:</label>
                        <input wire:model="inputPlan.addons.{{ $addon['id'] }}.quantity" wire:change="calcTotalSwitch" type="number" min="1" step="1" oninput="this.value = Math.abs(this.value)" id="addons[{{ $addon['id'] }}][quantity]" name="addons[{{ $addon['id'] }}][quantity]" class="w-full border-slate-300 text-slate-600 shadow-sm rounded" />
                    </p>
                    <p class="col-span-12 lg:block col-span-2 text-slate-600 font-semibold">
                        @if(!empty($inputPlan['addons'][$addon['id']]) && !empty($inputPlan['addons'][$addon['id']]['quantity']))
                        £{{ number_format($addon['amount'] * $inputPlan['addons'][$addon['id']]['quantity'], 2) }}
                        @else
                        £{{ number_format($addon['amount'], 2) }}
                        @endif
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        <footer class="flex items-center py-2 text-lg justify-between">
            <p class="col-span-12 lg:block w-1/2"></p>
            <p class="col-span-12 lg:block w-1/6"></p>
            <p class="w-1/2 lg:w-1/6 font-semibold text-slate-600 text-sm tracking-wider uppercase">Total</p>
            <p class="w-1/2 lg:w-1/6 leading-tight">
                <strong class="text-slate-600 font-semibold">£{{ number_format($this->total_switch, 2) }}</strong><br>
                <span class="text-slate-400">per {{ $period }}</span>
            </p>
        </footer>

        @error('addons')
        <span class="block font-bold mt-2 text-red-400 text-sm">{{ $message }}</span>
        @enderror
        @endif

        <div class="flex justify-between" style="border: 1px solid #3330;">
            <x-button wire:click="$set('edit', 'subscription')" format="wire" type="button" class="text-lg rounded-full">
                Cancel
            </x-button>
            <x-button type="submit" class="text-lg rounded-full">
                Continue
            </x-button>
        </div>
    </form>
    <!-- End Switch Plan Modal -->
    @break
    @endswitch
    @else
    <div class="grid grid-cols-2 w-full gap-8">
        <article class="bg-slate-50 col-span-2 lg:col-span-1 px-6 py-4 rounded-xl">
            <div class="flex justify-between items-center mb-6" style="border: 1px solid #3330;">
                <h2 class="font-semibold text-slate-700 text-xl">Billing Address</h2>
                <x-button format="wire" type="button" @click="$wire.set('edit', 'billing')" class="rounded-full">
                    <i class="fa-solid fa-pencil mr-2"></i>Edit
                </x-button>
            </div>
            <p class="text-slate-600 font-medium">
                {{ $billing['firstName'] }} {{ $billing['lastName'] }}<br>
                {{ $billing['company'] }}<br>
                {{ $billing['streetAddress'] }}<br>
                @if(!empty($billing['extendedAddress']))
                {{ $billing['extendedAddress'] }}<br>
                @endif
                @if(!empty($billing['locality']))
                {{ $billing['locality'] }}<br>
                @endif
                @if(!empty($billing['region']))
                {{ $billing['region'] }}<br>
                @endif
                {{ $billing['postalCode'] }}<br>
                {{ $billing['countryName'] }}
            </p>
        </article>

        <article class="bg-slate-50 col-span-2 lg:col-span-1 px-6 py-4 rounded-xl">
            <div class="flex justify-between items-center mb-6" style="border: 1px solid #3330;">
                <h2 class="font-semibold text-slate-700 text-xl">Card Details</h2>
                <x-button format="wire" type="button" @click="$wire.set('edit', 'card')" class="rounded-full">
                    <i class="fa-solid fa-pencil mr-2"></i>Edit
                </x-button>
            </div>
            <div class="border flex gap-4 items-center p-5 rounded">
                <figure>
                    <img src="{{ $creditCard['image'] }}" alt="" />
                </figure>
                <p class="leading-none flex-grow">
                    <span class="font-medium text-slate-400 text-sm tracking-wider uppercase leading-none">Last 4 Digits</span><br>
                    <strong class="font-semibold text-lg text-slate-600">{{ $creditCard['last4'] }}</strong>
                </p>
                <p class="leading-none">
                    <span class="font-medium text-slate-400 text-sm tracking-wider uppercase leading-none">Expiration Date</span><br>
                    <strong class="font-semibold text-lg text-slate-600">{{ $creditCard['expirationDate'] }}</strong>
                </p>
            </div>
        </article>

        <div class="col-span-2">
            <hr />
        </div>

        <article class="col-span-2">
            <header class="flex justify-between items-center mb-6 " style="border: 1px solid #3330;">
                <div>
                    <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Your Subscriptions</h2>
                    <p class="font-medium lg:text-lg text-slate-500">Please find your subscription details below.</p>
                </div>
                <x-button format="wire" type="button" @click="$wire.set('edit', 'subscription')" class="rounded-full">
                    <i class="fa-solid fa-pencil mr-2"></i>Edit
                </x-button>
                <footer class="col-span-2">
                    <x-button format="warn" type="button" @click="$wire.set('edit', 'cancel')" class="rounded-full">Cancel Subscription</x-button>
                </footer>
            </header>
            <section>
                <div class="grid w-full gap-8 lg:grid-cols-3 mb-6 items-center">
                    <div class="col-span-1">
                        <label class="group inline-flex flex-col gap-1.5 w-full px-5 py-3 border rounded-lg cursor-pointer border-purple-600 bg-purple-50 text-purple-600">
                            <span class="font-medium text-slate-400 text-sm tracking-wider uppercase">{{ $period }}ly</span>
                            <div class="flex items-center justify-between" style="border:1px solid #f3f7f9">
                                <p class="leading-none">
                                    <strong class="block text-2xl text-slate-700 font-semibold">
                                        @php
                                        $total = $plans[$subscription->plan_id]['price'];
                                        foreach(json_decode($subscription['addOns'],true) as $addon){
                                        $total += $addon['amount'] * $addon['quantity'];
                                        }
                                        @endphp
                                        £{{ number_format($total, 2) }}
                                        <span class="text-base text-slate-500">/ {{ $period }}</span>
                                    </strong>
                                    <span class="font-medium text-slate-400 text-sm">inc. VAT</span>
                                </p>
                                <i class="fa-circle-check fa-solid opacity-100 text-2xl text-green-500"></i>
                            </div>
                        </label>
                    </div>
                    <div class="lg:col-span-2">
                        <p>
                            <span class="block font-medium text-slate-500">Next Payment Date</span>
                            <strong class="block font-semibold mb-3 text-slate-700 text-xl">
                                {{ \Carbon\Carbon::parse($subscription->nextBillingDate)->format('jS F Y') }}
                            </strong>
                        </p>
                        @if($plans[$subscription->plan_id]['trialPeriod'] && $subscription->firstBillingDate >= date('Y-m-d'))
                        <p>
                            <span class="inline-block bg-green-100 capitalize font-semibold px-2 py-1 rounded text-green-500 text-sm">
                                @php
                                $date = \Carbon\Carbon::parse($subscription->nextBillingDate);
                                $now = \Carbon\Carbon::now();
                                $diff = $date->diffInDays($now);
                                @endphp
                                {{-- Free trial {{ $diff }} days remaining --}}
                            </span>
                        </p>
                        @endif
                    </div>
                </div>

                <header class="grid grid-cols-12 gap-6 font-medium text-slate-400 text-sm tracking-wider uppercase py-2">
                    <p class="col-span-12 lg:col-span-5">Package</p>
                    <p class="col-span-12 lg:block col-span-2">Price</p>
                    <p class="col-span-12 lg:block col-span-2">Quantity</p>
                    <p class="col-span-12 lg:block col-span-3">Line Total</p>
                </header>
                <ul class="border-y border-slate-200 divide-y divide-slate-200">
                    <li class="grid grid-cols-12 items-center gap-6 py-4">
                        <p class="col-span-9 lg:col-span-5 leading-tight">
                            <strong class="text-slate-600 font-semibold">{{ $plans[$subscription->plan_id]['name'] }}</strong><br>
                            <span class="text-slate-400">{{ $plans[$subscription->plan_id]['description'] }}</span>
                        </p>
                        <p class="col-span-6 lg:col-span-2 leading-tight">
                            <strong class="text-slate-600 font-semibold">
                                £{{ number_format($plans[$subscription->plan_id]['price'], 2) }}
                            </strong><br>
                            <span class="text-slate-400">per {{ $period }}</span>
                        </p>
                        <p class="col-span-8 lg:col-span-2 text-slate-600 font-semibold">
                            <label class="lg:col-span-12 text-slate-400 font-semibold">Qty:</label>
                            <span class="text-slate-600 font-semibold">1</span>
                        </p>
                        <p class="col-span-12 lg:block col-span-3 text-slate-600 font-semibold">
                            £{{ number_format($plans[$subscription->plan_id]['price'], 2) }}
                        </p>
                    </li>
                    @foreach( json_decode($subscription['addOns'], true) as $addon)
                    <li class="grid grid-cols-12 items-center gap-6 py-4">
                        <p class="col-span-12 lg:col-span-5 leading-tight">
                            <strong class="text-slate-600 font-semibold">{{ $addon['name'] }}</strong>
                        </p>
                        <p class="col-span-4 lg:col-span-2 leading-tight">
                            <strong class="text-slate-600 font-semibold">£{{ number_format($addon['amount'], 2) }}</strong><br>
                            <span class="text-slate-400">per {{ $period }}</span>
                        </p>
                        <p class="col-span-8 lg:col-span-2 flex items-center gap-2" style="border:1px solid #fff">
                            <label class="lg:col-span-12 text-slate-600 font-semibold">Qty:</label>
                            <span class="text-slate-600 font-semibold">{{ $addon['quantity'] }}</span>
                        </p>
                        <p class="col-span-12 lg:block col-span-3 text-slate-600 font-semibold">
                            @if($addon['amount'] > 0 && !empty($addon['quantity']))
                            £{{ number_format($addon['amount'] * $addon['quantity'], 2) }}
                            @else
                            £0.00
                            @endif
                        </p>
                    </li>
                    @endforeach
                </ul>
            </section>

            <!-- Subcription History -->
            <header class="flex justify-between items-center mb-6 " style="border: 1px solid #3330;">
                <div>
                    <h2 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">Subscription History</h2>
                    <p class="font-medium lg:text-lg text-slate-500">Please find your subscription history below.</p>
                </div>
            </header>

            <div class="container-fluid" style="padding-left:0px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Subscription ID</th>
                                            <th>Plan Name</th>
                                            <th>Price</th>
                                            <th>Trial Period</th>
                                            <th>Billing Cycle</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subscriptionTableBody">
                                        @foreach($subscriptions as $subscription)
                                        <tr role="row">
                                            <td>{{ $subscription->id }}</td>
                                            <td>{{ $plans[$subscription->plan_id]['name'] }}</td>
                                            <td>£{{ number_format($plans[$subscription->plan_id]['price'], 2) }}<br> per {{ $period }}</td>
                                            <td>{{ number_format($plans[$subscription->plan_id]['trialDuration'],) }} days</td>
                                            <td>{{ number_format($plans[$subscription->plan_id]['billingFrequency'],) }}</td>
                                            <td>{{ $subscription->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($subscription['created_at'])->format('F d, Y H:i:s') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Subcription History -->
        </article>



    </div>

    @endif

    @endif

    <!-- includes the Braintree JS client SDK -->
    <script wire:ignore src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>

</div>

@section('javascript')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false
            }]
        });
    });
</script>


@stop