<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $primaryKey='id_kec';
    protected $fillable=[
        'nama_kec',
        'id_kab',
    ];
    public function desas()
    {
        return $this->hasMany(Desa::class, 'id_kec');
    }

    public function kabupatens()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kab');
    }
}
