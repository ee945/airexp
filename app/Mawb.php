<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mawb extends Model
{
    //
    protected $table = "exp_mawb";
    protected $fillable = [
	    'mawb',
	    'oversea',
	    'dest',
	    'desti',
	    'depa',
	    'depar',
	    'shipper',
	    'shipper',
	    'consignee',
	    'agentabbr',
	    'agentaccount',
	    'carrier',
	    'fltno',
	    'fltdate',
	    'special',
	    'package',
	    'num',
	    'gw',
	    'cw',
	    'cbm',
	    'rclass',
	    'up',
	    'freight',
	    'awn',
	    'myn',
	    'scn',
	    'myup',
	    'scup',
	    'aw',
	    'my',
	    'sc',
	    'other',
	    'amount',
	    'cgodescp',
	    'signature',
	    'atplace',
	    'operator',
	    'opdate',
	    'regtime'
    ];

    protected $primaryKey = "id";
}
