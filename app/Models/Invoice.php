<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = [
        'invoice_number',
        'currency', // add to migration
        'notes',
        'store_id', // belongs to a store
        'user_id', // created by user
        'customer_id', // maintain saparate table for customers, in this way, stores can select existing customers or create  new while creating invoice
        'is_recurring',
        'paid_at',
        'sent_at',
        'company_id',
    ];


    public $with = ['customer'];
    public $append = ['total'];

    public function items(){
        return $this->hasMany(InvoiceItem::class);
    }
    public function pricings(){
        return $this->hasMany(InvoicePricing::class);
    }

    public function getPricing($name){
        return $this->pricings()->where('name', $name)->first();
    }

    public function calculateSubtotal(){
        $subtotal =  $this->items->map( function($item){
            return $item->item_total;
        })->sum();

        //update pricing here and then return
        $this->pricings()->where('name', 'subtotal')->update([
           'value' =>  $subtotal
        ]);

        return $subtotal;

    }
    public function calculateVat(){
        $company = $this->company;
        $vat_percentage = $company->vat_percentage ?? 20;

        // dd($this->calculateSubtotal() ,  $this->calculateSubtotal() * ($vat_percentage/100));
        return $this->calculateSubtotal() * ($vat_percentage/100);
    }

    public function getTotalAttribute(){
        $formulaCol = $this->getPricing('formular');
        $formular = $formulaCol->value;
        $discount = $this->getPricing('discount');
        $total = (evaluate_formular($formular, 'InvoicePricing', modifier: $formulaCol->modifier));

        // Calculate discount
        if ($discount->value > 0) {
            if ($discount->type == 'percentage') {
                $total = $total - ($total * ($discount->value / 100));
            } else if ($discount->type == 'value') {
                $total = $total - $discount->value;
            }
        }

        return $total;
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }
    public function logs() {
        return $this->hasMany(InvoiceLog::class);
    }


    protected static function boot() {
	    parent::boot();

	    static::deleting(function ($model) {
            $model->items()->delete();
	    });
	}
}


