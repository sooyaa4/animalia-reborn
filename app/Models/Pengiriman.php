<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengiriman extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'transaksi_id',
        'jenis_id',
        'alamat_id',
        'ongkir',
        'services',
        'noresi',
        'status'
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function jenis(): BelongsTo
    {
        return $this->belongsTo(JenisKirim::class, 'jenis_id');
    }

    public function alamat(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, 'alamat_id');
    }
}
