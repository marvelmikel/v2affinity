<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomLocation extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'room_name',
        'user_id',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function products()
{
    return $this->hasMany(Product::class);
}

}
