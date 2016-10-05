<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;

class ClientController extends Controller
{
    //
    public function getForward($forwardcode)
    {
    	# code...
    	$forward = Client::where('code',$forwardcode)->where('cata','货源')->first();
    	return $forward;
    }

    public function getFactory($factorycode)
    {
    	# code...
    	$factory = Client::where('code',$factorycode)->where('cata','生产单位')->first();
    	return $factory;
    }

    public function getCarrierName($carrier)
    {
    	# code...
    	$carriername = Client::where('code',$carrier)->where('cata','承运人')->first();
    	return $carriername;
    }
}
