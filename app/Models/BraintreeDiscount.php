<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BraintreeDiscount extends Model
{
    use HasFactory;

    public $fillable = [
        'amount',
        'name',
        'discount_id',
        'merchant_id',
        'current_billing_cycle',
        'description',
        'kind',
        'never_expires',
        'number_of_billing_cycles',
        'created_at',
        'updated_at'
    ];
}
