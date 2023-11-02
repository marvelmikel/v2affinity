<div x-data="{ load: @entangle('load').defer }" class="w-full relative min-h-screen flex flex-col lg:flex-row">

    <aside class="sticky top-0 w-full lg:w-1/4 bg-white lg:p-5 flex-shrink lg:h-screen">
        <div class="bg-slate-800 lg:rounded-lg h-full flex flex-col justify-between p-6">
            <header class="hidden lg:block">
                <a class="block no-underline hover:text-white hover:no-underline mb-2" href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="139.508" height="40.74" viewBox="0 0 139.508 40.74">
                        <g transform="translate(-773.5 451.5)">
                            <path d="M256.238-61.259a21.371,21.371,0,0,1-3.725-.351,9.007,9.007,0,0,1-3.256-1.17l1.17-4.135a14.593,14.593,0,0,0,2.808,1.053,12.753,12.753,0,0,0,3.237.391c2.277,0,3.917-.545,4.874-1.619s1.5-2.812,1.6-5.167l.156-2.574a9.163,9.163,0,0,1-3.1,3.8,7.555,7.555,0,0,1-4.309,1.306,5.882,5.882,0,0,1-4.992-2.223,9.9,9.9,0,0,1-1.638-6.161l.078-11.038H253.9L253.82-78.5a5.987,5.987,0,0,0,.722,3.179,2.581,2.581,0,0,0,2.359,1.15,4.2,4.2,0,0,0,3.12-1.384,10.089,10.089,0,0,0,2.086-4.641,42.7,42.7,0,0,0,.8-8.951h4.6v16.3c0,3.933-1,6.879-2.964,8.755S259.782-61.259,256.238-61.259ZM242.081-69.1a7.539,7.539,0,0,1-5.519-1.95,6.774,6.774,0,0,1-1.93-5.109l.156-9.009h-3.353v-3.978h3.432L234.9-93.2h4.758l-.078,4.055h6.435v3.978h-6.474l-.117,8.5a3.469,3.469,0,0,0,.8,2.515,3.256,3.256,0,0,0,2.515.916,5.822,5.822,0,0,0,1.678-.234,5.577,5.577,0,0,0,1.638-.858l1.4,3.666a5.856,5.856,0,0,1-2.3,1.17A11.534,11.534,0,0,1,242.081-69.1ZM137.9-69.306c-.049,0-.1,0-.152-.007s-.086-.006-.127-.007h-4.665l1.723-4.841.527-1.481.687-1.93-.4-.018c-.294-.013-.572-.025-.854-.041a13.489,13.489,0,0,1-3-.47,5.2,5.2,0,0,1-1.722-.8A1.974,1.974,0,0,1,129-80.582a2.319,2.319,0,0,1,.193-.787,4.413,4.413,0,0,1,.642-1.094l.006-.008.015-.019.082-.1,0-.005.006-.008a7.363,7.363,0,0,1,.511-.548,17.308,17.308,0,0,1,3.653-2.637c.229-.13.464-.26.7-.385.7-.377,1.415-.728,2.117-1.042.48-.214.967-.417,1.447-.6l.091-.034c.055-.02.11-.038.166-.056s.083-.023.137-.035l.066-.016-.159.469c-.2.576-.379,1.119-.574,1.667a.19.19,0,0,1-.013.029.371.371,0,0,1-.188.153,8.513,8.513,0,0,0-3.524,2.411,2.459,2.459,0,0,0-.684,1.188,1.438,1.438,0,0,0,.751,1.716l.03.02a5.745,5.745,0,0,0,2.1.714l.021,0,.174-.462c.124-.33.251-.67.373-1,.148-.406.293-.811.428-1.191l.007-.019.179-.5.268-.748q.458-1.281.914-2.563.241-.678.479-1.356.286-.809.573-1.618.317-.892.637-1.782t.631-1.766q.292-.819.582-1.638l0-.007q.292-.824.585-1.647.258-.723.518-1.446l.007-.019,0-.005q.33-.92.659-1.841c.141-.4.28-.8.414-1.189q.105-.305.211-.611h5.145l.111.3c.089.242.18.485.271.728l.6,1.6.011.028q.436,1.165.872,2.329c.378,1.014.755,2.035,1.119,3.022.153.415.315.857.47,1.3a.282.282,0,0,0,.3.232l.063,0c.952-.089,1.837-.133,2.7-.133.508,0,1.012.016,1.5.047a12.653,12.653,0,0,1,3.5.627l.109.04a3.765,3.765,0,0,1,1.557.984,1.81,1.81,0,0,1,.419.754,2.194,2.194,0,0,1-.121,1.353,5.25,5.25,0,0,1-1.4,1.9c-.22.208-.455.415-.7.616l-.16.13-.007.005-.08.064,0,0-.079.062-.084.065-.011.008-.158.119-.015.011-.077.057-.006,0-.073.053-.009.006-.009.006-.074.053-.018.013-.064.045-.008.006-.01.007-.072.051-.013.009-.012.009-.063.043-.018.013-.007,0-.061.042-.028.019-.069.046-.024.016-.054.036-.01.007-.02.013-.067.044-.034.022-.046.03-.042.027-.055.035-.036.023-.048.031-.05.032-.043.027-.011.007-.028.017-.065.04-.027.017-.009.005-.044.027-.034.021-.068.041-.033.02-.051.031-.041.024-.057.034-.033.019-.066.039-.021.012-.011.006-.055.032-.018.011-.01.006-.075.043-.024.014-.066.038-.01.005-.007,0-.081.046-.02.011-.084.047c-.363.2-.721.395-1.1.6l-.273.147-.258.139.208.556c.161.429.327.872.488,1.311q.3.805.592,1.611c.282.77.574,1.565.865,2.35.165.443.336.892.5,1.327l0,.006c.154.4.313.82.468,1.235.433,1.158.868,2.333,1.289,3.468l.449,1.211a.039.039,0,0,1,0,.013s0,.01,0,.016,0,.018,0,.029v.007l-.066,0c-.05,0-.1.008-.146.008h-1.689c-1.231,0-2.49,0-3.355,0h-.006a.235.235,0,0,1-.264-.181c-.108-.319-.227-.655-.365-1.026q-.37-1-.741-2l-.021-.057-.441-1.186-.027-.073-.145-.39-.122-.33-.006-.017c-.349-.939-.709-1.909-1.06-2.866-.214-.585-.392-1.1-.565-1.588-.122-.351-.249-.713-.39-1.107l-.109-.3a.312.312,0,0,0-.027-.052l-.02-.036c-.283.1-.333.113-.392.132s-.113.035-.378.126l-.2.069c-1.589.536-3.239,1-5.043,1.417l-.08.019c-.523.122-.945.234-1.354.342a18.673,18.673,0,0,1-2.52.534l-.259.033a.3.3,0,0,0-.145.069.174.174,0,0,0-.052.065c-.155.394-.3.8-.436,1.193l-.023.065q-.175.494-.349.989l-.138.393c-.279.793-.568,1.613-.858,2.425l-.129.358c-.193.532-.392,1.072-.585,1.595l0,.012q-.164.445-.328.891a1.469,1.469,0,0,0-.044.16c-.01.042-.02.086-.033.125l0,.006a.343.343,0,0,1-.07.134.157.157,0,0,1-.028.023.234.234,0,0,1-.048.024A.47.47,0,0,1,137.9-69.306Zm9.052-26.27c-.145.463-.219.665-.22.667s-.062.231-.183.667q-.08.285-.194.69c-.018.065-.044.154-.074.259-.064.219-.228.776-.376,1.218q-.243.727-.484,1.453l-.006.019c-.264.794-.536,1.614-.809,2.42-.217.643-.443,1.3-.689,2.02q-.243.706-.489,1.411c-.3.869-.614,1.752-.915,2.606q-.254.722-.506,1.439c-.069.2-.137.4-.209.608l-.092.271.09-.021c.062-.015.109-.026.153-.038l.029-.007.007,0a3.916,3.916,0,0,0,1.78-.924c.12-.1.252-.2.406-.318a5.691,5.691,0,0,0,.845-.845c.131-.154.26-.313.386-.467.184-.226.356-.438.527-.628a10.168,10.168,0,0,0,2-3.4,11.174,11.174,0,0,0,.582-2.65,9.606,9.606,0,0,0-.171-3.028,13.628,13.628,0,0,0-.446-1.506l-.091-.271a4.864,4.864,0,0,0-.722-1.466c-.037-.05-.072-.1-.109-.151Zm6.609,5.837c.692,1.865,1.363,3.673,2.053,5.527l.226-.155c.157-.108.3-.208.448-.315a6.517,6.517,0,0,0,1.832-1.864,2,2,0,0,0,.3-1,1.549,1.549,0,0,0-.856-1.343,6.362,6.362,0,0,0-2.642-.751c-.3-.033-.594-.052-.91-.072l-.407-.027-.028,0h-.019Zm51.546,20.291h-4.72v-19.7h4.758l-.234,4.954a9.232,9.232,0,0,1,3.081-3.9,7.6,7.6,0,0,1,4.446-1.364,5.877,5.877,0,0,1,5.012,2.281,10.684,10.684,0,0,1,1.657,6.532l-.077,11.192h-4.758l.078-10.8a6.57,6.57,0,0,0-.722-3.529,2.661,2.661,0,0,0-2.437-1.229,4.17,4.17,0,0,0-2.38.741,6,6,0,0,0-1.911,2.516,18.553,18.553,0,0,0-1.287,4.8,53.436,53.436,0,0,0-.507,7.508Zm-35.8,0h-4.8V-84.757a6.959,6.959,0,0,0,1.164-1.988,4.915,4.915,0,0,0-.88-5.161q-.066-.074-.134-.144a8.138,8.138,0,0,1,.922-2.653,7.709,7.709,0,0,1,2.925-2.944,8.528,8.528,0,0,1,4.271-1.053,7.093,7.093,0,0,1,4.621,1.423,5.455,5.455,0,0,1,1.645,2.378,7.424,7.424,0,0,1,2.762-2.748,8.449,8.449,0,0,1,4.232-1.053,6.366,6.366,0,0,1,4.055,1.13L188.1-94.136a3.9,3.9,0,0,0-2.066-.546A3.234,3.234,0,0,0,183.5-93.63a4.653,4.653,0,0,0-.936,3.159v1.326h5.85v3.978h-5.772V-69.45h-4.8V-85.167h-8.541v15.718Zm3.353-25.234a3.175,3.175,0,0,0-2.516,1.053,4.456,4.456,0,0,0-.916,3v1.481h8.619V-90a11.053,11.053,0,0,1,.35-2.855l-2.768.319a2.225,2.225,0,0,0-.858-1.579A3.077,3.077,0,0,0,172.661-94.683Zm56,25.233h-4.758v-19.7h4.758V-69.45Zm-33.345,0h-4.758v-19.7h4.758V-69.45Zm30.966-22.815a2.937,2.937,0,0,1-2.223-.859,2.9,2.9,0,0,1-.819-2.066,2.9,2.9,0,0,1,.819-2.067,2.937,2.937,0,0,1,2.223-.858,2.94,2.94,0,0,1,2.223.858,2.9,2.9,0,0,1,.819,2.067,2.9,2.9,0,0,1-.819,2.066A2.94,2.94,0,0,1,226.286-92.264Zm-33.345,0a2.937,2.937,0,0,1-2.223-.859,2.9,2.9,0,0,1-.819-2.066,2.9,2.9,0,0,1,.819-2.067,2.937,2.937,0,0,1,2.223-.858,2.94,2.94,0,0,1,2.223.858,2.9,2.9,0,0,1,.819,2.067,2.9,2.9,0,0,1-.819,2.066A2.94,2.94,0,0,1,192.941-92.264Z" transform="translate(645 -350)" fill="#fff" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"/>
                        </g>
                    </svg>
                </a>
                <p class="text-slate-300 text-lg font-medium">Accelerate your Carpet Stores Invoice Processing with Affinity</p>
            </header>
            <ul class="flex lg:flex-col justify-center lg:justify-start gap-6">
                <li class="flex gap-4 items-center">
                <span
                    class="
                        @if($step > 1)
                            bg-green-600 text-white
                        @elseif($step === 1)
                            bg-gradient-to-b from-main-color to-custom2-purple-color text-white
                        @else
                            bg-slate-700 text-slate-400
                        @endif
                        flex font-semibold h-10 items-center justify-center rounded-full w-10">
                    @if($step > 1)
                        <i class="fa-solid fa-check"></i>
                    @else
                        1
                    @endif
                </span>
                    <strong class="hidden sm:block font-semibold @if($step > 1) text-green-600 @elseif($step === 1) text-slate-400 @else text-slate-400 @endif">Account<span class="hidden lg:inline"> Details</span></strong>
                </li>
                <li class="flex gap-4 items-center">
                <span
                    class="
                        @if($step > 2)
                            bg-green-600 text-white
                        @elseif($step === 2)
                            bg-gradient-to-b from-main-color to-custom2-purple-color text-white
                        @else
                            bg-slate-700 text-slate-400
                        @endif
                        flex font-semibold h-10 items-center justify-center rounded-full w-10">
                    @if($step > 2)
                        <i class="fa-solid fa-check"></i>
                    @else
                        2
                    @endif
                </span>
                    <strong class="hidden sm:block font-semibold @if($step > 2) text-green-600 @elseif($step === 2) text-slate-400 @else text-slate-400 @endif">Company<span class="hidden lg:inline"> Details</span></strong>
                </li>
                <li class="flex gap-4 items-center">
                <span
                    class="
                        @if($step > 3)
                            bg-green-600 text-white
                        @elseif($step === 3)
                            bg-gradient-to-b from-main-color to-custom2-purple-color text-white
                        @else
                            bg-slate-700 text-slate-400
                        @endif
                        flex font-semibold h-10 items-center justify-center rounded-full w-10">
                    @if($step > 3)
                        <i class="fa-solid fa-check"></i>
                    @else
                        3
                    @endif
                </span>
                    <strong class="hidden sm:block font-semibold @if($step > 3) text-green-600 @elseif($step === 3) text-slate-400 @else text-slate-400 @endif">Subscription</strong>
                </li>
                <li class="flex gap-4 items-center">
                <span
                    class="
                        @if($step > 4)
                            bg-green-600 text-white
                        @elseif($step === 4)
                            bg-gradient-to-b from-main-color to-custom2-purple-color text-white
                        @else
                            bg-slate-700 text-slate-400
                        @endif
                        flex font-semibold h-10 items-center justify-center rounded-full w-10">
                    @if($step > 4)
                        <i class="fa-solid fa-check"></i>
                    @else
                        4
                    @endif
                </span>
                    <strong class="hidden sm:block font-semibold @if($step > 4) text-green-600 @elseif($step === 4) text-slate-400 @else text-slate-400 @endif">Billing<span class="hidden lg:inline"> Details</span></strong>
                </li>
                <li class="flex gap-4 items-center">
                <span
                    class="
                        @if($step === 5)
                            bg-gradient-to-b from-main-color to-custom2-purple-color text-white
                        @else
                            bg-slate-700 text-slate-400
                        @endif
                        flex font-semibold h-10 items-center justify-center rounded-full w-10">5</span>
                    <strong class="hidden sm:block font-semibold @if($step > 5) text-green-600 @elseif($step === 5) text-slate-400 @else text-slate-400 @endif">Payment</strong>
                </li>
            </ul>
            <div class="hidden lg:block">
                @if(auth()->user())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-button-link :href="route('logout')" format="wire" type="submit" class="w-full border-slate-300 text-slate-300 text-center hover:text-main-color hover:border-main-color" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-button-link>
                    </form>
                @else
                    <x-button-link href="{{ route('voyager.login') }}" format="wire" type="button" class="w-full border-slate-300 text-slate-300 text-center hover:text-main-color hover:border-main-color">Already have an account?</x-button-link>
                @endif
            </div>
        </div>
    </aside>

    <section class="max-w-6xl p-8 lg:px-32 lg:py-16 w-full" :class="load ? 'animate-pulse pointer-events-none' : ''">

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

        @switch($step)
            @case(1)
                <form wire:key="step_1" @submit.prevent="load = true, $wire.register_user()" class="space-y-6">
                    <div>
                        @csrf
                        <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Registration Step 1</span>
                        <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Company Admin Details</h2>
                        <p class="font-medium lg:text-lg text-slate-500">Please enter your account registration details below.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <p class="col-span-1">
                            <x-label for="name" required>Full Name</x-label>
                            <x-input wire:model="user.name" name="name" id="name" type="text" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </p>
                        <p class="col-span-1">
                            <x-label for="email" required>Email Address</x-label>
                            <x-input wire:model="user.email" name="email" id="email" type="email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </p>
                        <p class="col-span-2">
                            <x-label for="password" required>Password</x-label>
                            <x-input wire:model="user.password" name="password" id="password" type="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </p>
                        <p class="col-span-2">
                            <x-label for="password_confirmation" required>Confirm Password</x-label>
                            <x-input wire:model="user.password_confirmation" name="password_confirmation" id="password_confirmation" type="password" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <x-button type="submit" class="text-lg rounded-full">
                            Next <i class="fa-regular fa-arrow-right ml-1"></i>
                        </x-button>
                    </div>
                </form>
                @break
            @case(2)
                <form wire:key="step_2" @submit.prevent="load = true, $wire.register_company()" class="flex flex-col gap-6">
                    <div>
                        @csrf
                        <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Registration Step 2</span>
                        <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Company Details</h2>
                        <p class="font-medium lg:text-lg text-slate-500">Please enter your Company details. These details can be changed by admins after completion.</p>
                    </div>
                    <ul x-data="" class="space-y-6">
                        <li class="">
                            <header class="mb-4 cursor-pointer flex items-center justify-between w-full">
                                <h3 class="block font-semibold text-xl text-slate-700">Company Information</h3>
                            </header>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            @endif
                            <fieldset>
                                <div class="grid grid-cols-2 gap-6">
                                    <p class="col-span-1">
                                        <x-label for="company_name" required>Company Name</x-label>
                                        <x-input wire:model="company.company_name" name="company_name" id="company_name" type="text" required />
                                        <x-input-error :messages="$errors->get('company.company_name')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="company_phone">Phone No.</x-label>
                                        <x-input wire:model="company.company_phone" name="company_phone" id="company_phone" type="tel" />
                                        <x-input-error :messages="$errors->get('company.company_phone')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="company_email">Email Address</span> No.</x-label>
                                        <x-input wire:model="company.company_email" name="company_email" id="company_email" type="text" />
                                        <x-input-error :messages="$errors->get('company.company_email')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="company_number">Company Reg<span class="hidden lg:inline">istration</span> No.</x-label>
                                        <x-input wire:model="company.company_number" name="company_number" id="company_number" type="text" />
                                        <x-input-error :messages="$errors->get('company.company_number')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="vat_number">VAT Reg<span class="hidden lg:inline">istration</span> No.</x-label>
                                        <x-input wire:model="company.vat_number" name="vat_number" id="vat_number" type="text" />
                                        <x-input-error :messages="$errors->get('company.vat_number')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="company_address">Full Address</x-label>
                                        <x-input wire:model="company.company_address" name="company_address" id="company_address" type="text" />
                                        <x-input-error :messages="$errors->get('company.company_address')" class="mt-2" />
                                    </p>
                                    <p class="col-span-1">
                                        <x-label for="logo">Company Logo</x-label>
                                        <x-input wire:model="company.logo" name="logo" id="logo" type="file" />
                                        <x-input-error :messages="$errors->get('company.logo')" class="mt-2" />
                                    </p>
                                </div>
                            </fieldset>
                        </li>
                    </ul>
                    <div class="flex justify-end">
                        <x-button type="submit" class="text-lg rounded-full">
                            Next <i class="fa-regular fa-arrow-right ml-1"></i>
                        </x-button>
                    </div>
                </form>
                @break
            @case(3)
                <form wire:key="step_3" @submit.prevent="load = true, $wire.selectSubscription()" class="flex flex-col gap-6">
                    <div>
                        @csrf
                        <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Registration Step 3</span>
                        <h2 class="font-bold mb-3 text-2xl lg:text-3xl text-slate-700">Subscription Details</h2>
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
                                <input wire:model="selected_plan.plan_id" wire:click="calculate_total()" type="radio" id="{{ $plan['id'] }}" name="plan" value="{{ $plan['id'] }}" class="hidden peer" required>
                                <label for="{{ $plan['id'] }}" class="group inline-flex flex-col gap-1.5 w-full px-5 py-3 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:text-purple-600 hover:text-slate-600 hover:bg-slate-100">
                                    <span class="font-medium text-slate-400 text-sm tracking-wider uppercase">{{ $period }}ly</span>
                                    <div class="flex items-center justify-between">
                                        <p class="leading-none">
                                            <strong class="block  text-2xl text-slate-700 font-semibold">
                                                £{{ number_format($plan['price'], 2) }}
                                                <span class="text-base text-slate-500">/ {{ $period }}</span>
                                            </strong>
                                            <span class="font-medium text-slate-400 text-sm">exc. VAT</span>
                                        </p>
                                        <i class="fa-circle-check fa-solid group-peer-checked:opacity-100 opacity-0 text-2xl text-green-500"></i>
                                    </div>
                                    @if($plan['trialPeriod'])
                                        <p>
                                            <span class="inline-block bg-green-100 capitalize font-semibold px-2 py-1 rounded text-green-500 text-sm">
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
                                    <b>Discount Code:</b>
                                    <div>
                                        <x-input wire:keyup="checkDiscount" wire:model="discount_code" class="ml-2 w-1/4" type="text" />
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
                                        <strong class="text-slate-600 font-semibold">{{ $plans[ $selected_plan['plan_id'] ]['name'] }}</strong><br>
                                        <span class="text-slate-400">{{ $plans[ $selected_plan['plan_id'] ]['description'] }}</span>
                                    </p>
                                    <p class="col-span-4 lg:col-span-2 leading-tight">
                                        <strong class="text-slate-600 font-semibold">£{{ number_format($plans[ $selected_plan['plan_id'] ]['price'], 2) }}</strong><br>
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
                                            <strong class="text-slate-600 font-semibold">£{{ number_format($addon['amount'], 2) }}</strong><br>
                                            <span class="text-slate-400">per {{ $period }}</span>
                                        </p>
                                        <p class="col-span-8 lg:col-span-2 flex items-center gap-2">
                                            <label for="addons[{{ $addon['id'] }}][quantity]" class="text-slate-600 font-semibold">Qty:</label>
                                            <input oninput="this.value = Math.abs(this.value)" wire:model="selected_plan.addons.{{ $addon['id'] }}.quantity" wire:change="calculate_total()" type="number" min="0" step="1" id="addons[{{ $addon['id'] }}][quantity]" name="addons[{{ $addon['id'] }}][quantity]"  class="w-full border-slate-300 text-slate-600 shadow-sm rounded" />
                                        </p>
                                        <p class="hidden lg:block col-span-2 text-slate-600 font-semibold">
                                            @if(!empty($selected_plan['addons'][$addon['id']]) && !empty($selected_plan['addons'][$addon['id']]['quantity']))
                                                £{{ number_format($addon['amount'] * $selected_plan['addons'][$addon['id']]['quantity'], 2) }}
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
                        <x-button @click="$wire.set('step', 2)" format="wire" type="button" class="text-lg rounded-full">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                        </x-button>
                            <?php /*
                        <x-button wire:click="$set('step', 2)" format="wire" type="button" class="text-lg rounded-full">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                        </x-button>*/?>
                        @if(!empty($selected_plan['plan_id']))
                            <x-button type="submit" class="text-lg rounded-full">
                                Next <i class="fa-regular fa-arrow-right ml-1"></i>
                            </x-button>
                        @endif
                    </div>
                </form>
                @break
            @case(4)
                <form wire:key="step_4" @submit.prevent="load = true, $wire.company_billing()" class="space-y-6">
                    <div>
                        @csrf
                        <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Registration Step 4</span>
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
                            <x-input wire:model="billing.streetAddress" name="streetAddress" id="streetAddress" type="text" required />
                            <x-input-error :messages="$errors->get('billing.streetAddress')" class="mt-2" />
                        </p>
                        <p class="col-span-1">
                            <x-label for="extendedAddress">Address Line 2</x-label>
                            <x-input wire:model="billing.extendedAddress" name="extendedAddress" id="extendedAddress" type="text" />
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
                        <x-button wire:click="$set('step', 3)" format="wire" type="button" class="text-lg rounded-full">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                        </x-button>
                        <x-button type="submit" class="text-lg rounded-full">
                            Next <i class="fa-regular fa-arrow-right ml-1"></i>
                        </x-button>
                    </div>
                </form>
                @break
            @case(5)
                <div class="space-y-6">
                    <div>
                        <span class="font-semibold text-lg text-slate-400 text-sm tracking-wider uppercase">Registration Step 4</span>
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
                        <x-button @click="$wire.set('step', 4)" format="wire" type="button" class="text-lg rounded-full">
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
    </section>

    <!-- includes the Braintree JS client SDK -->
    <script wire:ignore src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>

</div>
