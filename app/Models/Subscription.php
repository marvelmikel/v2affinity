<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    // Related user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function plan()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function features($feature = null)
    {
        $monthlyUser = 'hs8g';
        $yealyUser = 'qrfm';
        $addons = json_decode($this->addOns, true);

        $foundMonthlyUser = array_search($monthlyUser, array_column($addons, 'id'));
        $foundYearlyUser = array_search($yealyUser, array_column($addons, 'id'));

       // dd($addons, $foundMonthlyUser, $foundYearlyUser);

        $addonUsers = 0;

        if($addons){

            if($foundMonthlyUser !== false){
                $addonUsers = $addons[$foundMonthlyUser]['quantity'];
            }

            if($foundYearlyUser !== false){
                $addonUsers = $addons[$foundYearlyUser]['quantity'];
            }
        }

       
        $subscriptionUsers =  3 + $addonUsers;
        $companyUsers =  User::where('company_id', $this->company_id)->count() - 1;

        $features =  [
            'users' => [
                'total' => $subscriptionUsers,
                'used' => $companyUsers,
                'balance' => $subscriptionUsers - $companyUsers,
            ],
            'products' => 10,
            'invoices' => 1,
        ];

        if ($feature && isset($features[$feature])) {
            return $features[$feature];
        } else {
            return $features;
        }
    }
}
