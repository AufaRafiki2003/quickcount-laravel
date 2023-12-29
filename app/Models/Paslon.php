<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_paslon';

    protected $fillable = [
        'no_urut',
        'nama_ketua',
        'nama_wakil',
        'foto',
    ];

    // Accessor untuk URL gambar
    public function getImageAttribute($value)
    {
        return asset('/storage/gambar/' . $value);
    }

    public function rekap_suaras()
    {
        return $this->hasMany(Rekap_suara::class, 'id_paslon');
    }
}

