<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'title',
        'description',
        'quantity',
        'price',
    ];


   

    public function meta(){
        return $this->hasMany(InvoiceItemMeta::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }


}
