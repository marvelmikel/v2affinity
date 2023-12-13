<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceItemMeta;
use App\Models\Product;
use Livewire\Component;
use function PHPUnit\Framework\isNull;

class Items extends Component
{
    public $invoice, $invoiceItems, $products, $companyId;

    public function deleteInvoiceItem($id)
    {
        // Find and delete Invoice Item
        if ($invoiceItem = InvoiceItem::find($id)) {
            $invoiceItem->deleteQuietly();
            unset($this->invoiceItems[$id]);
        }

        // Recalculate invoice subtotal here whenever an item is deleted
        $this->invoice->calculateSubtotal();
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

    public function updateInvoiceItem($id, $key, $meta, $checkbox = null)
    {
        $invoiceItem = InvoiceItem::find($id);
        $invoiceItemMeta = InvoiceItemMeta::find($meta);

        if ($invoiceItemMeta->name == 'add_allowance') {
            $value = $checkbox;
            $this->calculateAllowance($invoiceItem, $checkbox);
        } else if ($this->invoiceItems[$id]['meta'][$key]['value'] == '') {
            $value = 0;
        } else {
            $value = $this->invoiceItems[$id]['meta'][$key]['value'];
        }

        $invoiceItemMeta->update(['value' => $value]);
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
        $this->dispatchBrowserEvent('closeModal');

        return redirect(request()->header('Referer'))->with('success', 'TEST.');
    }

    public function refresh()
    {

    }

    public function mount()
    {
        $this->getInvoiceItems();
        $this->companyId = auth()->user()->company_id;
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

    public function render()
    {
        return view('livewire.invoices.items');
    }
}
