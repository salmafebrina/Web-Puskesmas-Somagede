<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icd10 extends Model
{
    protected $table = 'icd10';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code_icd',
        'display',
        'version',
    ];
}