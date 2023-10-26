<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItemMeta extends Model
{
    use HasFactory;

    protected $fillable =[
        'invoice_item_id',
        'name',
        'value',
        'visibility',
        'type',
        'identifier',
    ];


    protected static function boot() {
	    parent::boot();

	    static::creating(function ($model) {

            // don't generate unique identifiers for invoice item meta anymore, use the identifier from product meta - yea
            // $last  =static::latest('id')->first();
            // $id = $last ? $last->id+1 : 1;
	        // $model->identifier = 'I'.$model->invoice_item_id. $id;

	    });	    
	}
}
