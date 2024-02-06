<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'vat_percentage',
        'terms_conditions',
        'logo',
        'active',
        'terms_accepted',
        'created_at',
        'trial_ends_at',
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

    /**
     * Determine if the subscription is within its trial period.
     *
     * @return bool
     */
    public function onTrial()
    {
        if($this->trial_ends_at){
            return Carbon::parse( $this->trial_ends_at)->isFuture();
        }
        return false;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // create default products here for the company
            // Product::create([
            //     'company_id' => $model->id,
            //     'user_id' => auth()->user()->id,
            //     'title' => 'Default Roll End',
            //     'description' => 'default Roll End Product',
            //     'type' => 'rollend',
            // ]);


            // Product::create([
            //     'company_id' => $model->id,
            //     'user_id' => auth()->user()->id,
            //     'title' => 'Default Underlay',
            //     'description' => 'default Underlay Product',
            //     'type' => 'underlay',
            // ]);

            Store::create([
                'company_id' => $model->id,
                'store_name' => $model->company_name,
                'next_invoice_number' =>'63752504',
                'address_line_1' => $model->company_address,
                'address_line_2' => $model->company_address,
                'address_city' => $model->company_address,
                'address_county' => 'United Kingdom',
                'address_postcode' => 'DE1 1AA',
                'store_email' => $model->company_email,
                'store_phone' => $model->company_phone,
                'store_logo' => $model->logo,
        
            ]);

        });

        static::deleting(function ($model) {
            $model->meta()->delete();
        });
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

}
