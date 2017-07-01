<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    //
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
