<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'next_invoice_number',
        'address_line_1',
        'address_line_2',
        'address_city',
        'address_county',
        'address_country',
        'address_postcode',
        'company_no',
        'vat_no',
        'phone_no',
        'logo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
