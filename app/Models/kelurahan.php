<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama',
        'id_kecamatan'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }

    public function tpsuara()
    {
        return $this->hasMany(tpsuara::class);
    }
}
