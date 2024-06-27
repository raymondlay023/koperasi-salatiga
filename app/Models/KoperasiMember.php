<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KoperasiMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

            'nama_anggota',
            'alamat_anggota',
            'handphone',
            'type_id',
            'is_penabung',
            'is_peminjam',
    ];

    public function PinjamanRel()
    {
        return $this->hasMany(Pinjaman::class, 'member_id');
    }

    public function TabunganRel()
    {
        return $this->hasMany(Tabungan::class, 'member_id');
    }

    public function type()
    {
        return $this->belongsTo(MemberType::class, 'type_id');
    }
}
