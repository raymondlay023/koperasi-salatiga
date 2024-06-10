<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [

        'item_name',
        'tipe_barang',
        'stock',
        'deleted_at',
        'created_at',
        'updated_at',
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
