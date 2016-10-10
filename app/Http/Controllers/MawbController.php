<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mawb;
use App\Hawb;
use Illuminate\Support\Facades\DB;

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

    public function mawbPrint($mawbno)
    {
        ## 总单打印
        $title = "总单打印";

        $mawb = Mawb::where('mawb',$mawbno)->first();
        // 找不到该总单则返回列表页
        if(empty($mawb)){
            $mawb = Hawb::where('mawb', $mawbno)
                ->select('mawb',DB::raw('SUM(num) as num'),DB::raw('SUM(gw) as gw'),'dest','desti','fltno','fltdate','opdate','depar')
                ->groupBy('mawb')
                ->first();
            if(empty($mawb))return redirect(route('mawb_list'));
            // 预设表单 - 通用
            $mawb->shipper = str_replace('\n',"\n",env("CONF_AGENT_ADDR","COMPANY NAME\nADDRESS"));
            $mawb->carrier = substr($mawb->fltno,0,2);
            $mawb->cgodescp = "CONSOL CARGO";
            $mawb->atplace = "SHANGHAI";
            $mawb->signature = env('CONF_AGENT_CODE', 'CODE').'/SHA';
            $mawb->operator = "";
            $mawb->aw = 50;
            // 预设表单 - 条件判断
            if(substr($mawb->mawb,0,3) == "999"){
                // 根据运单判断制单费油战险名称代码
                $mawb->awn="AWC";
                $mawb->myn="MYC";
                $mawb->scn="MSC";
            }
        }

        return view(theme("mawb.mawb"), compact('mawb','title'));
    }

    public function mawbSavePrint(Request $request)
    {
        # 保存打印总单 post
        $mawbno = $request->get('mawb');
        // 自定义验证规则
        $this->validate($request,[
            'mawb'=>'required',
            'shipper'=>'required',
            'consignee'=>'required',
            'fltno'=>'required|regex:/^[A-Z0-9]{2}\d{3,4}$/',
            'fltdate'=>'required|date',
            'package'=>'required',
            'num'=>'required|integer',
            'gw'=>'required|integer',
            'cw'=>'required|integer',
            'up'=>'required|numeric',
            'cgodescp'=>'required',
            'cbm'=>'required|numeric',
            'awn'=>'alpha',
            'myn'=>'alpha',
            'scn'=>'alpha',
            'aw'=>'required|numeric',
            'myup'=>'numeric',
            'scup'=>'numeric',
            'my'=>'numeric',
            'sc'=>'numeric',
            'rclass'=>'required|in:M,N,Q',
            'opdate'=>'required|date',
            'atplace'=>'required',
            // 'operator'=>'required',
        ]);
        $mawb = Mawb::where('mawb',$mawbno)->first();
        // 查找总单表，没有则创建，有则更新
        if(empty($mawb)){
            Mawb::create($request->all());
        }else{
            Mawb::where('mawb',$mawbno)->update($request->except(['_token','curr']));
        }
        // 保存成功则提示成功信息，并返回总单列表，否则直接返回列表
        return redirect(route('mawb_print',['mawb'=>$mawbno,'save'=>'yes']));
    }
}
