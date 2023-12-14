<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekap_suara_caleg extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'id_caleg',
        'jumlah_suara'
    ];

    public function caleg()
    {
        return $this->hasOne(caleg::class);
    }
}
