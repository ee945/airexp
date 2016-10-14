<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;

class ManifestController extends Controller
{
    //
    public function show($mawb)
    {
    	# code...
    	$title = "分单清单";

    	$hawbs = Hawb::where('mawb',$mawb)->orderBy('hawb','asc')->get();
    	$hawb_first = $hawbs->first();
    	$data['hawb_count'] = $hawbs->count();
    	$data['amount_num'] = $hawbs->sum('num');
    	$data['amount_gw'] = $hawbs->sum('gw');
    	// var_dump($hawbs);
    	// dd($hawb_first);
    	return view(theme("manifest.manifest"), compact('hawbs','hawb_first','title'))->with($data);
    }
}
