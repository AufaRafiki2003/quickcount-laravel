<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory;
    protected $primaryKey='id_dapil';
    protected $fillable=[
        'nama_dapil'
    ];

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_dapil');
    }

    public function calegs()
    {
        return $this->hasMany(Caleg::class, 'id_dapil');
    }
}


