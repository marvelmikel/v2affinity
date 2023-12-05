<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_number',
        'vat_number',
        'terms_conditions',
        'logo',
        'active',
        'terms_accepted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'active',
        'terms_accepted'
    ];

    // Todo: companies should be able to see all invoices from its stores
    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, Store::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
    public function roomLocations()
    {
        return $this->hasMany(RoomLocation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // create defualt products here for the company
            Product::create([
                'company_id' => $model->id,
                'user_id' => auth()->user()->id,
                'title' => 'Defualt Roll End',
                'description' => 'Defualt Roll End Product',
                'type' => 'rollend',
            ]);


            Product::create([
                'company_id' => $model->id,
                'user_id' => auth()->user()->id,
                'title' => 'Defualt Underlay',
                'description' => 'Defualt Underlay Product',
                'type' => 'underlay',
            ]);

        });

        static::deleting(function ($model) {
            $model->meta()->delete();
        });
    }

}
