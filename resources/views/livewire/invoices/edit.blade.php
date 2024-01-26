<div>
    <div class="col-auto">
        <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
            {{--<h3><i class="voyager-list"></i> {{ __('Invoice Items') }}</h3>--}}
            <div>
                <a data-toggle="modal" data-target="#add_product_modal" style="background-color:#C82090" class="btn btn-primary"><i class="voyager-plus"></i>Add New Item</a>
            </div>
        </div>
        <div class="clear"></div>
        <br>

        <div class="card" style="max-height: 540px; display: block; overflow-x: auto; overflow-y: scroll; white-space: nowrap">
            @foreach($this->invoiceItems as $invoiceItem)
                <div wire:key="item_{{ $loop->index }}_{{ $invoiceItem['id'] }}">
                    <table class="table" style="width:100%; margin: 40px 0;">
                        <tbody>
                        <tr class="invoice-item-meta" style="overflow: scroll;">
                            @foreach ($invoiceItem['meta'] as $key => $meta)
                                @if($meta['name'] != 'formular')
                                    <td wire:key="meta_{{ $key }}_{{ $loop->index }}" style="min-width: 200px;" class="{{ $meta['visibility'] }}">
                                        <input disabled readonly class="form-control  {{ $meta['visibility'] }} " type="text" name="{{ $meta['name'] }}[]" value="{{ $meta['title'] }}" required>
                                        @switch($meta['type'])
                                            @case('formular')
                                                <input disabled readonly style="background-color: white;" class="form-control evaluated-input {{ $meta['visibility'] }}" name="{{ $meta['name'] }}[]" value="{{ evaluate_formular($meta['value'], 'InvoiceItemMeta', $invoiceItem['id'], $meta['modifier']) }}" type="{{ $meta['type'] }}" {{ $meta['visibility'] }} required>
                                                <input disabled readonly style="background-color: white;" class="form-control  {{ $meta['visibility'] }}" type="hidden" name="{{ $meta['name'] }}[]" value="{{ $meta['identifier'] }}" required>
                                                @break
                                            @case('checkbox')
                                                <input wire:ignore onclick="updateInvoiceItemScript({{ $invoiceItem['id'] }}, {{ $key }}, {{ $meta['id'] }}, true)" id="checkbox_{{ $key }}_{{ $meta['id'] }}" name="checkbox_{{ $key }}" style="margin-left:50%" type="checkbox" value="1" @if($meta['value']) checked @endif />
                                                <input readonly style="background-color: white" class="form-control {{ $meta['visibility'] }}" type="hidden" name="{{ $meta['name'] }}[]" value="{{ $meta['identifier'] }}" required>
                                                @break
                                            @default()
                                                <input wire:ignore onkeyup="updateInvoiceItemScript({{ $invoiceItem['id'] }}, {{ $key }}, {{ $meta['id'] }}, false)" id="item_{{ $key }}_{{ $meta['id'] }}" value="{{ $meta['value'] }}" name="{{ $meta['name'] }}_{{ $meta['id'] }}" style="background-color: white" class="form-control evaluated-input {{ $meta['visibility'] }}" type="{{ $meta['type'] }}" {{ $meta['visibility'] }} required>
                                                <input readonly style="background-color: white" class="form-control {{ $meta['visibility'] }}" type="hidden" name="{{ $meta['name'] }}[]" value="{{ $meta['identifier'] }}" required>
                                                @break
                                        @endswitch
                                    </td>
                                @endif
                            @endforeach

                            <!-- <td>
                                <input disabled readonly class="form-control " type="text" name="location" value="Select Room Location" required>
                                <select class="form-control" name="" id="">
                                    <option selected value=""></option>
                                </select>
                            </td> -->

                            <td style="min-width: 200px;">
                                <input disabled readonly class="form-control" type="text" value="Total Price(£)">
                                <input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format(\App\Models\InvoiceItem::find($invoiceItem['id'])?->item_total, 2) }}">
                            </td>

                            <td colspanss="3">
                                <button class="btn btn-sm btn-danger" onclick="deleteInvoiceItemScript('{{ $invoiceItem['id'] }}')"><i class="voyager-trash"></i></button>
                                 <!-- <button class="btn btn-sm btn-success" onclick="" ><i class="voyager-plus"></i></button> -->
                            </td>

                            
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

        

        <div wire:ignore class="modal modal-info fade" tabindex="-1" id="add_product_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="voyager-data"></i> Add Invoice </h4>
                    </div>
                    <div>
                        <div class="modal-body" style="overflow: scroll; min-height: 300px;">
                            <div>
                                <label for="multiple-checkboxes"><strong>Select Products:</strong></label>
                                <select id="multiple-checkboxes" multiple="multiple">
                                    @foreach($products->where('company_id', $companyId) as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer gap-4">
                            <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                            <button type="submit" class="btn btn-primary pull-right" onclick="addItemScript()">{{ __('voyager::generic.add') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="voyager-credit-card"></i> {{ __('Invoice Pricing') }}</h3>

    <div class="flex">
        <div style="width: 45%; padding: 8px">
            Name
        </div>
        <div style="width: 20%; padding: 8px">
            Value
        </div>
        <div style="width: 15%; padding: 8px">
            Type
        </div>
        <!-- <div style="width: 20%; padding: 8px">
            Identifier
        </div> -->
    </div>

    @foreach($pricings as $key => $pricing)
        <div wire:key="pricing_{{ $key }}" class="flex">
            @if($pricing['name'] != 'subtotal')
                <div style="width: 45%; padding: 8px">
                    <input wire:model="pricings.{{ $key }}.name" disabled readonly class="form-control" type="text">
                </div>
                <div style="width: 20%; padding: 8px">
                    <input @if($pricing['name'] == 'tax') disabled @endif wire:ignore onkeyup="updatePricingScript({{ $key }})" id="pricing_{{ $key }}" class="form-control" type="number" max="100" min="0" step="any" value="{{ $pricing['value'] }}" placeholder="{{ ucfirst($pricing['name']) }} %">
                </div>
                <div style="width: 15%; padding: 8px">
                    <select @if($pricing['name'] != 'discount') disabled @endif wire:ignore onchange="updatePricingScript({{ $key }})" id="select_{{ $key }}" class="form-control" @if(in_array($pricing['name'], ['subtotal', 'tax'])) disabled @endif>
                        <option selected value="{{ $pricing['type'] }}">{{ $pricing['type'] }}</option>
                        <option value="percentage">%</option>
                        <option value="value">value(£)</option>
                    </select>
                </div>
                <!-- <div style="width: 20%; padding: 8px">
                    <input wire:model="pricings.{{ $key }}.identifier" readonly style="background-color: white;" class="form-control" type="text">
                </div> -->
            @else
                <div style="width: 45%; padding: 8px">
                    <input wire:model="pricings.{{ $key }}.name" disabled readonly class="form-control" type="text">
                </div>
                <div style="width: 20%; padding: 8px">
                    <input wire:model="subtotal" readonly class="form-control" type="text">
                </div>
                <div style="width: 15%; padding: 8px">
                    <select wire:ignore onchange="updatePricingScript({{ $key }})" id="pricing_{{ $key }}" class="form-control" disabled>
                        <option value="{{ $pricing['type'] }}">{{ $pricing['type'] }}</option>
                        <option value="percentage">%</option>
                        <option value="value">value(£)</option>
                    </select>
                </div>
                <!-- <div style="width: 20%; padding: 8px">
                    <input wire:model="pricings.{{ $key }}.identifier" readonly style="background-color: white;" class="form-control" type="text">
                </div> -->
            @endif
        </div>         
    @endforeach

    <!-- Formula here -->
    @if(auth()->user()->role_id == 1)
        <div class="flex">
            <div style="width: 45%; padding: 8px">
                <input disabled readonly class="form-control" type="text" value="formular">
            </div>
            <div style="width: 20%; padding: 8px">
                <input wire:model="formula.value" wire:change="updateFormula('{{ $formula['id'] }}')" class="form-control" type="text">
            </div>
            <div style="width: 15%; padding: 8px">
                <td>
                    <input class="form-control" type="text" name="formular[]" value="{{ $invoice->getPricing('formular')['type'] }}" disabled>
                </td>
            </div>
            <!-- <div style="width: 20%; padding: 8px">
                <input wire:model="formula.identifier" readonly style="background-color: white;" class="form-control" type="text">
            </div> -->
        </div>
    @endif

    <div class="flex">
        <div style="width: 45%; padding: 8px">
            <input readonly class="form-control" type="text" value="Amount £">
        </div>
        <div style="width: 55%; padding: 8px">
            <div wire:loading.flex>
                <input readonly style="background-color: white; color: green; font-weight: bold" class="form-control" type="text" value="Updating...">
            </div>
            <div wire:loading.remove>
                <input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format($invoice->getTotalAttribute(), 2) }}">
            </div>
        </div>
    </div>

    <tr>
        <td colspan="3">
            <a href="#" data-invoiceid="{{ $invoice->id  }}" class="btn btn-secondary btn-xs add-pricing-column-btn " style="color:#C82090">
                <i class="voyager-plus"></i>
                Add Pricing Item Cost
            </a>
        </td>
    </tr>

    <tr >
        <td>
            <div class="flex gap-2 px-4 pt-4">
                <livewire:invoices.email-pdf :invoice="$invoice" :store="$invoice->store" />
                <a style="text-decoration: none; background-color:#C82090" href="{{ route('voyager.invoices.show', $invoice->id) }}" class="btn btn-primary">
                    <i class="voyager"></i>
                    Preview Invoice
                </a>
                <a style="text-decoration: none; background-color:#C82090" target="_blank" href="{{ route('voyager.invoices.pdf', $invoice->id) }}" class="btn btn-primary">
                    <i class="voyager"></i>
                    Invoice PDF
                </a>
            </div>
        </td>
    </tr>

    <div wire:ignore class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add New Pricing</h4>
                </div>
                <div>
                    <div class="modal-body" style="overflow:scroll">
                        <div>
                            <label for="pricing_name"> Column Name </label>
                            <input required id="pricing_name" name="pricing_name" type="text" class="form-control">
                        </div>

                        <div style="margin: 10px 0;">
                            <label for="value"> Column Value </label>
                            <input required id="pricing_value" name="pricing_value" type="text" class="form-control">
                        </div>

                        <input name="pricing_visibility" id="pricing_visibility" value="visible" type="hidden" class="form-control">

                        <div>
                            <label for="operation">Select Operation</label>
                            <select required id="pricing_operation" name="pricing_operation" class="form-control">
                                <option value="+">Add</option>
                                <option value="-">Subtract</option>
                            </select>
                        </div>

                        <input type="hidden" name="invoice_id" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1 mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:opacity-75 duration-300 px-5 py-1.5 livvic-font-semibold px-6 py-1 mb-3 md:mb-0 pull-right" onclick="addPricingItemScript()">{{ __('voyager::generic.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatePricingScript(id, amount, type) {
            @this.updatePricing(id, $('#pricing_' + id).val(), $('#select_' + id).val());
        }

        function updateInvoiceItemScript(id, key, meta, checkbox) {
            if (checkbox) {
                @this.updateInvoiceItem(id, key, meta, $('#checkbox_' + key + '_' + meta).is(':checked'), null);
            } else {
                @this.updateInvoiceItem(id, key, meta, null, $('#item_' + key + '_' + meta).val());
            }

            @this.updatePricing({{ $discountPricing->id }}, $('#pricing_' + {{ $discountPricing->id }}).val(), $('#select_' + {{ $discountPricing->id }}).val());
        }

        function addItemScript() {
            @this.addItem($('#multiple-checkboxes').val());
        }

        function addPricingItemScript() {
            @this.addPricingColumn($('#pricing_name').val(), $('#pricing_value').val(), $('#pricing_operation').val(), $('#pricing_visibility').val());
        }

        function deleteInvoiceItemScript(id) {
            @this.deleteInvoiceItem(id, $('#pricing_' + {{ $discountPricing->id }}).val(), $('#select_' + {{ $discountPricing->id }}).val());
        }

        window.addEventListener('closeProductModal', event => {
            $("#add_product_modal").modal('hide');
        })

        window.addEventListener('closePricingModal', event => {
            $("#add_pricing_column_modal").modal('hide');
        })
    </script>
</div>
