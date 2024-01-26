<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Modules\Admin\Models\Role; 
use \Haruncpi\LaravelUserActivity\Models\Log as UserActivityLog;
use NextApps\VerificationCode\VerificationCode;

class User extends \Modules\Admin\Models\User 
{
    use HasApiTokens, HasFactory, Notifiable, Loggable;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'store_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id'); // Assuming 'company_id' is the foreign key in the users table referencing the companies table
    }

    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }
    

    public function store() {
        
        return $this->belongsTo(Store::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class, 'company_id', 'company_id');
    }

    public function activeSubscription() {
        return $this->subscriptions()->where('status', 'Active')->first();
    }

    public function onTrail() {
        return $this->company->onTrial();
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            VerificationCode::send($model->email);
        });

    }

    
}
