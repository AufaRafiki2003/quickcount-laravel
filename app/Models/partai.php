<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partai extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama',
        'no_urut_partai',
        'id_kecamatan',
        'foto'
    ];

    public function caleg()
    {
        return $this->hasMany(caleg::class);
    }

    public function rekap_suara_partai()
    {
        return $this->belongsTo(rekap_suara_partai::class);
    }
}
