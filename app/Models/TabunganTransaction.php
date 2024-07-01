<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganTransaction extends Model
{
    use HasFactory;

    protected $fillable = [

        'tabungan_id',
        'setor',
        'tarikan',
        'setor_date',
        'remark',
    ];


    public function Tabunganlist()
    {
        return $this->belongsTo(Tabungan::class, 'tabungan_id');
    }

  

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $customId = "TBG/TRNS/{$model->id}";
            $model->doc_num = $customId;
            $model->save(); // Save to update doc_num in the database
        });
    }
}
