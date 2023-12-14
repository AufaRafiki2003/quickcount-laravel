<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saksi extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama',
        'id_tpSuara'
    ];

    public function tpsuara()
    {
        return $this->hasOne(tpsuara::class);
    }
}
