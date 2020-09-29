<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
  protected $fillable = [
    'no_rm',
    'nik',
    'nama_pasien',
    'alamat',
    'tempat_lahir',
    'tanggal_lahir',
    'no_telepon',
    'pekerjaan',
    'email_fb',
    'username',
    'password',
    'jk',
    'pembayaran',
    'no_bpjs',
  ];
}
