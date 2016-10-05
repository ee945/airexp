<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $table = "exp_seller";
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
