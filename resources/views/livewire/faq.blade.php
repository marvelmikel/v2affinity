<div x-data="{ open: false }" class="accordion-item bg-white border-y border-gray-200">
    <h2 class="accordion-header mb-0 livvic-font-medium font-bold" id="faq_label_{{ $faq_id }}">
        <button x-on:click="open = ! open" class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none" type="button">
            {{$question}}
        </button>
    </h2>
    <div x-show="open" x-transition id="{{$faq_id}}" aria-labelledby="faq_label_{{$faq_id}}">
        <div class="accordion-body py-4 px-5">
            {{$answer}}
        </div>
    </div>
</div>
