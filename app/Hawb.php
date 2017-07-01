<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hawb extends Model
{
    //
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
    	'remark',
        'depar',
        'consignee',
        'notify',
        'shipper',
        'curr',
        'nvd',
        'ncv',
        'package',
        'rclass',
        'special',
        'cgodescp',
        'agentabbr',
        'regtime'
    ];

    protected $primaryKey = "id";
}
