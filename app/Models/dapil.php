<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dapil extends Model
{
    use HasFactory;
    protected $fillable=[ //[ adalah simbol array
        'nama'
    ];

    public function kecamatan()
    {
        return $this->hasMany(kecamatan::class);
    }
}
