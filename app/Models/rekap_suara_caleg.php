<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_suara_caleg extends Model
{
    use HasFactory;

    protected $primaryKey='id_rsc';

    protected $fillable=[
        'id_tps',
        'id_caleg',
        'jumlah',
    ];

   

    public function calegs()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }

    public function tpsuaras()
    {
        return $this->belongsTo(Tpsuara::class, 'id_tps');
    }
}
