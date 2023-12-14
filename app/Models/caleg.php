<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caleg extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama',
        'id_partai', 
        'no_urut_caleg',
        'foto' 
    ];

    public function partai()
    {
        return $this->belongsTo(partai::class);
    }

    public function rekap_suara_caleg()
    {
        return $this->belongsTo(rekap_suara_caleg::class);
    }
}
