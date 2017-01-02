<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $table = "exp_seller";
    protected $fillable = [
    	'forward',
    	'seller',
    	'remark',
    ];

    protected $primaryKey = "id";
}
