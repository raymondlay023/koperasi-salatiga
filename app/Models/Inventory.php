<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'item_name',
        'tipe_barang',
        'stock',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'item_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'item_id');
    }
}
