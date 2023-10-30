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
        'title',
        'description',
        'currency', // add to migration
        'notes',
        'store_id', // belongs to a store
        'user_id', // created by user
        'customer_id', // maintain saparate table for customers, in this way, stores can select existing customers or create  new while creating invoice
        'is_recurring',
        'due_at',
        'paid_at',
        'sent_at',
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

    public function getTotalAttribute(){
        $formular = $this->getPricing('formular')->value;
        return  evaluate_formular($formular, 'InvoicePricing' );
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }


    protected static function boot() {
	    parent::boot();

	    static::deleting(function ($model) {
            $model->items()->delete();
	    });	    
	}
}


