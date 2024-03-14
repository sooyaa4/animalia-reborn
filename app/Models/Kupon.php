<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kupon extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'judul',
        'kode',
        'potongan',
        'deskripsi',
        'max',
        'tampil',
        'tanggal_awal',
        'tanggal_akhir',
        'created_by',
        'updated_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
