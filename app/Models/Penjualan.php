<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [

        'item_id',
        'jumlah_jual',
        'harga_jual',
        'customer',
        'status',
        'tanggal_jual',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }
}
