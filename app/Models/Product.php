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

    public function roomlocation()
{
    return $this->belongsTo(RoomLocation::class);
}


     protected static function boot() {
	    parent::boot();

	    static::created(function ($model) {

           
            if($model->type == 'carpet'){

                $model->meta()->create([ 'name' => 'title', 'title' => 'Title',  'value' => $model->title, 'type' => 'text', 'visibility' => 'readonly' ]);
                $model->meta()->create([ 'name' => 'description', 'title' => 'Description', 'value' => $model->description, 'type' => 'text', 'visibility' => 'readonly' ]);
                $model->meta()->create([ 'name' => 'type', 'title' => 'Type of Product',  'value' => $model->type, 'type' => 'text', 'visibility' => 'hidden' ]);

                $model->meta()->create([ 'name' => 'unit_price', 'title' => 'Unit Price(£)',  'value' => 1, 'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'unit_length', 'value' => 1, 'title' => 'Unit Length(m)',  'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'unit_width', 'value' => 1, 'title' => 'Unit Width(m)', 'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'initial_area', 'value' => 'L x W', 'title' => 'Unit Area Size(LxW)㎡ ', 'type' => 'text', 'visibility' => 'readonly']);

                $model->meta()->create([ 'name' => 'length', 'value' => 0, 'title' => 'Length of Room(m)',  'type' => 'number', 'visibility' => 'visible']);
                $model->meta()->create([ 'name' => 'width', 'value' => 0, 'title' => 'Width of Room(m)', 'type' => 'number', 'visibility' => 'visible']);

                $model->meta()->create([ 'name' => 'location', 'value' => '', 'title' => 'Location of Room', 'type' => 'select', 'visibility' => 'visible']);


                if($model->getMeta('unit_length') &&  $model->getMeta('unit_width') ){
                    $unit_length = $model->getMeta('unit_length');
                    $unit_width = $model->getMeta('unit_width');

                    $model->meta()->updateOrCreate(['name' => 'unit_area'], [ 
                        'name' => 'unit_area', 
                        'title' => 'Unit Area (m2)', 
                        'value' => "$unit_length->identifier*$unit_width->identifier",
                        'type' => 'formular',
                        'visibility' => 'hidden'
                    ]);
                    

                    $length = $model->getMeta('length');
                    $width = $model->getMeta('width');

                    $model->meta()->updateOrCreate(['name' => 'area'], [ 
                        'name' => 'area', 
                        'title' => 'Carpet Area (㎡)', 
                        'value' => "$length->identifier*$width->identifier",
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]);
                    
                }

                //add def formular here
                if( $model->getMeta('unit_price') && $model->getMeta('unit_area')  ){
                    $unit_price = $model->getMeta('unit_price');
                    $area = $model->getMeta('area');

                    // $unit_length = $model->getMeta('unit_length');
                    $unit_area = $model->getMeta('unit_area');
                    // $unit_area = "$unit_width->identifier*$unit_length->identifier";
                    
                    $carpet_units = $model->meta()->updateOrCreate(['name' => 'carpet_units'], [ 
                        'name' => 'carpet_units', 
                        'title' => 'Carpet Units', 
                        'value' => "$area->identifier/$unit_area->identifier", 
                        'type' => 'formular',
                        'visibility' => 'hidden',
                        'modifier' => 'ceil'
                    ]);

                    
                    $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                        'name' => 'formular', 
                        'title' => 'Formular', 
                        'value' => "$unit_price->identifier*$carpet_units->identifier", 
                        'type' => 'formular',
                        'visibility' => 'hidden'
                    ]);
                    
                }
            }

            if($model->type == 'tile'){

                $model->meta()->create([ 'name' => 'title', 'title' => 'Title',  'value' => $model->title, 'type' => 'text', 'visibility' => 'readonly' ]);
                $model->meta()->create([ 'name' => 'description', 'title' => 'Description', 'value' => $model->description, 'type' => 'text', 'visibility' => 'readonly' ]);
                $model->meta()->create([ 'name' => 'type', 'title' => 'Type of Product',  'value' => $model->type, 'type' => 'text', 'visibility' => 'hidden' ]);

               
                $model->meta()->create([ 'name' => 'unit_price', 'title' => 'Unit Price(£)',  'value' => 1, 'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'marble_size_length', 'value' => 1, 'title' => 'Unit Length(m)',  'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'marble_size_width', 'value' => 1, 'title' => 'Unit Width (m)', 'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'initial_area', 'value' => 'L x W', 'title' => 'Unit Area Size(LxW)㎡ ', 'type' => 'text', 'visibility' => 'hidden']);

                $model->meta()->create([ 'name' => 'length', 'value' => 0, 'title' => 'Required Length of Room(m)',  'type' => 'number', 'visibility' => 'visible']);
                $model->meta()->create([ 'name' => 'width', 'value' => 0, 'title' => 'Required Width of Room(m)', 'type' => 'number', 'visibility' => 'visible']);

               
             

                // $model->meta()->updateOrCreate(['name' => 'single_tile_area'], [ 
                //     'name' => 'single_tile_area', 
                //     'title' => 'Single Tile Area (m2)', 
                //     'value' => 1, 
                //     'type' => 'number',
                //     'visibility' => 'hidden'
                // ]);
                

                $model->meta()->updateOrCreate(['name' => 'tiles_per_pack'], [ 
                    'name' => 'tiles_per_pack', 
                    'title' => 'Number of Tiles Per Pack', 
                    'value' => 1, 
                    'type' => 'number',
                    'visibility' => 'hidden'
                ]);

                $model->meta()->updateOrCreate(['name' => 'location'], [ 
                    'name' => 'location', 
                    'title' => 'Location of Room', 
                    'value' => 'Type of Room', 
                    'type' => 'Text',
                    'visibility' => 'hidden'
                ]);


                if($model->getMeta('length') &&  $model->getMeta('width') ){
                    $length = $model->getMeta('length');
                    $width = $model->getMeta('width');

                    $model->meta()->updateOrCreate(['name' => 'area'], [ 
                        'name' => 'area', 
                        'title' => 'Total Area (m2)', 
                        'value' => "$length->identifier*$width->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly'
                    ]);
                    
                }

                if( $model->getMeta('unit_price') &&  $model->getMeta('area') ){
                   
                    $price = $model->getMeta('unit_price');
                    $area = $model->getMeta('area');
                    $tiles_per_pack = $model->getMeta('tiles_per_pack');


                    $marble_size_length = $model->getMeta('marble_size_length');
                    $marble_size_width = $model->getMeta('marble_size_width');

                    $single_tile_area = "($marble_size_length->identifier*$marble_size_width->identifier)";


                    $model->meta()->updateOrCreate(['name' => 'tiles_count'], [ 
                        'name' => 'tiles_count', 
                        'title' => 'Number of Tiles Required', 
                        'value' => "$area->identifier/$single_tile_area", 
                        'type' => 'formular',
                        'visibility' => 'hidden'
                    ]);


                    $tiles_count = $model->getMeta('tiles_count');

                    $packs_count = $model->meta()->updateOrCreate(['name' => 'packs_count'], [ 
                        'name' => 'packs_count', 
                        'title' => 'Total Quantity of Packs', 
                        'value' => "$tiles_count->identifier/$tiles_per_pack->identifier", 
                        'type' => 'formular',
                        'visibility' => 'readonly',
                        'modifier' => 'ceil'
                    ]);


                    $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                        'name' => 'formular', 
                        'title' => 'Formular', 
                        'value' => "$price->identifier*$packs_count->identifier", 
                        'type' => 'formular',
                        'visibility' => 'hidden'
                    ]); 

                }
            }

            if($model->type == 'others'){

                $model->meta()->create([ 'name' => 'unit_price', 'title' => 'Unit Price(£)',  'value' => 1, 'type' => 'number', 'visibility' => 'hidden']);
                $model->meta()->create([ 'name' => 'quantity', 'title' => 'Quantity of Product', 'value' => 1, 'type' => 'number', 'visibility' => 'visible' ]);

                 //add def formular here
                if( $model->getMeta('unit_price') &&  $model->getMeta('quantity') ){
                    $price = $model->getMeta('unit_price');
                    $quantity = $model->getMeta('quantity');
                    $model->meta()->updateOrCreate(['name' => 'formular'], [ 
                        'name' => 'formular', 
                        'value' => "$price->identifier*$quantity->identifier", 
                        'type' => 'formular',
                        'visibility' => 'hidden'
                    ]);
                }
            }



	    });	 
        
        static::deleting(function ($model) {
            $model->meta()->delete();
	    });	   
	}

    // public function productMeta(){
    //     return $this->hasMany(ProductMeta::class);
    // }
}
