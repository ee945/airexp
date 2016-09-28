<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;

class HawbController extends Controller
{

	public function lists()
	{
		# code...
        $title = "分单列表";
        $hawbs = Hawb::orderBy('fltdate','desc')->orderBy('regtime','desc')->paginate(20);
		return view(theme("hawb.list"),compact('hawbs','title'));
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
