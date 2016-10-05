<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Seller;

class SellerController extends Controller
{
    //
    public function getSeller($forward)
    {
    	# code...
    	$seller = Seller::where('forward',$forward)->first();
    	return $seller;
    }
}
