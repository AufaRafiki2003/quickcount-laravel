<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_caleg';

    protected $fillable = [
        'id_partai',
        'nama_caleg',
        'no_urut_caleg',
        'id_dapil',
        'foto',
    ];

    // Accessor untuk URL gambar
    public function getImageAttribute($value)
    {
        return asset('/storage/gambar/' . $value);
    }

    public function rekap_suara_calegs()
    {
        return $this->hasMany(Rekap_suara_caleg::class, 'id_caleg');
    }
    public function partais()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }
    public function dapils()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil');
    }
}
