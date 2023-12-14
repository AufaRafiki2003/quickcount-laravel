<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekap_suara_partai extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'id_partai',
        'jumlah_suara'
    ];

    public function partai()
    {
        return $this->hasOne(partai::class);
    }
}
