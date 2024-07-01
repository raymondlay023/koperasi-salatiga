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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $customId = "PBLN/{$model->id}";
            $model->doc_num = $customId;
            $model->save(); // Save to update doc_num in the database
        });
    }
}
