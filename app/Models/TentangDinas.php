<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangDinas extends Model
{
    use HasFactory;
    protected $table = "tentang_dinas";
    protected $primaryKey = "dinas_id";
    protected $fillable = ["logo", "content", "sub_content", "link_youtube", "link_instagram", "link_facebook", "kutipan"];
}
