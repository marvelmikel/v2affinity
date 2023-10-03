<div class="w-full flex flex-col md:flex-row gap-4 relative bg-white p-1 py-3 lg:p-4 rounded-xl shadow-2xl z-10">

        <div class="w-full md:w-3/12 md:border-r-2 p-5 md:p-1 md:px-2 flex justify-center items-center">
            <img src="{{$img_url}}" alt="HPLogo" class="w-28 lg:w-36">
        </div>

        <div class="w-full md:w-9/12 flex flex-col p-2 px-4">

            <div class="w-full mb-3 text-[#FBBF24]">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>

            <div class="mb-3 text-gray-400 text-slate-400 w-full">
                {{$description}}
            </div>

            <div class="w-full text-slate-700 text-lg font-semibold livvic-font-semibold">
                {{$designation}}
            </div>

        </div>

</div>
