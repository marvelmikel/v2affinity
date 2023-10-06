<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
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


    public function items(){
        return $this->hasMany(InvoiceItem::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }
}


