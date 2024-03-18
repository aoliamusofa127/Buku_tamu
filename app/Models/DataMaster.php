<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMaster extends Model
{
    use HasFactory;
    protected $table = "data_master";
    protected $primaryKey = "dataMaster_id";
    protected $fillable = ["dataMaster_id", "nama_dinas", "link_barcode"];
}
