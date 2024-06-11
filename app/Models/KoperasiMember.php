<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoperasiMember extends Model
{
    use HasFactory;

    protected $fillable = [

            'nama_anggota',
            'alamat_anggota',
            'handphone',
            'tipe_member',
            'is_penabung',
            'is_peminjam',
            'deleted_at',
            'created_at',
            'updated_at',
    ];
}
