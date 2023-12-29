<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_suara extends Model
{
    use HasFactory;

    protected $primaryKey='id_rekap';

    protected $fillable=[
        'id_paslon',
        'id_tps',
        'jumlah',
    ];

    public function paslons()
    {
        return $this->belongsTo(Paslon::class, 'id_paslon');
    }

    public function tpsuaras()
    {
        return $this->belongsTo(Tpsuara::class, 'id_tps');
    }
    
}
