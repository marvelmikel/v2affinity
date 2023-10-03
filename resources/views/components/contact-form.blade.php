@props([
    'postTo' => 'contact.form',
    'title' => 'Contact Us',
    'description' => 'Fill in your details and our sales representative will be in touch shortly.'
])
<form method="POST" action="/" class="font-normal livvic-font-regular text-slate-500">
    @csrf
    <h2 class="w-full livvic-font-semibold font-semibold text-slate-700 text-2xl mb-3">{{ $title }}</h2>
    <p class="text-lg">{{ $description }}</p>
    <fieldset class="my-4 space-y-4">
        <div>
            <x-input-label for="name" :value="__('Name')" required="true" />
            <x-text-input id="name" class="block mt-1 w-full"
                          type="text"
                          name="name"
                          required
                          autocomplete="name" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email Address')" required="true" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email"
                          name="email"
                          required
                          autocomplete="email" />
        </div>
        <div>
            <x-input-label for="tel" :value="__('Contact Number')" required="true" />
            <x-text-input id="tel" class="block mt-1 w-full"
                          type="tel"
                          name="tel"
                          autocomplete="tel" />
        </div>
        <div>
            <x-input-label for="message" :value="__('Message')" />
            <textarea name="message"
                      id="message"
                      class="h-24 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md"
                      placeholder="If you would like a demo of the affinity software or would like a meeting to discuss the product, please include any dates or times that work well for you."></textarea>
        </div>
    </fieldset>
    <p class="text-center">
        <x-home-main-btn type="submit" class="px-6 py-1 mb-3 md:mb-0">Submit Form</x-home-main-btn>
    </p>
</form>
