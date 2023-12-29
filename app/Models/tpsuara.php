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
        'id_desa',
    ];

    public function rekap_suaras()
    {
        return $this->hasMany(Rekap_suara::class, 'id_tps');
    }

    public function desas()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

}
