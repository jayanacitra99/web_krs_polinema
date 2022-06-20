<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
    use HasFactory;
    protected $table = 'list_matkul';
    public $timestamps = false;

    protected $fillable = [
        'id_mk','id_prodi', 'matkul', 'sks', 'kuota'
    ];
}
