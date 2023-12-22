<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpsuara extends Model
{
    use HasFactory;

    protected $primaryKey='id_tps';

    protected $fillable=[
        'no_tps',
        'id_kel',
    ];

    public function rekap_suara_calegs()
    {
        return $this->hasMany(Rekap_suara_caleg::class, 'id_tps');
    }

    public function rekap_suara_partais()
    {
        return $this->hasMany(Rekap_suara_partai::class, 'id_tps');
    }

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kel');
    }
}
