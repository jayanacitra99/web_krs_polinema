<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;
    protected $table = 'list_jurusan';
    public $timestamps = false;
    protected $primaryKey = 'id_lj';

    protected $fillable = [
        'nama_jurusan',
    ];
}
