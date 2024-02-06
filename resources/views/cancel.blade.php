<x-app-layout>

    <section x-data="{}" class="w-full py-16">
        <div class="mx-auto px-8 sm:px-16 lg:px-4 2xl:max-w-screen-2xl xl:max-w-screen-xl flex">
            <div class="mx-auto flex bg-gradient-to-b from-main-color justify-center p-16 rounded-3xl to-custom2-purple-color w-full">
                <div class="w-full md:w-1/2 text-center text-white">
                    <h3 class="font-bold livvic-font-bold mb-3 text-3xl">Subscription Cancellation Notice</h3>
                    <p class="text-lg mb-5 font-medium livvic-font-medium">We're sorry to see you go. Your subscription has been successfully canceled, and we're grateful for the time you spent with us. If you ever wish to reactivate your subscription, please contact us for prompt assistance.
                        Your feedback is always welcome, as it helps us improve. We wish you continued success and hope to serve you again in the future. Thank you for being a part of our community.</p>
                    <button @click="$dispatch('modal:contact')" type="button" class="rounded border border-2 border-white px-4 py-2 font-semibold livvic-font-semibold text-lg hover:bg-white hover:text-main-color transition">Contact Us</button>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>