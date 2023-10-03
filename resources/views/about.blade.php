<x-app-layout>

    {{-- Landing Section --}}
    <section x-data="{}" class="w-full bg-secondary-color">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex flex-wrap lg:flex-nowrap">
            <article class="w-full lg:w-1/2 py-12 lg:py-24 text-center lg:text-start">
                <h1 class="text-3xl font-bold text-[#372152] livvic-font-bold mb-5 tracking-wide"><span class="text-main-color">Affinity</span> is a cutting-edge software designed to revolutionise the way carpet and flooring stores process quotes/invoices.</h1>
                <p class="livvic-font-medium text-custom-purple-color mb-5 p-0 lg:pr-12 text-lg">With Affinity, you can streamline your invoice processing, saving you time and resources while increasing efficiency.</p>
                <p class="livvic-font-medium text-custom-purple-color mb-5 p-0 lg:pr-12 text-lg">The software's user-friendly interface and advanced features allow you to quickly and easily manage your invoices, from receipt to payment.</p>
                <div class="w-full flex flex-col md:flex-row lg:pr-20">
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
                <h2 class="font-bold livvic-font-bold mb-3 text-3xl text-slate-700">Put the focus on sales, not admin</h2>
                <p>With Affinity, you can accelerate your invoice processing, freeing up time for you to focus on growing your business.</p>
                <p>Whether you are a small carpet store or a large enterprise, Affinity has everything you need to streamline your quoting and invoicing process.</p>
                <p>Take your business to the next level with Affinity.</p>
            </div>
            <figure class="w-full lg:w-1/2">
                <img src="{{asset('images/mockup.png')}}" alt="mockup_img" />
            </figure>
        </div>
    </section>

    <section x-data="{}" class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex">
            <div class="mx-auto flex bg-gradient-to-b from-main-color justify-center p-16 rounded-3xl to-custom2-purple-color w-full">
                <div class="w-full md:w-1/2 text-center text-white">
                    <h3 class="font-bold livvic-font-bold mb-3 text-3xl">What are you waiting for?</h3>
                    <p class="text-lg mb-5 font-medium livvic-font-medium">Try Affinity today, with a no obligation 7 day trial and experience the benefits of faster, more efficient invoice processing. You'll find you have more time to sell your products and have far less administration.</p>
                    <button @click="$dispatch('modal:contact')" type="button" class="rounded border border-2 border-white px-4 py-2 font-semibold livvic-font-semibold text-lg hover:bg-white hover:text-main-color transition">Get Started</button>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
