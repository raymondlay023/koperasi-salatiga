<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanTransaction extends Model
{
    use HasFactory;

    protected $fillable = [

        'pinjaman_id',
        'bayar',
        'remark',
    ];


    public function Pinjamanlist()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }

   

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $customId = "PNJM/TRNS/{$model->id}";
            $model->doc_num = $customId;
            $model->save(); // Save to update doc_num in the database
        });
    }
}
