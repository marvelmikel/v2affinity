<?php

namespace App\Http\Livewire\Invoices;

use App\Models\InvoicePricing;
use Livewire\Component;

class Edit extends Component
{
    public $invoice, $subtotal, $formula;
    public $pricings = [];

    public function updatePricing($id, $amount)
    {
        $invoicePricing = InvoicePricing::findOrFail($id);

        // Update only if value is not empty
        if ($amount) {
            // Calculate value based on pricing name
            $value = match ($this->pricings[$id]['name']) {
                'tax' => round($this->subtotal * ($amount / 100), 2),
                'discount' => round($amount / 100, 2), // Divide by 100 to get the percentage value
                default => number_format($amount, 2),
            };

            // Update pricing model
            $invoicePricing->update(['value' => $value]);
        } else {
            $invoicePricing->update(['value' => 0]);
        }
    }


    public function updateFormula($id)
    {
        $invoicePricing = InvoicePricing::findOrFail($id);

        // Update only if value is not empty
        if ($this->formula['value']) {
            $invoicePricing->update(['value' => $this->formula['value']]);
        }
    }

    public function getPricings()
    {
        // Create an array of pricings from the invoice model
        $this->pricings = collect($this->invoice->pricings
            ->where('name', '!=', 'formular')
            ->groupBy('id')
            ->map(function ($item) { // Map to only retrieve first item
                return $item[0];
            })->toArray()
        );
    }

    public function getSubtotal()
    {
        // Set subtotal amount
        $this->subtotal = $this->pricings->where('name', 'subtotal')->first()['value'];
    }

    public function getFormula()
    {
        // Set formula value
        $this->formula = $this->invoice->getPricing('formular')->toArray();
    }

    public function mount()
    {
        $this->getPricings();
        $this->getSubtotal();
        $this->getFormula();
    }

    public function render()
    {
        return view('livewire.invoices.edit');
    }
}
