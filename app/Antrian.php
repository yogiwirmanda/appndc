<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
  protected $fillable = [
    'id_pasien',
    'id_jadwal',
    'tanggal',
    'status',
    'no_antrian',
  ];
}
