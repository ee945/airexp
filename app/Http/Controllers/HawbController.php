<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;
use Request;

class HawbController extends Controller
{

	public function lists()
	{
		## 显示分单列表
        $title = "分单列表";

        # 获取表单搜索条件
        $search = Request::all();
        # 获取全部分单记录，按航班日期、添加时间排序
        $query = Hawb::orderBy('fltdate','desc')->orderBy('regtime','desc');
        # 逐一判断是否有筛选条件
        if(isset($search['search_hawb'])&&$search['search_hawb']!="")
            $query->where('hawb','like','%'.$search['search_hawb'].'%');
        if(isset($search['search_dest'])&&$search['search_dest']!="")
            $query->where('dest','like','%'.$search['search_dest'].'%');
        if(isset($search['search_fltno'])&&$search['search_fltno']!="")
            $query->where('fltno','like','%'.$search['search_fltno'].'%');
        if(isset($search['search_forward'])&&$search['search_forward']!="")
            $query->where('forward','like','%'.$search['search_forward'].'%');
        if(isset($search['search_factory'])&&$search['search_factory']!="")
            $query->where('factory','like','%'.$search['search_factory'].'%');
        if(isset($search['search_paymt'])&&$search['search_paymt']!="")
            $query->where('paymt','like','%'.$search['search_paymt'].'%');
        if(isset($search['search_mawb'])&&$search['search_mawb']!="")
            $query->where('mawb','like','%'.$search['search_mawb'].'%');
        if(isset($search['search_carrier'])&&$search['search_carrier']!="")
            $query->where('carrier','like','%'.$search['search_carrier'].'%');
        if(isset($search['search_consignee'])&&$search['search_consignee']!="")
            $query->where('consignee','like','%'.$search['search_consignee'].'%');
        if(isset($search['search_seller'])&&$search['search_seller']!="")
            $query->where('seller','like','%'.$search['search_seller'].'%');
        if(isset($search['search_fltstart'])&&$search['search_fltstart']!="")
            $query->where('fltdate','>=',$search['search_fltstart']);
        if(isset($search['search_fltend'])&&$search['search_fltend']!="")
            $query->where('fltdate','<=',$search['search_fltend']);
        # 按perpage值进行分页
        $hawbs = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        # 统计当前显示的总和 - 件数、实际重量、收费重量、体积
        $total_num = $hawbs->sum('num');
        $total_gw = $hawbs->sum('gw');
        $total_cw = $hawbs->sum('cw');
        $total_cbm = $hawbs->sum('cbm');
        #返回分单列表视图 - 传入参数（分单记录集合、网页title、统计总和，以及查询条件）
		return view(theme("hawb.list"),compact('hawbs','title','total_num','total_gw','total_cw','total_cbm'))->with($search);
	}
    //
    public function show($hawb)
    {
        ## 分单修改
        $title = "分单修改";

    	$hawb = Hawb::where('hawb',$hawb)->first();
        return view(theme("hawb.form"), compact('hawb','title'));
        // dd($hawb->paymt);
    }

    public function add()
    {
        ## 分单输入
        $title = "分单输入";

        return view(theme("hawb.form"), compact('title'));
    }

    public function store()
    {
        # code...
        $hawb = Request::get('hawb');
        $res = Hawb::where('hawb',$hawb)->first();
        if($res){
            Hawb::update(Request::all());
            return redirect(route('hawb_view',$hawb));
        }else{
            Hawb::create(Request::all());
            return redirect(route('hawb_list'));
        }
    }
}
