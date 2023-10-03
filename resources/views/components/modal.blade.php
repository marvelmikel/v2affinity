@props([ 'target' => false ])
<div x-data="
    {
        open: false,
        close() {
            Livewire.emit('closeModal')
        },
        attachEvent(){
            @if($target)
                window.addEventListener('modal:{{ $target }}', (e) => {
                    this.open = true
                })
            @endif
        }
    }" x-init="attachEvent()" @close-modal.window="open = false">
    @if(!empty($trigger))
        <span @click="open = !open">
            {{ $trigger }}
        </span>
    @endif
    <aside x-cloak x-show.transition.opacity.duration.500ms="open" x-transition:enter="transform ease-out duration-300 transition" class="fixed flex h-full items-center justify-center left-0 top-0 w-full z-50">
        <div x-on:click="close(), open = false" class="absolute top-0 left-0 w-full h-full bg-black/25 cursor-pointer"></div>
        <div class="bg-white p-5 sm:rounded-xl h-full sm:h-auto w-full sm:w-2/3 md:w-1/2 xl:w-1/3 max-w-xl z-0 animate-enter">
			<span @click="close(), open = false" class="absolute cursor-pointer text-2xl leading-none p-3 right-2 text-slate-400 hover:text-red-500 top-1">
				<i class="far fa-times"></i>
			</span>
            {{ $content }}
        </div>
    </aside>
</div>
