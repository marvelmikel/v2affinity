<nav x-data="{}" class="
  relative
  w-full
  flex flex-wrap
  items-center
  justify-between
  py-4
  bg-white
  text-gray-700
  hover:text-gray-700
  focus:text-gray-700
  navbar navbar-expand-lg navbar-light
  ">
  <div class="container-fluid w-full flex flex-wrap items-center justify-center lg:justify-between px-6">
    <button class="
      absolute
      left-2
      float-left
      navbar-toggler
      text-gray-500
      border-0
      hover:shadow-none hover:no-underline
      py-2
      px-2.5
      bg-transparent
      focus:outline-none focus:ring-0 focus:shadow-none focus:no-underline
    " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="w-6" role="img"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path fill="currentColor"
          d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
        </path>
      </svg>
    </button>
      <a class=" ml-5
      flex
      justify-self-center
      items-center
      hover:text-gray-900
      focus:text-gray-900
      lg:mt-2
      lg:mt-0
      text-main-color
      livvic-font-bold
      text-xl
      lg:text-2xl
      lg:ml-16
    " href="#">
      <img src="{{asset('images/logo.png')}}" width="50px">
    </a>
    <div class="collapse navbar-collapse flex-grow items-center" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav flex flex-col pl-0 list-style-none mr-auto livvic-font-bold">
        <li class="nav-item p-2">
          <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="#">About</a>
        </li>
        <li class="nav-item p-2">
            <button class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" type="button" @click="$dispatch('modal:pricing')">Pricing</button>
        </li>
        <li class="nav-item p-2">
            <x-modal target="contact">
                <x-slot:trigger>
                    <button class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" type="button">Contact</button>
                </x-slot:trigger>
                <x-slot:content>
                    <x-contact-form />
                </x-slot:content>
            </x-modal>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    {{-- Offcanvas --}}
    <div class="z-20 lg:hidden offcanvas offcanvas-start fixed bottom-0 flex flex-col max-w-[70%] bg-white invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 left-0 border-none w-96" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header flex items-center justify-between p-4">
        <button type="button" class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body flex-grow p-4 overflow-y-auto">

        {{-- off canvas body --}}
        <div class="flex-grow items-center justify-center mb-5 lg:mb-0" id="navbarSupportedContent">
          <a class="
            flex
            items-center
            justify-center
            hover:text-gray-900
            focus:text-gray-900
            mt-2
            lg:mt-0
            mr-1
            text-main-color
            livvic-font-bold
            text-xl
            lg:text-2xl
            ml-2
            lg:ml-16
          " href="#">
           <img src="{{asset('images/logo.png')}}" width="50px">
          </a>
          <!-- Left links -->
          <ul class="navbar-nav flex flex-col pl-0 list-style-none mr-auto livvic-font-bold text-center">
            <li class="nav-item p-2">
              <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/">About</a>
            </li>
            <li class="nav-item p-2">
              <button @click="$dispatch('modal:pricing')" class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0">Pricing</button>
            </li>
            <li class="nav-item p-2">
                <x-modal target="contact">
                    <x-slot:trigger>
                        <button class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" type="button">Contact</button>
                    </x-slot:trigger>
                    <x-slot:content>
                        <x-contact-form />
                    </x-slot:content>
                </x-modal>
            </li>
          </ul>
          <!-- Left links -->
        </div>
        <div class="flex flex-col px-6">
            {{--  <x-home-secondary-btn class="py-1 mb-3">
               Login
             </x-home-secondary-btn> --}}
             <x-home-main-btn @click="$dispatch('modal:demo')" class="py-1">
               Get Started
             </x-home-main-btn>
           </div>
           {{-- off canvas body --}}
      </div>
    </div>
    {{-- Offcanvas --}}

    <!-- Right elements -->
    <div class="hidden lg:flex items-center relative py-">

        {{--
        <x-home-secondary-btn class="px-5 py-1 mr-3">
          Login
        </x-home-secondary-btn>
        --}}
        <x-home-main-btn @click="$dispatch('modal:demo')" class="px-5 py-1">
          Get&nbsp;Started
        </x-home-main-btn>

    </div>
    <!-- Right elements -->
  </div>
</nav>
