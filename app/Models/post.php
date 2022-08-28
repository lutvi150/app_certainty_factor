<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = ['nama_post', 'detail_post', 'saran_post', 'gambar'];
    protected $primaryKey = 'id_post';
}
