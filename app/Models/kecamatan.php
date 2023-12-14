<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama',
        'id_dapil'
    ];

    public function dapil()
    {
        return $this->belongsTo(dapil::class);
    }

    public function kelurahan()
    {
        return $this->hasMany(kelurahan::class);
    }
}
