<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $fillable = [
      "dokter",
      "diagnosa",
      "tindakan",
      "obat",
    ];
}
