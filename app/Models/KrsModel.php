<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsModel extends Model
{
    use HasFactory;

    protected $table = 'krs';
    public $timestamps = false;
    protected $primaryKey = 'id_krs';

    protected $fillable = [
        'id_user',
        'matkul',
        'status'
    ];
}
