<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;

    protected $primaryKey='id_partai';

    protected $fillable =[
        'nama_partai',
        'no_urut_partai',
        'foto',
    ];

    public function rekap_suara_partais()
    {
        return $this->hasMany(Rekap_suara_partai::class, 'id_partai');
    }
}
