<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
    	'code',
    	'name',
    	'cata'
    ];

    protected $primaryKey = "id";
}
