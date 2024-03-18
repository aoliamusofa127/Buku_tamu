<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;
    protected $primaryKey = "tamu_id";
    protected $table = "tamu";
    protected $fillable = [
        "pegawai_id",
        "nama",
        "jenis_kelamin",
        "alamat_atau_instansi",
        "telepon",
        "tempat_pertemuan",
        "keperluan",
        "request_tanggal",
        "status_tamu"
    ];
    public function JoinToPegawai()
    {
        return $this->hasMany(Pegawai::class, 'pegawai_id', 'pegawai_id');
    }
}
