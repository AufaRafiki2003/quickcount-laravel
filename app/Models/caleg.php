<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;

    protected $primaryKey='id_caleg';
    
    protected $fillable=[
        'id_partai',
        'nama_caleg',
        'no_urut_caleg',
        'id_dapil',
        'foto',
    ];

    public function rekap_suara_calegs()
    {
        return $this->hasMany(Rekap_suara_caleg::class, 'id_caleg');
    }

    public function dapils()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil');
    }
}