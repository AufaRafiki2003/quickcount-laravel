<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_suara_partai extends Model
{
    use HasFactory;

    protected $primaryKey='id_rsp';

    protected $fillable=[
        'id_kec',
        'id_kel',
        'id_partai',
        'id_tps',
        'jumlah',
    ];

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kec');
    }

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kel');
    }

    public function partais()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

    public function tpsuaras()
    {
        return $this->belongsTo(Tpsuara::class, 'id_tps');
    }
}
