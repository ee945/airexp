<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\CreateHawbRequest;
use App\Http\Requests\UpdateHawbRequest;
use App\Hawb;

class HawbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFltdate($hawb)
    {
        # code...
        $fltdate = Hawb::where('hawb',$hawb)->first();
        return $fltdate;
    }

    public function lists(Request $request)
    {
		## 显示分单列表
        $title = "分单列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部分单记录，按航班日期、添加时间排序
        $query = Hawb::orderBy('fltdate','desc')->orderBy('regtime','desc')->orderBy('created_at','desc');
        // 逐一判断是否有筛选条件
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
        // 按perpage值进行分页
        $hawbs = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // 统计当前显示的总和 - 件数、实际重量、收费重量、体积
        $total_count = $hawbs->count('hawb');
        $total_num = $hawbs->sum('num');
        $total_gw = $hawbs->sum('gw');
        $total_cw = $hawbs->sum('cw');
        $total_cbm = $hawbs->sum('cbm');
        // 返回分单列表视图 - 传入参数（分单记录集合、网页title、统计总和，以及查询条件）
		return view(theme("hawb.list"),compact('hawbs','title','total_count','total_num','total_gw','total_cw','total_cbm'))->with($search);
	}

    public function show($hawb)
    {
        ## 分单修改
        $title = "分单修改";

    	$hawb = Hawb::where('hawb',$hawb)->first();
        // 找不到该分单则返回列表页
        if(empty($hawb))return redirect(route('hawb_list'));
        return view(theme("hawb.form"), compact('hawb','title'));
    }

    public function add()
    {
        ## 分单输入
        $title = "分单输入";

        return view(theme("hawb.form"), compact('title'));
    }

    public function create(CreateHawbRequest $request)
    {
        ## 新建分单 post
        Hawb::create($request->all());
        return redirect(route('hawb_list',['addno'=>$request->get('hawb')]));
    }

    public function update(UpdateHawbRequest $request)
    {
        ## 更新分单 post
        $hawb = $request->get('hawb');
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Hawb::where('hawb',$hawb)->update($request->except(['_token','forwardcode','factorycode']));
        if($query=='1'){
            return redirect(route('hawb_view',['hawb'=>$hawb,'update'=>'yes']));
        }else{
            return redirect(route('hawb_view',['hawb'=>$hawb]));
        }
    }

    public function delete($hawb)
    {
        ## 删除分单 get
        $res = Hawb::where('hawb',$hawb)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Hawb::where('hawb',$hawb)->delete();
            return redirect(route('hawb_list',['del'=>'yes','delno'=>$hawb]));
        }else{
            return redirect(route('hawb_list',['del'=>'no','delno'=>$hawb]));
        }
    }

    public function hawbPrint($hawb)
    {
        ## 分单打印
        $title = "分单打印";

        $hawb = Hawb::where('hawb',$hawb)->first();
        // 找不到该分单则返回列表页
        if(empty($hawb))return redirect(route('hawb_list'));

        // 新建默认数组data[]，用于预设表单
        $data = [];

        // 固定设置
        switch($hawb->paymt){
        case 'PP':
          $data['curr']="CNY";
          $data['wtp']="P";
          $data['wtc']="";
          $data['otp']="P";
          $data['otc']="";
          break;
        case 'CP':
          $data['curr']="USD";
          $data['wtp']="";
          $data['wtc']="C";
          $data['otp']="P";
          $data['otc']="";
          break;
        case 'CC':
          $data['curr']="USD";
          $data['wtp']="";
          $data['wtc']="C";
          $data['otp']="";
          $data['otc']="C";
          break;
        case 'PC':
          $data['curr']="CNY";
          $data['wtp']="P";
          $data['wtc']="";
          $data['otp']="";
          $data['otc']="C";
          break;
        }

        // 通用预设
        $data['depar']="SHANGHAI";
        $data['notify']="SAME AS CONSIGNEE";
        $data['nvd']="NVD.";
        $data['ncv']="";
        $data['agentabbr']=env('CONF_AGENT_CODE', 'CODE').'/SHA';

        return view(theme("hawb.hawb"), compact('hawb','title'))->with($data);
    }

    public function hawbSavePrint(Request $request)
    {
        # 保存打印分单 post
        $hawb = $request->get('hawb');
        // 自定义验证规则
        $this->validate($request,[
            'shipper'=>'required',
            'consignee'=>'required',
            'notify'=>'required',
            'rclass'=>'required|in:M,N,Q',
            'cgodescp'=>'required'
        ]);
        // 按分单号更新分单信息
        $query = Hawb::where('hawb',$hawb)->update($request->except(['_token','shippercode','consigneecode','notifycode','fltprefix','operator']));
        // 保存成功则提示成功信息，并返回分单列表，否则直接返回列表
        if($query=='1'){
            return redirect(route('hawb_print',['hawb'=>$hawb,'save'=>'yes']));
        }else{
            return redirect(route('hawb_print',['hawb'=>$hawb]));
        }
    }
}
