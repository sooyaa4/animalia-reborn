<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'transaksi_id',
        'amount',
        'fraud_status',
        'status_code',
        'status_message',
        'payment_type',
        'transaction_status',
        'transaction_time'
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function notif(): HasMany
    {
        return $this->hasMany(NotifTransaksi::class, 'pembayaran_id', 'id');
    }
}
