<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_suara_partai extends Model
{
    use HasFactory;

    protected $primaryKey='id_rsp';

    protected $fillable=[
        
        'id_partai',
        'id_kel',
        'id_tps',
        'jumlah',
    ];

  

    public function partais()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

    public function tpsuaras()
    {
        return $this->belongsTo(Tpsuara::class, 'id_tps');
    }
}
