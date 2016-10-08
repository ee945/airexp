<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mawb;

class MawbController extends Controller
{

	public function lists(Request $request)
	{
		## 显示总单列表
        $title = "总单列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部总单记录，按航班日期、添加时间排序
        $query = Mawb::orderBy('fltdate','desc')->orderBy('regtime','desc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_mawb'])&&$search['search_mawb']!="")
            $query->where('mawb','like','%'.$search['search_mawb'].'%');
        if(isset($search['search_dest'])&&$search['search_dest']!="")
            $query->where('dest','like','%'.$search['search_dest'].'%');
        if(isset($search['search_consignee'])&&$search['search_consignee']!="")
            $query->where('consignee','like','%'.$search['search_consignee'].'%');
        if(isset($search['search_fltno'])&&$search['search_fltno']!="")
            $query->where('fltno','like','%'.$search['search_fltno'].'%');
        if(isset($search['search_fltstart'])&&$search['search_fltstart']!="")
            $query->where('fltdate','>=',$search['search_fltstart']);
        if(isset($search['search_fltend'])&&$search['search_fltend']!="")
            $query->where('fltdate','<=',$search['search_fltend']);
        if(isset($search['search_carrier'])&&$search['search_carrier']!="")
            $query->where('carrier','like','%'.$search['search_carrier'].'%');
        if(isset($search['search_oversea'])&&$search['search_oversea']!="")
            $query->where('oversea','like','%'.$search['search_oversea'].'%');
        // 按perpage值进行分页
        $mawbs = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // 统计当前显示的总和 - 件数、实际重量、收费重量、体积
        $total_num = $mawbs->sum('num');
        $total_gw = $mawbs->sum('gw');
        $total_cw = $mawbs->sum('cw');
        $total_cbm = $mawbs->sum('cbm');
        // 返回总单列表视图 - 传入参数（总单记录集合、网页title、统计总和，以及查询条件）
		return view(theme("mawb.list"),compact('mawbs','title','total_num','total_gw','total_cw','total_cbm'))->with($search);
	}

    public function mawbPrint($mawb)
    {
        ## 总单打印
        $title = "总单打印";

        $mawb = Mawb::where('mawb',$mawb)->first();
        // 找不到该总单则返回列表页
        // if(empty($mawb))return redirect(route('mawb_list'));

        // 新建默认数组data[]，用于预设表单
        $data = [];

        // 固定设置

        // 通用预设

        return view(theme("mawb.mawb"), compact('mawb','title'))->with($data);
    }

    public function mawbSavePrint(Request $request)
    {
        # 保存打印总单 post
        $mawb = $request->get('mawb');
        // 自定义验证规则
        $this->validate($request,[
            'shipper'=>'required',
            'consignee'=>'required',
            'notify'=>'required',
            'rclass'=>'required|in:M,N,Q',
            'cgodescp'=>'required'
        ]);
        // 按总单号更新总单信息
        $query = Mawb::where('mawb',$mawb)->update($request->except(['_token','shippercode','consigneecode','notifycode','fltprefix','operator']));
        // 保存成功则提示成功信息，并返回总单列表，否则直接返回列表
        if($query=='1'){
            return redirect(route('mawb_print',['mawb'=>$mawb,'save'=>'yes']));
        }else{
            return redirect(route('mawb_print',['mawb'=>$mawb]));
        }
    }
}
