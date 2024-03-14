<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'nama',
        'brand',
        'deskripsi',
        'harga',
        'stok',
        'berat',
        'tampil',
        'kategori_id',
        'satuan_id',
        'created_by',
        'updated_by'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function gambar(): HasMany
    {
        return $this->hasMany(ProdukGambar::class, 'produk_id', 'id');
    }

    public function ulasan(): HasMany
    {
        return $this->hasMany(Rating::class, 'produk_id', 'id');
    }
    
    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class, 'produk_id', 'id');
    }

    public function diskon(): HasOne
    {
        return $this->hasOne(ProdukDiskon::class, 'produk_id', 'id');
    }
}
