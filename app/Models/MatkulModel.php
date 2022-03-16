<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
    use HasFactory;
    protected $table = 'list_matkul';
    public $timestamps = false;
    protected $primaryKey = 'id_mk';

    protected $fillable = [
        'prodi_id', 'matkul', 'sks', 'kuota', 'tahun_awal', 'tahun_akhir'
    ];
}
