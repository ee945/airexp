<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hawb extends Model
{
    //
    protected $table = "exp_hawb";
    protected $fillable = [
    	'opdate',
    	'hawb',
    	'mawb',
    	'dest',
    	'desti',
    	'fltno',
    	'fltdate',
    	'forward',
    	'factory',
    	'seller',
    	'carrier',
    	'carriername',
    	'num',
    	'gw',
    	'cw',
    	'cbm',
    	'paymt',
    	'arranged',
    	'remark'
    ];

    protected $primaryKey = "id";
}
