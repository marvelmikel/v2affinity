<span>
    @if($store && isset($store->emailSettings()->is_enabled ) && $store->emailSettings()->is_enabled)
        <div>
        <a wire:click.prevent="emailInvoice" style="text-decoration: none; display: flex;background-color:#C82090;" class="btn @if($sent) btn-success @else btn-primary @endif">
            <i class="voyager"></i>Email Invoice
            @if($sent)
                <lord-icon
                    src="https://cdn.lordicon.com/oqdmuxru.json"
                    trigger="in"
                    delay="500"
                    state="in-check"
                    colors="primary:#ffffff"
                    style="width:20px; height:20px; margin-left: 5px">
                </lord-icon>
            @endif
        </a>
    </div>
    @endif
</span>
