<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'province_id',
        'cities_id',
        'kecamatan',
        'label',
        'alamat',
        'penerima',
        'created_by',
        'updated_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updateBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'cities_id');
    }
}
