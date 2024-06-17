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
        'setor_date',
        'remark',
    ];


    public function Tabunganlist()
    {
        return $this->belongsTo(Tabungan::class, 'tabungan_id');
    }

}
