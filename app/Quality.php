<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model {

    protected $fillable = ['CO', 'SO2', 'NO2', 'O3', 'PM25', 'PM10', 'created_at'];

    //public $timestamps = false;
}
