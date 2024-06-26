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

}
