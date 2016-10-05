<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Port;

class PortController extends Controller
{
    //
    public function getPort($dest)
    {
    	# code...
    	$port = Port::where('code',$dest)->first();
    	return $port;
    }
}
