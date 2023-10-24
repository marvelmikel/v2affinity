<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'title',
        'description',
        'in_stock',
    ];

    public $with = ['meta'];
 
     public function meta(){
        return $this->hasMany(ProductMeta::class);
     }

    public function getMeta($name){
        return $this->meta()->where('name', $name)->first();
    }

     protected static function boot() {
	    parent::boot();

	    static::created(function ($model) {
            $meta = [
                [ 'name' => 'unit_price', 'value' => 1, 'type' => 'number', 'visibility' => ''], //type = text, number, formular
                [ 'name' => 'quantity', 'value' => 1, 'type' => 'number', 'visibility' => '']
            ];


            $model->meta()->create([ 'name' => 'title', 'value' => $model->title, 'type' => 'text', 'visibility' => 'readonly' ]);
            $model->meta()->create([ 'name' => 'description', 'value' => $model->description, 'type' => 'text', 'visibility' => 'readonly' ]);
            foreach($meta as $me){
                $model->meta()->create($me);
            }


             //add def formular here
            if($model->getMeta('unit_price') &&  $model->getMeta('quantity') ){
                $price = $model->getMeta('unit_price');
                $quantity = $model->getMeta('quantity');
                $model->meta()->updateOrCreate(['name' => 'formula'], [ 
                    'name' => 'formular', 
                    'value' => "$price->identifier*$quantity->identifier", 
                    'type' => 'formular',
                    'visibility' => 'readonly'
                ]);
            }


	    });	    
	}
}
