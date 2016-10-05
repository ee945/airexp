<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = "exp_address";
    protected $fillable = [
    	'code',
    	'name',
    	'addr',
    	'cata',
    	'remark'
    ];

    protected $primaryKey = "id";
}
