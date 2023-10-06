<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_number',
        'vat_number',
        'logo',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'active'
    ];


    // Todo: companies should be able to see all invoices from its stores
    public function invoices() {
        return $this->hasManyThrough(Invoice::class, Store::class); 
    }
}
