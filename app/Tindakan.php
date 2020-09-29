<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $fillable = [
      "nama_tindakan",
      "kode_tindakan",
    ];
}
