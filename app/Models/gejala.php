<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gejala extends Model
{
    use HasFactory;
    protected $table = 'gejala';
    protected $primaryKey = 'id_gejala';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_gejala',
        'nama_gejala'];

}
