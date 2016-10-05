<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    //
    protected $table = "exp_port";
    protected $fillable = [
    	'code',
    	'name',
    	'zone',
    	'm',
    	'n',
    	'q'
    ];

    protected $primaryKey = "id";
}
