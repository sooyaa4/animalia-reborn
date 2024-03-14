<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'notrans',
        'tanggal_transaksi',
        'tanggal_verifikasi',
        'tanggal_diterima',
        'kupon_id',
        'total',
        'subtotal',
        'after_discount',
        'verifikator_id',
        'pembeli_id',
    ];

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembeli_id');
    }

    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }

    public function kupon(): BelongsTo
    {
        return $this->belongsTo(Kupon::class, 'kupon_id');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id', 'id');
    }

    public function pengiriman(): HasOne
    {
        return $this->hasOne(Pengiriman::class, 'transaksi_id', 'id');
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class, 'transaksi_id', 'id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

    public function log(): HasMany
    {
        return $this->hasMany(LogTransaksi::class, 'transaksi_id', 'id');
    }

    public function notif(): HasMany
    {
        return $this->hasMany(NotifTransaksi::class, 'transaksi_id', 'id');
    }
    
}
