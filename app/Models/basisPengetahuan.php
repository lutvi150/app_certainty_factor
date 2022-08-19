<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basisPengetahuan extends Model
{
    use HasFactory;
    protected $table = 'basis_pengetahuan';
    protected $fillable = ['id_penyakit', 'id_gejala', 'nilai'];
    protected $primaryKey = 'id_pengetahuan';
}
