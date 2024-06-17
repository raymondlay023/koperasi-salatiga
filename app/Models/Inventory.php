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
        'item_type_id',
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

    public function type()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id', 'id');
    }
}
