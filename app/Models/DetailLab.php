<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLab extends Model
{
    protected $table = 'detail_labs';

    protected $primaryKey = 'id_laboratorium';

    public $timestamps = false;

    protected $guarded = [];
}