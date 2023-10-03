<x-app-layout>

    {{-- Landing Section --}}
    <section x-data="{}" class="w-full bg-secondary-color">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex flex-wrap lg:flex-nowrap">
            <article class="w-full lg:w-1/2 py-12 lg:py-24 text-center lg:text-start">
                <h1 class="text-3xl font-bold text-[#372152] livvic-font-bold mb-5 tracking-wide">Accelerate your Carpet Stores<br>Invoice Processing with <span class="text-main-color">Affinity</span></h1>
                <p class="livvic-font-medium text-custom-purple-color mb-5 p-0 lg:pr-12 text-lg">Affinity is a quoting and invoicing software that streamlines the billing process for businesses with real-time cost calculation and eliminates human error. It has a user-friendly interface and advanced features, making it suitable for businesses of all sizes. Say goodbye to manual invoicing hassle with Affinity.</p>
                <div class="w-full flex flex-col md:flex-row lg:pr-20">
                    <div class="w-full md:w-1/2">
                        <x-home-main-btn @click="$dispatch('modal:demo')" class="px-6 py-1 mb-3 md:mb-0">
                            Book My Demo
                        </x-home-main-btn>
                    </div>
                    <div class="w-full md:w-1/2">
                        <x-home-secondary-btn @click="$dispatch('modal:pricing')" type="button" class="px-9 py-1">
                            View Pricing
                        </x-home-secondary-btn>
                    </div>
                </div>
            </article>
            <figure>
                <img src="{{asset('images/hero-app.png')}}" alt="Hero_img" class="w-full">
            </figure>
        </div>
    </section>

    <div class="w-full lg:absolute -z-10">
        <img src="{{asset('images/swoosh.svg')}}" class="w-full h-24 lg:h-48">
    </div>

    {{-- intro Section --}}
    <section class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex flex-wrap lg:flex-nowrap items-center gap-12">
            <div class="w-full lg:w-1/2 space-y-4 text-lg text-slate-500 font-medium livvic-font-medium">
                <h2 class="font-bold livvic-font-bold mb-3 text-3xl text-slate-700">Ensure that every m<sup>2</sup> counts</h2>
                <p>Affinity is a quotation and invoicing software for flooring businesses, allowing sales team to create invoices on the shop floor. It streamlines the billing process, saves time, and has advanced features and a user-friendly interface. Choose Affinity for a smarter invoicing solution.</p>
                <x-home-flex-col class="px-0 text-base mt-8">
                    @livewire('list-with-icon', ['title' => "Automatic Price Calculation", "description"=>"Enter your fitting costs and price per m2 and the system will take  care of the test. No more manual calculations.", "icon"=>"fa-regular fa-calculator"])
                    @livewire('list-with-icon', ['title' => "Invoice Generation", "description"=>"Generate customer invoices in 1 click, network print or send directly to the customer email address", "icon"=>"fa-regular fa-file-invoice"])
                    @livewire('list-with-icon', ['title' => "Focus on sales not spread", "description"=>"cut down the time managing sales manually and put the time back in to selling.", "icon"=>"fa-solid fa-chart-line-up"])
                </x-home-flex-col>
            </div>
            <figure class="w-full lg:w-1/2">
                <img src="{{asset('images/mockup.png')}}" alt="mockup_img" />
            </figure>
        </div>
    </section>

    {{-- 3 Section --}}
    <section class="w-full pb-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex">
            <div class="w-full relative">
                <div class="w-full flex justify-center lg:justify-start">
                    <div class="w-5/12 flex justify-center z-10">
                        <img src="{{asset('images/iphone-mockup.png')}}" class="w-full lg:w-1/2">
                    </div>
                </div>
                <div class="w-full lg:flex bg-gradient-to-b from-main-color to-custom2-purple-color rounded-3xl lg:absolute lg:bottom-0 z-0">
                    <div class="w-full lg:w-4/12"></div>
                    <div class="w-full lg:w-8/12 text-white p-8 lg:p-20">
                        <div class="w-full text-2xl mb-3">
                            <i class="fa-regular fa-desktop mr-3"></i>
                            <i class="fa-regular fa-tablet-screen-button mr-3"></i>
                            <i class="fa-regular fa-mobile-notch"></i>
                        </div>
                        <h2 class="font-bold livvic-font-bold mb-3 text-3xl">Build to work across devices</h2>
                        <p class="text-lg font-medium livvic-font-medium text-slate-200">Affinity is quotation and invoicing software that works seamlessly across all devices. Whether you're on your desktop computer, laptop, tablet, or smartphone, Affinity provides you with the flexibility to manage your billing process from anywhere. This cutting-edge software is designed to simplify the invoicing process and streamline your workflow. With its user-friendly interface and advanced features, Affinity is the ideal solution for businesses of all sizes. Say goodbye to the hassle and frustration of manual invoicing and hello to a smarter, more efficient process with Affinity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4 section
    <section class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex flex-wrap lg:flex-nowrap items-center gap-12">
            <div class="w-full lg:w-1/3 space-y-4 text-lg text-slate-500 font-medium livvic-font-medium">
                <h2 class="w-full font-bold text-3xl mb-3 livvic-font-bold text-gray-700 text-center lg:text-start">You're in good company</h2>
                <p class="w-full text-slate-400 font-medium livvic-font-medium text-center text-lg lg:text-start">Affinity is used by some of the largest carpet distributors in the UK. But don't listen to us, see what our customer have to say.</p>
            </div>
            <figure class="bg-img lg:w-2/3 px-4 md:px-0 md:pr-16 py-20 rounded-3xl w-full relative">
                <div class="w-full">
                    <div class="text-custom2-purple-color opacity-25 flex absolute text-7xl lg:text-8xl right-8 top-1 lg:right-14 lg:top-4 z-0">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>
                </div>
                @livewire('review-card')
            </figure>
        </div>
    </section>
    --}}

    {{-- 5 Section
    <x-home-flex-col class="bg-[#F1F5F9] mb-8 py-10">

        <div class="w-full text-gray-700 font-bold text-2xl livvic-font-bold pt-4 text-center px-10 mb-4">

            Investing in invoice processing pays off

        </div>

        <div class="w-full flex justify-center py-2">

            <div class="w-full grid grid-cols-2 gap-1 lg:flex livvic-font-bold justify-center">

                @livewire('persentage-count',['count'=>'123%','detail'=>'static detail'])
                @livewire('persentage-count',['count'=>'80k','detail'=>'static detail'])
                @livewire('persentage-count',['count'=>'82%','detail'=>'static detail'])
                @livewire('persentage-count',['count'=>'26%','detail'=>'static detail'])

            </div>

        </div>

    </x-home-flex-col>
     --}}

    {{-- 6 section --}}
    <section class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl">
            <div class="w-full flex flex-col text-center mb-12">
                <h3 class="w-full font-bold text-2xl mb-3 livvic-font-bold text-slate-700 mb-3">Frequently Asked Questions</h3>
                <p class="w-full text-slate-400 font-medium livvic-font-medium text-lg">Get in touch now if you have any futer questions on Affinity</p>
            </div>
            <x-home-faq-section id="faq_section">
                @livewire('faq',['faq_id'=>'faq1','question'=>'What is Affinity ?','answer'=>'Affinity is an all-in-one flooring cost calculator, saving you time and money. The system can be used on any device that has access to the internet.','expanded'=>'show'])
                @livewire('faq',['faq_id'=>'faq2','question'=>'Is there trial period?','answer'=>'Yes, there is a 7 day, no obligation trial period.'])
                @livewire('faq',['faq_id'=>'faq3','question'=>'Is there a cancellation policy?','answer'=>'We simply require 30 days cancellation notice.'])
                @livewire('faq',['faq_id'=>'faq4','question'=>'How much does it cost?','answer'=>'The system costs £125 plus VAT per store. No hidden costs and you can have up to 5 users per stope. We can add further users upon request.'])
            </x-home-faq-section>
        </div>
    </section>

    {{-- 7 section --}}
    <section x-data="{}" class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 2xl:max-w-screen-2xl xl:max-w-screen-xl flex">
            <div class="mx-auto flex bg-slate-700 justify-center p-16 rounded-3xl w-full">
                <div class="w-full md:w-1/2 text-center text-white">
                    <h3 class="font-bold livvic-font-bold mb-3 text-3xl">Let's get started</h3>
                    <p class="text-lg mb-5 font-medium livvic-font-medium">Simply Call LogicBarn (the creator of Affinity) on 0303 223 0110 and choose the option 1for Sales. Thank you. www.logicbarn.com.</p>
                    <button @click="$dispatch('modal:contact')" type="button" class="rounded border border-2 border-white px-4 py-2 font-semibold livvic-font-semibold text-lg hover:bg-white hover:text-main-color transition">Get Started</button>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
