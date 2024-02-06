<div x-data="{ load: @entangle('load').defer }" class="w-full relative min-h-screen flex flex-col lg:flex-row">
    <section class="max-w-6xl p-8 lg:px-32 lg:py-16 w-full" :class="load ? 'animate-pulse pointer-events-none' : ''">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (session()->has('alert-' . $msg))
            <div
                class="@if(in_array($msg, ['success','info'])) bg-green-100 border-green-500 @else bg-red-100 border-red-500 @endif border-l-4 font-semibold mb-6 px-4 py-2 rounded text-slate-600">
                {{ session('alert-' . $msg) }}
            </div>
            @endif
            @endforeach
        </div>

        <div class="clear"></div>
        <br>

        <div class="" style="overflow-y: auto;">
          
            @switch($step)
                @case(1)
                    <form wire:key="step_3" @submit.prevent="load = true, $wire.selectSubscription()"
                        class="flex border-0 flex-col gap-6" style="border:none">
                        <div>
                            @csrf
                            <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Subscription Step
                                1</span>
                            <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Choose Subscription </h2>
                            <p class="font-medium lg:text-lg text-slate-500">Customise your subscription package.</p>
                        </div>
                        <ul class="grid w-full gap-6 md:grid-cols-2 mb-6">
                            @foreach($plans as $plan)
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
                                <input wire:model="selected_plan.plan_id" wire:click="calculate_total('{{ $period }}')" type="radio"
                                    id="{{ $plan['id'] }}" name="plan" value="{{ $plan['id'] }}" class="hidden peer" required>
                                <label for="{{ $plan['id'] }}"
                                    class="group inline-flex flex-col gap-1.5 w-full px-5 py-3 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:text-purple-600 hover:text-slate-600 hover:bg-slate-100">
                                    <span class="font-medium text-slate-400 text-sm tracking-wider uppercase">{{ $period }}ly</span>
                                    <div class="flex items-center justify-between">
                                        <p class="leading-none">
                                            <strong class="block  text-2xl text-slate-700 font-semibold">
                                                £{{ number_format($plan['price'], 2) }}
                                                <span class="text-base text-slate-500">/ {{ $period }}</span>
                                            </strong>
                                            <span class="font-medium text-slate-400 text-sm">exc. VAT</span>
                                        </p>
                                        <i
                                            class="fa-circle-check fa-solid group-peer-checked:opacity-100 opacity-0 text-2xl text-green-500"></i>
                                    </div>
                                    @if($plan['trialPeriod'])
                                    <p>
                                        <span
                                            class="inline-block bg-green-100 capitalize font-semibold px-2 py-1 rounded text-green-500 text-sm">
                                            {{ $plan['trialDuration'] }} {{ $plan['trialDurationUnit'] }} Free Trial
                                        </span>
                                    </p>
                                    @endif
                                </label>
                            </li>
                            @endforeach
                        </ul>

                        @if(!empty($selected_plan['plan_id']))
                        @php
                        switch($plans[ $selected_plan['plan_id'] ]['billingFrequency']){
                        case "12":
                        $period = 'year';
                        $show_discount = false;
                        break;
                        case "1":
                        default:
                        $period = 'month';
                        $show_discount = true;
                        break;
                        }
                        @endphp
                        <div>
                            @if($show_discount)
                            <div class="flex">
                                <div class="my-auto">
                                    <b>Discount Code:</b>
                                </div>
                                <div>
                                    <x-input wire:keyup="checkDiscount()" wire:model="discount_code" class="ml-2 w-1/4"
                                        type="text" />
                                </div>
                            </div>
                            @endif
                            <header class="flex gap-6 font-medium text-slate-400 text-sm tracking-wider uppercase py-2">
                                <p class="w-full lg:w-1/2">Package</p>
                                <p class="hidden lg:block w-1/6">Price</p>
                                <p class="hidden lg:block w-1/6">Quantity</p>
                                <p class="hidden lg:block w-1/6">Line Total</p>
                            </header>
                            <ul class="border-y border-slate-200 divide-y divide-slate-200">
                                <li class="grid grid-cols-12 items-center gap-6 py-4">
                                    <p class="col-span-12 lg:col-span-6 leading-tight">
                                        <strong class="text-slate-600 font-semibold">{{ $plans[ $selected_plan['plan_id'] ]['name']
                                            }}</strong><br>
                                        <span class="text-slate-400">{{ $plans[ $selected_plan['plan_id'] ]['description'] }}</span>
                                    </p>
                                    <p class="col-span-4 lg:col-span-2 leading-tight">
                                        <strong class="text-slate-600 font-semibold">£{{ number_format($plans[
                                            $selected_plan['plan_id'] ]['price'], 2) }}</strong><br>
                                        <span class="text-slate-400">per {{ $period }}</span>
                                    </p>
                                    <p class="col-span-8 lg:col-span-2 text-slate-600 font-semibold">
                                        <label>Qty:</label>
                                        1
                                    </p>
                                    <p class="hidden lg:block col-span-2 text-slate-600 font-semibold">
                                        £{{ number_format($plans[ $selected_plan['plan_id'] ]['price'], 2) }}
                                    </p>
                                </li>
                                @foreach( $plans[ $selected_plan['plan_id'] ]['addOns'] as $addon)
                                <li class="grid grid-cols-12 items-center gap-6 py-4">
                                    <p class="col-span-12 lg:col-span-6 leading-tight">
                                        <strong class="text-slate-600 font-semibold">{{ $addon['name'] }}</strong><br>
                                        <span class="text-slate-400">{{ $addon['description'] }}</span>
                                    </p>
                                    <p class="col-span-4 lg:col-span-2 leading-tight">
                                        <strong class="text-slate-600 font-semibold">£{{ number_format($addon['amount'], 2)
                                            }}</strong><br>
                                        <span class="text-slate-400">per {{ $period }}</span>
                                    </p>
                                    <p class="col-span-8 lg:col-span-2 flex items-center gap-2">
                                        <label for="addons[{{ $addon['id'] }}][quantity]"
                                            class="text-slate-600 font-semibold">Qty:</label>
                                        <input oninput="this.value = Math.abs(this.value); this.dispatchEvent(new Event('change'));"
                                            wire:model="selected_plan.addons.{{ $addon['id'] }}.quantity" type="number" step="1"
                                            id="addons[{{ $addon['id'] }}][quantity]" name="addons[{{ $addon['id'] }}][quantity]"
                                            class="w-full border-slate-300 text-slate-600 shadow-sm rounded" />


                                    </p>

                                    <p class="hidden lg:block col-span-2 text-slate-600 font-semibold">
                                        @if(!empty($selected_plan['addons'][$addon['id']]) &&
                                        !empty($selected_plan['addons'][$addon['id']]['quantity']))
                                        £{{ number_format($addon['amount'] * $selected_plan['addons'][$addon['id']]['quantity'], 2)
                                        }}
                                        @else
                                        £0.00
                                        @endif
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <footer class="flex gap-6 items-center py-2 text-lg">
                            <p class="hidden lg:block w-1/2"></p>
                            <p class="hidden lg:block w-1/6"></p>
                            <p class="w-1/2 lg:w-1/6 font-semibold text-slate-600 text-sm tracking-wider uppercase">Total</p>
                            <p class="w-1/2 lg:w-1/6 leading-tight">
                                <strong class="text-slate-600 font-semibold">£{{ number_format($total, 2) }}</strong><br>
                                <span class="text-slate-400">per {{ $period }}</span>
                            </p>
                        </footer>

                        @error('addons')
                        <span class="block font-bold mt-2 text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                        @endif

                        <div class="flex justify-between">

                            @if(!empty($selected_plan['plan_id']))
                            <div></div>
                            <x-button type="submit" class="text-lg rounded-full">
                                Continue <i class="fa-regular fa-arrow-right ml-1"></i>
                            </x-button>
                            @endif
                        </div>
                    </form>
                @break
                @case(2)
                    <form wire:key="step_5" @submit.prevent="load = true, $wire.company_billing()" class="space-y-6">
                        <div>
                            @csrf
                            <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Subscription Step
                                2</span>
                            <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Billing Details</h2>
                            <p class="font-medium lg:text-lg text-slate-500">Please confirm your billing details below.</p>

                        </div>
                        <fieldset class="grid grid-cols-2 gap-6">
                            <p class="col-span-1">
                                <x-label for="firstName" required>First Name</x-label>
                                <x-input wire:model="billing.firstName" name="firstName" id="firstName" type="text" required />
                                <x-input-error :messages="$errors->get('billing.firstName')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="lastName" required>Last Name</x-label>
                                <x-input wire:model="billing.lastName" name="lastName" id="lastName" type="text" required />
                                <x-input-error :messages="$errors->get('billing.lastName')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="streetAddress" required>Address Line 1</x-label>
                                <x-input wire:model="billing.streetAddress" name="streetAddress" id="streetAddress" type="text"
                                    required />
                                <x-input-error :messages="$errors->get('billing.streetAddress')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="extendedAddress">Address Line 2</x-label>
                                <x-input wire:model="billing.extendedAddress" name="extendedAddress" id="extendedAddress"
                                    type="text" />
                                <x-input-error :messages="$errors->get('billing.extendedAddress')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="locality" required>City</x-label>
                                <x-input wire:model="billing.locality" name="locality" id="locality" type="text" required />
                                <x-input-error :messages="$errors->get('billing.locality')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="region">County</x-label>
                                <x-input wire:model="billing.region" name="region" id="region" type="text" />
                                <x-input-error :messages="$errors->get('billing.region')" class="mt-2" />
                            </p>
                            <p class="col-span-1">
                                <x-label for="postalCode" required>Postcode</x-label>
                                <x-input wire:model="billing.postalCode" name="postalCode" id="postalCode" type="text" required />
                                <x-input-error :messages="$errors->get('billing.postalCode')" class="mt-2" />
                            </p>
                            {{--<p class="col-span-1">
                                <x-label for="phone">Phone Number</x-label>
                                <x-input wire:model="billing.address.phone" name="phone" id="phone" type="tel" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </p>--}}
                        </fieldset>
                        <div class="flex justify-between">
                            <x-button wire:click="$set('step', 1)" format="wire" type="button" class="text-lg rounded-full">
                                <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                            </x-button>
                           

                            <x-button type="submit" class="text-lg rounded-full">
                                Next <i class="fa-regular fa-arrow-right ml-1"></i>
                            </x-button>
                        </div>
                    </form>
                @break
                @case(3)
                    <div class="space-y-6">
                        <div>
                            <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Subscription Step
                                3</span>
                            <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Payment</h2>
                            <p class="font-medium lg:text-lg text-slate-500">Please enter your payment details below.</p>
                        </div>
                        <div>
                            <div wire:ignore id="dropin-container"></div>
                            <input type="hidden" id="paymentMethodNonce" name="paymentMethodNonce" />
                            @error('paymentMethodNonce')
                            <span class="block font-bold mt-2 text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <x-button @click="$wire.set('step', 2)" format="wire" type="button" class="text-lg rounded-full">
                                <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                            </x-button>

                            <x-button id="submit-button" type="submit" class="text-lg rounded-full">
                                Place Order
                            </x-button>
                        </div>
                      

                        <script wire:ignore>
                            // Build 3DS parameters
                            var threeDSecureParameters = {
                                amount: '{{ $total }}',
                                email: '{{ auth()->user()->email }}',
                                billingAddress: {
                                    givenName: '{{ $billing['firstName'] }}', // ASCII-printable characters required, else will throw a validation error
                                    surname: '{{ $billing['lastName'] }}', // ASCII-printable characters required, else will throw a validation error
                                    streetAddress: '{{ $billing['streetAddress'] }}',
                                    extendedAddress: '{{ $billing['extendedAddress'] }}',
                                    locality: '{{ $billing['locality'] }}',
                                    region: 'GB-UKM', // ISO-3166-2 code
                                    postalCode: '{{ $billing['postalCode'] }}',
                                    countryCodeAlpha2: 'GB'
                                },
                                additionalInformation: {
                                    shippingGivenName: '{{ $billing['firstName'] }}',
                                    shippingSurname: '{{ $billing['lastName'] }}',
                                    shippingAddress: {
                                        streetAddress: '{{ $billing['streetAddress'] }}',
                                        extendedAddress: '{{ $billing['extendedAddress'] }}',
                                        locality: '{{ $billing['locality'] }}',
                                        region: 'GB-UKM', // ISO-3166-2 code
                                        postalCode: '{{ $billing['postalCode'] }}',
                                        countryCodeAlpha2: 'GB'
                                    }
                                },
                            };

                            var button = document.querySelector('#submit-button');

                            braintree.dropin.create({
                                authorization: '{{ $client }}',
                                container: '#dropin-container',
                                threeDSecure: false,
                                vaultManager: true,
                                /*
                                paypal: {
                                    flow: 'checkout',
                                    amount: '50.00',
                                    currency: 'USD'
                                }
                                */
                            }, function (createErr, instance) {
                                button.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    instance.requestPaymentMethod({
                                        threeDSecure: threeDSecureParameters
                                    }, function (err, payload) {
                                        if (err) {
                                            /* Handle errors in requesting payment method */
                                            console.log(err);
                                        } else {
                                            @this.register_nonce(payload.nonce);
                                        }
                                    });
                                });
                            });


                        </script>


                    </div>
                @break

            @endswitch

        </div>
    </section>
</div>

<style>
    .flex {
        border: none;
    }
</style>

<!-- includes the Braintree JS client SDK -->
<script wire:ignore src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>