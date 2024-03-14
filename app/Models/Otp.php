<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Otp extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'kode',
        'expire_at',
        'user_id'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
