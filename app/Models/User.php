<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'url_image',
        'email',
        'company_id',
        'password',
        'phoneNumber',
        'address_id',
        'bank_id',
        'email_verified_at',
        'dob'
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

    public $sortable = [
        'name',
        'created_at',
        'email'
    ];


    public function getCompanyNameAttribute()
    {
        if (!empty($this->company_id)) {
            return Company::find($this->company_id)->name;
        }
    }

    public function getBankAttribute()
    {
        if (!empty($this->bank_id)) {
            return Bank::find($this->bank_id);
        }
    }

    public function getAddressAttribute()
    {
        if (!empty($this->address_id)) {
            return Address::find($this->address_id);
        }
    }
    
    public function getIsVerifiedAttribute()
    {
        if (empty($this->email_verified_at)) {
            return false;
        }
        
        return true;
    }

    protected $appends = ['company_name', 'bank', 'address','isVerified'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
