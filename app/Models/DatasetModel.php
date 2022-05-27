<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatasetModel extends Model
{
    use HasFactory;

    
    protected $table = "dataset";

    protected $fillable = ['id_mk','x1','x2','x3','total','cluster'];
}
