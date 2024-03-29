<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'ttl',
        'photo',
        'status',
        'password',
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
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'pembeli_id', 'id');
    }

    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    public function alamat(): HasMany
    {
        return $this->hasMany(Alamat::class, 'created_by', 'id');
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }

    public function notifAksi(): HasMany
    {
        return $this->hasMany(NotifAksi::class, 'user_id', 'id');
    }

    public function notifTransaksi(): HasMany
    {
        return $this->hasMany(NotifTransaksi::class, 'user_id', 'id');
    }

    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class, 'pembeli_id', 'id');
    }
}
