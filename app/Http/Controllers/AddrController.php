<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Address;

class AddrController extends Controller
{
    //
    public function getHShipper($shippercode)
    {
    	# code...
    	$shipper = Address::where('code',$shippercode)->where('cata','分单发货人')->first();
    	return $shipper;
    }
    public function getHConsignee($consigneecode)
    {
    	# code...
    	$consignee = Address::where('code',$consigneecode)->where('cata','分单收货人')->first();
    	return $consignee;
    }
    public function getHNotify($notifycode)
    {
    	# code...
    	$notify = Address::where('code',$notifycode)->where('cata','分单通知人')->first();
    	return $notify;
    }
}
