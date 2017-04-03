<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Hawb;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        # 货量统计首页
        echo "quantity stats";
    }

    public function hawbQty()
    {
        # 分单货量统计
        echo "hawb quantity stats";
    }

    public function mawbQty()
    {
        # 总单货量统计
        echo "mawb quantity stats";
    }
}
