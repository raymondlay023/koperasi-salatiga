<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [

        'item_id',
        'nama',
        'jumlah_barang',
        'harga_beli',
        'supplier',
        'status',
        'tanggal_beli',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }
}
