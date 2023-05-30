<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mahasiswa extends Model
{
   protected $table = "mahasiswas";
   protected $primaryKey = 'nim';

   protected $fillable =  [
      'nim',
      'nama',
      'kelas_id',
      'jurusan',
   ];

   public $timestamps = false;

   public function kelas()
   {
      return $this->belongsTo(Kelas::class);
   }
}
