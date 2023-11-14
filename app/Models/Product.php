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
        'type', // carpet, tile
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
                [ 'name' => 'length', 'value' => 1, 'type' => 'number', 'visibility' => ''],
                [ 'name' => 'width', 'value' => 1, 'type' => 'number', 'visibility' => ''],

            ];

           

            $model->meta()->create([ 'name' => 'title', 'value' => $model->title, 'type' => 'text', 'visibility' => 'readonly' ]);
            $model->meta()->create([ 'name' => 'description', 'value' => $model->description, 'type' => 'text', 'visibility' => 'readonly' ]);
            $model->meta()->create([ 'name' => 'type', 'value' => $model->type, 'type' => 'text', 'visibility' => 'readonly' ]);

            foreach($meta as $me){
                $model->meta()->create($me);
            }

           
            if($model->type == 'carpet'){
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
                if( $model->getMeta('unit_price(£)') &&  $model->getMeta('area') ){
                    $price = $model->getMeta('unit_price(£)');
                    $area = $model->getMeta('area');
                    $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                        'name' => 'formular', 
                        'value' => "$price->identifier*$area->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]);
                    
                }
            }

            if($model->type == 'tile'){

               
                $model->meta()->updateOrCreate(['name' => 'unit_pack_tile_area'], [ 
                    'name' => 'unit_pack_tile_area', 
                    'value' => 1, 
                    'type' => 'number',
                    'visibility' => ''
                ]);

                $model->meta()->updateOrCreate(['name' => 'tiles_per_pack'], [ 
                    'name' => 'tiles_per_pack', 
                    'value' => 1, 
                    'type' => 'number',
                    'visibility' => ''
                ]);


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

                if( $model->getMeta('unit_price(£)') &&  $model->getMeta('area') ){
                   
                    $price = $model->getMeta('unit_price(£)');
                    $area = $model->getMeta('area');
                    $tiles_per_pack = $model->getMeta('tiles_per_pack');
                    $single_tile_area = $model->getMeta('unit_pack_tile_area');

                    

                    $model->meta()->updateOrCreate(['name' => 'tiles_count'], [ 
                        'name' => 'tiles_count', 
                        'value' => "$area->identifier/$single_tile_area->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]);


                    $tiles_count = $model->getMeta('tiles_count');

                    $model->meta()->updateOrCreate(['name' => 'packs_count'], [ 
                        'name' => 'packs_count', 
                        'value' => "$tiles_count->identifier/$tiles_per_pack->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]);


                    $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                        'name' => 'formular', 
                        'value' => "$price->identifier*$area->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]); 

                }
            }



	    });	    
	}

public function productMeta()
    {
        return $this->hasMany(ProductMeta::class);
    }
}
