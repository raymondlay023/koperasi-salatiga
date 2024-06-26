<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';

    protected $fillable = [

        'member_id',
        'jumlah_pinjaman',
        'start_date',
        'end_date',
        'total_bayar',
        'tenor',
        'bayar_perbulan',
        'is_lunas',
        'tenor_counter',
    ];

    public function memberpinjaman()
    {
        return $this->belongsTo(KoperasiMember::class, 'member_id');
    }
}
