<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = ['tanggal', 'siswa_nis', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
