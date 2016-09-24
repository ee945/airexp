<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Hawb;

class HawbController extends Controller
{

	public function lists()
	{
		# code...
		$hawbs = DB::table('exp_hawb')->orderBy('fltdate','desc')->orderBy('regtime','desc')->take(10)->get();
		dd($hawbs);
	}
    //
    public function show($hawb)
    {
    	# code...
    	$hawbs = Hawb::where('hawb',$hawb)->get();
    	foreach ($hawbs as $hawb) {
    		# code...
	    	echo $hawb->mawb;
    	}
    }
}
