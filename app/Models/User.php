<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'yenkor_id',
        'admin_role',
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'is_driver',
        'is_rider',
        'status',
        'vehicle',
        'gender',
        'biography',
        'd_o_b',
    ];

    public function rider()
    {
        return $this->hasMany(Rider::class);
    }

    public function driver()
    {
        return $this->hasMany(Driver::class);
    }

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function isRider()
    {
        if ($this->role == 0 && $this->is_rider == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isDriver()
    {
        if ($this->role == 1 && $this->is_driver == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        if (($this->role == 2 || $this->role == 3) && $this->is_admin == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['2', '3']);
    }

    public function scopedrivers($query)
    {
        return $query->whereIn('role', '1');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
