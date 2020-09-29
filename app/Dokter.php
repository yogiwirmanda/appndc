<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
      'poli',
      'nama_dokter',
      'foto_dokter',
      'motto_dokter'
    ];
}
