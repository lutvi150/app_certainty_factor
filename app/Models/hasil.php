<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil extends Model
{
    use HasFactory;
    protected $table = 'hasil';
    protected $fillable = ['tanggal', 'penyakit', 'gejala', 'hasil_id', 'hasil_nilai'];
    protected $primaryKey = 'id_hasil';
}
