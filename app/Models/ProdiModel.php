<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiModel extends Model
{
    use HasFactory;
    protected $table = 'list_prodi';
    public $timestamps = false;
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'jurusan_id','prodi','tingkat'
    ];
}
