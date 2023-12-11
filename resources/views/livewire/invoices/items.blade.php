<div class="col-md-12">
    <div class="admin-section-title card" style="display:flex; justify-content: space-between;">
        <h3><i class="voyager-list"></i> {{ __('Invoice Items') }}</h3>
        <div>
            <a data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary"><i class="voyager-plus"></i>Add New Item</a>
        </div>
    </div>
    <div class="clear"></div>
    <br>

    <div class="card" style="max-height: 540px; overflow: scroll;">
        @foreach ($this->invoiceItems as $invoiceItem)
            <table class="table" style="width:100%; margin: 40px 0;">
                <tbody>
                <tr class="invoice-item-meta" style="overflow: scroll;">
                    @foreach ($invoiceItem['meta'] as $key => $meta)
                        @if($meta['name'] != 'formular')
                            <td style="min-width: 200px;" class="{{ $meta['visibility'] }}">
                                <input disabled readonly class="form-control  {{ $meta['visibility'] }} " type="text" name="{{ $meta['name'] }}[]" value="{{ $meta['title'] }}" required>
                                @switch($meta['type'])
                                    @case('formular')
                                        <input disabled readonly style="background-color: white;" class="form-control evaluated-input {{ $meta['visibility'] }}" name="{{ $meta['name'] }}[]" value="{{ evaluate_formular($meta['value'], 'InvoiceItemMeta', $invoiceItem['id'], $meta['modifier']) }}" type="{{ $meta['type'] }}" {{ $meta['visibility'] }} required>
                                        <input disabled readonly style="background-color: white;" class="form-control  {{ $meta['visibility'] }}" type="hidden" name="{{ $meta['name'] }}[]" value="{{ $meta['identifier'] }}" required>
                                        @break
                                    @case('checkbox')
                                        <input wire:ignore onclick="updateInvoiceItemScript({{ $invoiceItem['id'] }}, {{ $key }}, {{ $meta['id'] }})" id="checkbox_{{ $key }}" name="checkbox_{{ $key }}" type="checkbox" value="1" @if($meta['value']) checked @endif />
                                        <input readonly style="background-color: white" class="form-control {{ $meta['visibility'] }}" type="hidden" name="{{ $meta['name'] }}[]" value="{{ $meta['identifier'] }}" required>
                                        @break
                                    @default()
                                        <input wire:keyup="updateInvoiceItem('{{ $invoiceItem['id'] }}', '{{ $key }}', '{{ $meta['id'] }}')" wire:model="invoiceItems.{{ $invoiceItem['id'] }}.meta.{{ $key }}.value" value="{{ $meta['value'] }}" name="{{ $meta['name'] }}_{{ $meta['id'] }}" style="background-color: white" class="form-control evaluated-input {{ $meta['visibility'] }}" type="{{ $meta['type'] }}" {{ $meta['visibility'] }} required>
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
                        <a class="btn btn-sm btn-danger" wire:click.prevent="deleteInvoiceItem('{{ $invoiceItem['id'] }}')"><i class="voyager-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>

{{--
    <div class="modal modal-info fade" tabindex="-1" id="add_product_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="voyager-data"></i> Add Invoice Product</h4>
                </div>
                <div>
                    <div class="modal-body" style="overflow: scroll; min-height: 300px;">
                        <div>
                            <strong>Select Products:</strong>
                            <select id="multiple-checkboxes" name="product_ids[]" multiple="multiple">
                                @foreach ($products->where('company_id', $companyId) as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Rest of the modal body code -->
                    </div>
                    <!-- Rest of the form code -->
                    <div class="modal-footer gap-4">
                        <button type="button" class="btn btn-outline mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                        <button type="submit" class="btn btn-primary pull-right" onclick="addItemScript()">{{ __('voyager::generic.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
--}}

    <script>
        function updateInvoiceItemScript(id, key, meta) {
            @this.updateInvoiceItem(id, key, meta, $('#checkbox_' + key).is(':checked'));
        }

        function addItemScript() {
            @this.addItem($('#multiple-checkboxes').val());
        }
    </script>
</div>
