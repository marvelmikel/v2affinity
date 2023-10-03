<header x-data="{ isOpen: false }" @keydown.escape="isOpen = false" class="w-full fixed z-20 top-0 py-5 bg-white transition transition-all duration-200 shadow lg:h-auto"  :class="{ 'shadow-lg h-screen' : isOpen, 'h-20' : !isOpen }">
    <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex flex-wrap items-center gap-6">

        <!--Logo etc-->
        <figure class="flex flex-shrink-0 gap-6 items-start">
            <a class="no-underline hover:text-white hover:no-underline" href="{{ route('home') }}">
                <img src="{{asset('images/logo-2.svg')}}" alt="Affinity" class="h-9">
            </a>
            <span class="leading-none livvic-font-medium text-3xl text-slate-300 mt-0.5">/</span>
        </figure>

        <!--Toggle button (hidden on large screens)-->
        <div class="flex flex-grow lg:flex-grow-0 justify-end">
            <button @click="isOpen = !isOpen" type="button" class="block lg:hidden px-2 text-slate-400 hover:text-slate-600 focus:outline-none focus:text-slate-600" :class="{ 'transition transform-180': isOpen }">
                <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                </svg>
            </button>
        </div>

        <nav class="flex flex-col lg:flex-row gap-6 justify-between w-full flex-grow lg:items-center lg:w-auto" :class="{ 'block': isOpen, 'hidden lg:flex': !isOpen }">

            <!--Site Menu-->
            <ul class="pt-6 lg:pt-0 list-reset lg:flex flex-1 gap-6 items-center font-semibold livvic-font-semibold space-y-4 lg:space-y-0 text-center lg:text-left text-lg lg:text-base">
                <li>
                    <a @click="isOpen = false" class="text-slate-500 hover:text-slate-700 focus:text-slate-700 p-0" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a @click="isOpen = false" class="text-slate-500 hover:text-slate-700 focus:text-slate-700 p-0" href="{{ route('about') }}">About</a>
                </li>
                <li>
                    <button @click="$dispatch('modal:pricing')" class="text-slate-500 hover:text-slate-700 focus:text-slate-700 p-0">
                        Pricing
                    </button>
                </li>
                <li>
                    <button @click="$dispatch('modal:contact')" class="text-slate-500 hover:text-slate-700 focus:text-slate-700 p-0">
                        Contact
                    </button>
                </li>
            </ul>

            <!--Account Menu-->
            <ul class="text-center lg:text-right flex flex-col lg:flex-row gap-6">
                @if(auth()->user())
                    <li>
                        <a href="{{ route('voyager.profile') }}" class="block border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5">
                            My Account
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('voyager.login') }}" class="block border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5">
                            Log In
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subscription.create') }}" class="block border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:opacity-75 duration-300 px-5 py-1.5 livvic-font-semibold">
                            Get Started
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <x-modal target="contact">
        <x-slot:content>
            <x-contact-form />
        </x-slot:content>
    </x-modal>

    <x-modal target="demo">
        <x-slot:content>
            <x-contact-form title="Book Your Demo" description="Fill in your details and our sales representative will be in touch shortly to arrange a demo of the system." postTo="contact.demo" />
        </x-slot:content>
    </x-modal>

    <x-modal target="pricing">
        <x-slot:content>
            <h2 class="w-full livvic-font-semibold font-semibold text-slate-700 text-2xl mb-3">Our Pricing</h2>
            <div class="bg-slate-700 text-white rounded-lg">
                <header class="bg-blue-400 font-semibold livvic-font-semibold py-1 rounded-t-lg text-center uppercase">Most Popular</header>
                <div class="p-6 flex flex-col gap-6 items-center">
                    <div class="text-center">
                        <strong class="block text-4xl font-bold livvic-font-bold">£125 <span class="text-sm text-slate-300 livvic-font-regular font-normal">exc VAT</span></strong>
                        <span>per month</span>
                    </div>
                    <ul class="text-lg font-medium livvic-font-medium space-y-2">
                        <li>
                            <i class="far fa-check text-green-500 mr-1"></i>
                            7 day trial period
                        </li>
                        <li>
                            <i class="far fa-check text-green-500 mr-1"></i>
                            5 users per store
                        </li>
                        <li>
                            <i class="far fa-check text-green-500 mr-1"></i>
                            Further users can be added on request
                        </li>
                        <li>
                            <i class="far fa-check text-green-500 mr-1"></i>
                            Automatic Price Calculation
                        </li>
                        <li>
                            <i class="far fa-check text-green-500 mr-1"></i>
                            PDF Invoice Generation
                        </li>
                    </ul>
                    <x-home-main-btn @click="$dispatch('modal:contact'), open = false" class="px-6 py-2 mb-3 md:mb-0 text-lg">
                        Get Started
                    </x-home-main-btn>
                </div>
            </div>
        </x-slot:content>
    </x-modal>
</header>
<div class="h-20 w-full"></div>
