<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $fillable = [

        'member_id',
        'saldo',
        'start_date',
        'status',
        'created_by',
    ];

    public function membertabungan()
    {
        return $this->belongsTo(KoperasiMember::class, 'member_id');
    }


    public function transaksi()
    {
        return $this->hasMany(TabunganTransaction::class, 'tabungan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $customId = "TBG/{$model->id}";
            $model->doc_num = $customId;
            $model->save(); // Save to update doc_num in the database
        });
    }
}
