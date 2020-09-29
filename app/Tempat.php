<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
  protected $fillable = [
    'nama_tempat',
    'alamat',
  ];
}
