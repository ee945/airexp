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

    public function hawbQty(Request $request)
    {
        # 分单货量统计
        $title = "分单货量统计";

        // 获取表单筛选条件
        $filter = $request->all();
        // 获取全部分单记录，按航班日期、添加时间排序
        $query = Hawb::orderBy('fltdate','desc')->orderBy('regtime','desc')->orderBy('created_at','desc');
        /* 逐一判断是否有筛选条件 */
        // 时间范围
        if(isset($filter['filter_fltstart'])&&$filter['filter_fltstart']!="")
            $query->where('fltdate','>=',$filter['filter_fltstart']);
        if(isset($filter['filter_fltend'])&&$filter['filter_fltend']!="")
            $query->where('fltdate','<=',$filter['filter_fltend']);
        // 筛选：星期（复选）

        // 目的港、航班号、承运人
        if(isset($filter['filter_dest'])&&$filter['filter_dest']!="")
            $query->where('dest','like','%'.$filter['filter_dest'].'%');
        if(isset($filter['filter_fltno'])&&$filter['filter_fltno']!="")
            $query->where('fltno','like','%'.$filter['filter_fltno'].'%');
        if(isset($filter['filter_carrier'])&&$filter['filter_carrier']!="")
            $query->where('carrier','like','%'.$filter['filter_carrier'].'%');
        // 货源、厂家、销售
        if(isset($filter['filter_forward'])&&$filter['filter_forward']!="")
            $query->where('forward','like','%'.$filter['filter_forward'].'%');
        if(isset($filter['filter_factory'])&&$filter['filter_factory']!="")
            $query->where('factory','like','%'.$filter['filter_factory'].'%');
        // 按perpage值进行分页
        $hawbs = $query->paginate(isset($filter['perpage'])?$filter['perpage']:100);
        // 统计当前显示的总和 - 件数、实际重量、收费重量、体积
        $total_count = $hawbs->count('hawb');
        $total_num = $hawbs->sum('num');
        $total_gw = $hawbs->sum('gw');
        $total_cw = $hawbs->sum('cw');
        $total_cbm = $hawbs->sum('cbm');
        return view(theme("stats.hawbqty"),compact('hawbs','title','total_count','total_num','total_gw','total_cw','total_cbm'))->with($filter);
    }

    public function mawbQty()
    {
        # 总单货量统计
        echo "mawb quantity stats";
    }
}
 