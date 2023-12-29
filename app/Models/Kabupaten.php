<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $primaryKey='id_kab';
    protected $fillable=[
        'nama_kab',
    ];
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_kab');
    }
}
