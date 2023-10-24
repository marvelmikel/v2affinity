<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePricing extends Model
{
    use HasFactory;


    protected $fillable =[
        'invoice_id',
        'name',
        'value',
        'visibility',
        'type',
        'identifier',
    ];


    public function invoice (){
        return $this->belongsTo(Invoice::class);
    }
    


    protected static function boot() {
	    parent::boot();

	    static::creating(function ($model) {
            $last  =static::latest('id')->first();
            $id = $last ? $last->id+1 : 1;
	        $model->identifier = 'P'.$model->invoice_id. $id;
	    });	    
	}
}
