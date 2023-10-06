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
        'identifier',
    ];


    protected static function boot() {
	    parent::boot();

	    static::creating(function ($model) {
            $last  =static::latest('id')->first();
            $id = $last ? $last->id+1 : 1;
	        $model->identifier = 'IM'.$model->invoice_item_id. $id;
	    });

        

	    
	}
}
