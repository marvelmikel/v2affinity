<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'name',
        'email',
        'phone',
        'address_line_1',
        'address_line_2',
        'address_city',
        'address_state',
        'address_country',
        'address_postcode',
        'note',
    ];


    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
