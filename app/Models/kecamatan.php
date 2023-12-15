<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $primaryKey='id_kec';
    protected $fillable=[
        'nama_kec',
        'id_dapil',
    ];
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'id_kec');
    }

    public function dapils()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil');
    }
}
