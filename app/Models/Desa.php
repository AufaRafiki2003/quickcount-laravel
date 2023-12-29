<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_desa';

    protected $fillable=[
        'nama_desa',
        'id_kec',
    ];

    public function tpsuaras()
    {
        return $this->hasMany(Tpsuara::class, 'id_desa');
    }

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kec');
    }
}
