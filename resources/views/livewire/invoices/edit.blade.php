<div>
    <div class="flex">
        <div style="width: 50%; padding: 8px">
            Name
        </div>
        <div style="width: 25%; padding: 8px">
            Value
        </div>
        <div style="width: 25%; padding: 8px">
            Identifier
        </div>
    </div>

    @foreach($pricings as $key => $pricing)
    <div class="flex">
        @if($pricing['name'] != 'subtotal')
            <div style="width: 50%; padding: 8px">
                <input wire:model="pricings.{{ $key }}.name" disabled readonly class="form-control" type="text">
            </div>
            <div style="width: 25%; padding: 8px">
                @php
                    $defaultTaxValue = $pricing['name'] === 'tax' ? 20 : $pricing['value'];
                @endphp
                <input wire:ignore onkeyup="updatePricing({{ $key }})" id="pricing_{{ $key }}" class="form-control" type="number" max="100" min="0" step="any" value="{{ (in_array($pricing['name'], ['tax', 'discount']) && $this->subtotal ? round(($pricing['value'] / $this->subtotal) * 100) : $defaultTaxValue) }}" placeholder="{{ ucfirst($pricing['name']) }} %">
            </div>
            <div style="width: 25%; padding: 8px">
                <input wire:model="pricings.{{ $key }}.identifier" readonly style="background-color: white;" class="form-control" type="text">
            </div>
        @else
            <div style="width: 50%; padding: 8px">
                <input wire:model="pricings.{{ $key }}.name" disabled readonly class="form-control" type="text">
            </div>
            <div style="width: 25%; padding: 8px">
                <input wire:model="pricings.{{ $key }}.value" readonly class="form-control" type="text">
            </div>
            <div style="width: 25%; padding: 8px">
                <input wire:model="pricings.{{ $key }}.identifier" readonly style="background-color: white;" class="form-control" type="text">
            </div>
        @endif
    </div>
@endforeach


    <!-- Formula here -->
    @if(auth()->user()->role_id == 1)
        <div class="flex">
            <div style="width: 50%; padding: 8px">
                <input disabled readonly class="form-control" type="text" value="formular">
            </div>
            <div style="width: 25%; padding: 8px">
                <input wire:model="formula.value" wire:change="updateFormula('{{ $formula['id'] }}')" class="form-control" type="text">
            </div>
            <div style="width: 25%; padding: 8px">
                <input wire:model="formula.identifier" readonly style="background-color: white;" class="form-control" type="text">
            </div>
        </div>
    @endif

    <div class="flex">
        <div style="width: 50%; padding: 8px">
            <input readonly class="form-control" type="text" value="Amount £">
        </div>
        <div style="width: 50%; padding: 8px">
            <input readonly style="background-color: white;" class="form-control" type="text" value="{{ number_format($invoice->total, 2) }}">
        </div>
    </div>

    <tr>
        <td colspan="3">
            <a href="#" data-invoiceid="{{ $invoice->id  }}" class="btn btn-secondary btn-xs add-pricing-column-btn">
                <i class="voyager-plus"></i>
                Add Pricing Item Cost
            </a>
        </td>
    </tr>

    <tr>
        <td>
            <!-- <button type="submit" class="btn btn-success"><i class="voyager"></i>Save Invoice</button> -->
            <a style="text-decoration: none;" href="{{ route('voyager.invoices.show', $invoice->id) }}" class="btn btn-primary">
                <i class="voyager"></i>
                Preview Invoice
            </a>
            <a style="text-decoration: none;" target="_blank" href="{{ route('voyager.invoices.pdf', $invoice->id) }}" class="btn btn-primary">
                <i class="voyager"></i>
                Invoice PDF
            </a>
        </td>
    </tr>



    <script>
        function updatePricing(id) {
            @this.updatePricing(id, $('#pricing_' + id).val());
        }
    </script>
</div>
