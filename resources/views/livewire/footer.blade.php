

<x-home-flex x-data="{}" class="w-full p-10 px-10 bg-[#F5F8FB]">

    <x-home-flex class="w-full">
        <div class="w-full lg:w-4/12">
            <div class="w-full text-main-color text-2xl livvic-font-bold font-bold mb-3">
                <a href="/"><img src="{{asset('images/logo-2.svg')}}" alt="Affinity"></a>
            </div>
            <div class="w-full text-gray-400 mb-5">
                Affinity is a Brand name of Gold Crest Trading Ltd, trading as LogicBarn.
            </div>
            <div class="w-full text-gray-400 mb-5">
                &#169; {{ date('Y') }} Affinity
            </div>
        </div>
        <div class="w-full lg:w-4/12 lg:px-8 flex mb-5 lg:mb-0">
            <div class="w-1/2 mr-8">
                <ul class="text-gray-600">
                    <li><a href="#" class="text-main-color">Company</a></li>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><button @click="$dispatch('modal:pricing')">Pricing</button></li>
                   </ul>
            </div>
            <div class="w-1/2">
                <ul class="text-gray-600">
                    {{--
                        <li><a href="#" class="text-main-color">Useful Links</a></li>
                        <li><a href="#">Privacy policy</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Sitemap</a></li>
                    --}}
                    <li><a href="#" class="text-main-color">Useful Links</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><button type="button" @click="$dispatch('modal:contact')">Contact</button></li>
                </ul>
            </div>

        </div>
        <div class="w-full lg:w-4/12 flex flex-col lg:px-16">

            <div class="w-full text-gray-400">
                Call us at
            </div>

            <div class="w-full text-2xl text-gray-700 font-bold mb-3">
                <a href="tel:03032230110">0303 223 0110</a>
            </div>

            <div class="text-main-color text-lg">
                <a href="https://www.instagram.com/logic_barn" target="_blank"><i class="fa-brands fa-instagram mr-3"></i></a>
                <a href="https://www.linkedin.com/company/logicbarn" target="_blank"><i class="fa-brands fa-linkedin-in mr-3"></i></a>
                <a href="https://www.facebook.com/logicbarn" target="_blank"><i class="fa-brands fa-facebook mr-3"></i></a>
                <a href="https://www.youtube.com/@logicbarn3468" target="_blank"><i class="fa-brands fa-youtube mr-3"></i></a>
            </div>
        </div>
    </x-home-flex>

</x-home-flex>

<br>
<br>
<br>
<br>
<br>

<footer class="w-full py-16 bg-slate-100">
    <div class="mx-auto px-4 max-w-screen-2xl w-full flex">

        <div class="w-full lg:w-4/12">
            <div class="w-full text-main-color text-2xl livvic-font-bold font-bold mb-3">
                <a href="/"><img src="{{asset('images/logo-2.svg')}}" alt="Affinity"></a>
            </div>
            <div class="w-full text-gray-400 mb-5">
                Affinity is a Brand name of Gold Crest Trading Ltd, trading as LogicBarn.
            </div>
            <div class="w-full text-gray-400 mb-5">
                &#169; {{ date('Y') }} Affinity
            </div>
        </div>


    </div>
</footer>

