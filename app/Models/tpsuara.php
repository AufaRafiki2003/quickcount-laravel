<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tpsuara extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'id_kelurahan',
        'foto'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(kelurahan::class);
    }

    public function saksi()
    {
        return $this->belongsTo(saksi::class);
    }
}
