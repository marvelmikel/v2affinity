<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'store_name',
        'next_invoice_number',
        'invoice_prefix',
        'address_line_1',
        'address_line_2',
        'address_city',
        'address_county',
        'address_country',
        'address_postcode',
        'company_no',
        'company_id',
        'vat_no',
        'store_phone',
        'store_email',
        'store_logo',
        'email_settings',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function emailSettings()
    {
        if ($this->email_settings) {
            return json_decode($this->email_settings);
        } else {
            return false;
        }
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
