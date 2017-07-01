<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
    	'code',
    	'name',
    	'addr',
    	'cata',
    	'remark'
    ];

    protected $primaryKey = "id";
}
