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
                [ 'name' => 'unit_price(£)', 'value' => 1, 'type' => 'number', 'visibility' => 'readonly'], //type = text, number, formular
                // [ 'name' => 'quantity/area per m²', 'value' => 1, 'type' => 'number', 'visibility' => '']
                [ 'name' => 'length', 'value' => 0, 'type' => 'number', 'visibility' => ''],
                [ 'name' => 'width', 'value' => 0, 'type' => 'number', 'visibility' => '']
            ];

           

            $model->meta()->create([ 'name' => 'title', 'value' => $model->title, 'type' => 'text', 'visibility' => 'readonly' ]);
            $model->meta()->create([ 'name' => 'description', 'value' => $model->description, 'type' => 'text', 'visibility' => 'readonly' ]);

            foreach($meta as $me){
                $model->meta()->create($me);
            }

            
            if($model->getMeta('length') &&  $model->getMeta('width') ){
                $length = $model->getMeta('length');
                $width = $model->getMeta('width');

                $model->meta()->updateOrCreate(['name' => 'area'], [ 
                    'name' => 'area', 
                    'value' => "$length->identifier*$width->identifier", 
                    'type' => 'formular',
                    'visibility' => 'readonly'
                ]);
                
            }

             //add def formular here
             if($model->getMeta('unit_price(£)') &&  $model->getMeta('area') ){
                $price = $model->getMeta('unit_price(£)');
                $area = $model->getMeta('area');
                $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                    'name' => 'formular', 
                    'value' => "$price->identifier*$area->identifier", 
                    'type' => 'formular',
                    'visibility' => 'readonly'
                ]);
                
            }



	    });	    
	}
}
