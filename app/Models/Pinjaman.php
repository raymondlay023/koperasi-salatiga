<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [

        'member_id',
        'jumlah_pinjaman',
        'start_date',
        'end_date',
        'total_bayar',
        'tenor',
        'bayar_perbulan',
    ];

    public function memberpinjaman()
    {
        return $this->belongsTo(KoperasiMember::class, 'member_id');
    }
}
