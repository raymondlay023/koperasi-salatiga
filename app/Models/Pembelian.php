<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'item_id',
        'nama',
        'jumlah_barang',
        'harga_beli',
        'supplier',
        'status',
        'tanggal_beli',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }
}
