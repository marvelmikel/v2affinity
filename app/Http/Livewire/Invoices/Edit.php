<?php

namespace App\Http\Livewire\Invoices;

use App\Http\Controllers\InvoiceController;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceItemMeta;
use App\Models\InvoicePricing;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public $invoice, $subtotal, $formula, $invoiceItems, $products, $companyId, $discountPricing, $discount_id;
    public $pricings = [];
    public $pricing_item = [
        'name' => '',
        'value' => '',
        'operation' => '',
        'visibility' => 'visible',
    ];

    public function deleteInvoiceItem($id, $value, $type)
    {
        // Find and delete Invoice Item
        if ($invoiceItem = InvoiceItem::find($id)) {
            $invoiceItem->delete();
            unset($this->invoiceItems[$id]);
        }

        // Recalculate invoice subtotal here whenever an item is deleted
        $this->updatePricing($this->discountPricing->id, $value, $type);
        $this->getSubtotal();
    }

    public function calculateAllowance($invoiceItem, $addAllowance)
    {
        // Add or remove allowance value
        if ($addAllowance) {
            $invoiceItem->getMeta('allowance')->update(['value' => $invoiceItem->getMeta('default_allowance')->value]);
        } else {
            $invoiceItem->getMeta('allowance')->update(['value' => 0]);
        }
    }

    public function updateInvoiceItem($id, $key, $meta, $checkbox = null, $value = null)
    {
        $invoiceItem = InvoiceItem::find($id);
        $invoiceItemMeta = InvoiceItemMeta::find($meta);

        if ($invoiceItemMeta->name == 'add_allowance') {
            $value = $checkbox;
            $this->calculateAllowance($invoiceItem, $checkbox);
        } else if ($value == '') {
            $value = 0;
        }

        $invoiceItemMeta->update(['value' => $value]);
        $this->getSubtotal();
    }

    public function addItem($ids)
    {
        if (!empty($ids)) {
            foreach (Product::whereIn('id', $ids)->get() as $product) {
                if ($meta_array = $product->meta->toArray()) {
                    $item = InvoiceItem::create(['invoice_id' => $this->invoice->id, 'product_id' => $product->id]);

                    foreach ($meta_array as $meta) {
                        $item->meta()->create($meta);
                    }
                }
            }
        }

        $this->getInvoiceItems();
        $this->dispatchBrowserEvent('closeProductModal');

        return redirect(request()->header('Referer'));
    }

    public function getInvoiceItems()
    {
        // Create an array of pricings from the invoice model
        $this->invoiceItems = collect($this->invoice->items
            ->groupBy('id')
            ->map(function ($item) { // Map to only retrieve first item
                return $item[0];
            })->toArray()
        );
    }

    public function updatePricing($id, $amount, $type)
    {
        $invoicePricing = InvoicePricing::findOrFail($id);
        $this->getSubtotal();
        $this->getDiscountPricing();

        // Update pricing model
        if ($amount) {
            $invoicePricing->update(['value' => $amount, 'type' => $type]);
        } else {
            $invoicePricing->update(['value' => 0, 'type' => $type]);
        }

        $this->getSubtotal();
        $this->getPricings();
    }

    public function updateFormula($id)
    {
        $invoicePricing = InvoicePricing::findOrFail($id);

        // Update only if value is not empty
        if ($this->formula['value']) {
            $invoicePricing->update(['value' => $this->formula['value']]);
        }
    }

    public function addPricingColumn($name, $value, $operation, $visibility)
    {
        if (!empty($name) && !empty($value) && !empty($operation) && !empty($visibility)) {
            $pricing = $this->invoice->pricings()->create([
                'name' => $name,
                'value' => $value,
                'operation' => $operation,
                'visibility' => $visibility,
                'type' => 'value',
            ]);

            $formulaPricing = $this->invoice->getPricing('formular');
            $formula = $formulaPricing->value . $pricing->operation . '(' . $pricing->identifier . ')';
            $formulaPricing->update(['value' => $formula]);
            $this->dispatchBrowserEvent('closePricingModal');

            return redirect()->route('voyager.invoices.edit', $this->invoice->id);
        }
    }

    public function getPricings()
    {
        // Create an array of pricings from the invoice model
        $this->pricings = [];
        $this->pricings = collect($this->invoice->pricings
            ->where('name', '!=', 'formular')
            ->groupBy('id')
            ->map(function ($item) { // Map to only retrieve first item
                return $item[0];
            })
            ->toArray()
        );
    }

    public function getSubtotal()
    {
        // Set subtotal amount
        $this->subtotal = $this->invoice->calculateSubtotal();;
    }

    public function getFormula()
    {
        // Set formula value
        $this->formula = $this->invoice->getPricing('formular')->toArray();
    }

    public function saveData(Request $request)
    {
        $invoiceController = new InvoiceController();
        $invoiceController->savePricing($this->pricings, $this->invoice->id);
    }

    public function getDiscountPricing()
    {
        $this->discountPricing = $this->invoice->getPricing('discount');
    }

    public function mount()
    {
        $this->getPricings();
        $this->getSubtotal();
        $this->getFormula();
        $this->getInvoiceItems();
        $this->getDiscountPricing();
        $this->companyId = auth()->user()->company_id;
        $this->discount_id = $this->invoice->getPricing('discount')->id;
    }

    public function render()
    {
        return view('livewire.invoices.edit');
    }
}
