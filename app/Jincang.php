<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jincang extends Model
{
    //
    protected $table = "jincang";
    protected $fillable = [
    	'regdate',
        'jcno',
        'dest',
        'fltdate',
        'client',
        'forward',
        'factory',
        'carrier',
        'delivery',
        'cargodata',
    	'remark'
    ];

    protected $primaryKey = "id";
}
