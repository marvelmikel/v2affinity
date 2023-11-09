<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $fillable =[
        'product_id',
        'name',
        'value',
        'type', // value, formular
        'visibility', // readonly, hidden, default
        'identifier',
    ];

    protected static function boot() {
	    parent::boot();

	    static::creating(function ($model) {
            $last  =static::latest('id')->first();
            $id = $last ? $last->id+1 : 1;
	        $model->identifier = 'PM'.$model->product_id. $id;
	    });	    
	}
    
        public function product(){
            return $this->belongsTo(Product::class, 'product_id');
        }
}
