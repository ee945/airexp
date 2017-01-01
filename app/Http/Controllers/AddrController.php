<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Address;

class AddrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function getHShipper($shippercode)
    {
    	# code...
    	$shipper = Address::where('code',$shippercode)->where('cata','分单发货人')->first();
    	return $shipper;
    }
    public function getHConsignee($consigneecode)
    {
    	# code...
    	$consignee = Address::where('code',$consigneecode)->where('cata','分单收货人')->first();
    	return $consignee;
    }
    public function getHNotify($notifycode)
    {
    	# code...
    	$notify = Address::where('code',$notifycode)->where('cata','分单通知人')->first();
    	return $notify;
    }
    public function getMConsignee($oversea)
    {
        # code...
        $consignee = Address::where('code',$oversea)->where('cata','总单收货人')->first();
        return $consignee;
    }

    public function lists(Request $request)
    {
        ## 显示地址列表
        $title = "地址列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部地址记录，按代码排序
        $query = Address::orderBy('code','asc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_code'])&&$search['search_code']!="")
            $query->where('code','like','%'.$search['search_code'].'%');
        if(isset($search['search_name'])&&$search['search_name']!="")
            $query->where('name','like','%'.$search['search_name'].'%');
        if(isset($search['search_addr'])&&$search['search_addr']!="")
            $query->where('addr','like','%'.$search['search_addr'].'%');
        if(isset($search['search_cata'])&&$search['search_cata']!="")
            $query->where('cata',$search['search_cata']);
        if(isset($search['search_remark'])&&$search['search_remark']!="")
            $query->where('remark','like','%'.$search['search_remark'].'%');
        // 按perpage值进行分页
        $addrs = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // 返回地址列表视图 - 传入参数（地址记录集合、网页title，以及查询条件）
        return view(theme("address.list"),compact('addrs','title'))->with($search);
    }

    public function show($code)
    {
        ## 查看或修改地址
        $title = "修改地址";

        $addr = Address::where('code',$code)->first();
        // 找不到该地址则返回列表页
        if(empty($code))return redirect(route('address_list'));
        return view(theme("address.form"), compact('addr','title'));
    }

    public function add()
    {
        ## 添加地址
        $title = "添加地址";

        return view(theme("address.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建地址 post
        // 自定义验证规则
        $this->validate($request,[
            'code' => 'required|unique:exp_address,code',
            'name' => 'required',
            'addr'=>'required',
            'cata'=>'required',
        ]);
        Address::create($request->all());
        return redirect(route('address_list',['addno'=>$request->get('code')]));
    }

    public function update(Request $request)
    {
        ## 修改地址 post
        $code = $request->get('code');
        // 自定义验证规则
        $this->validate($request,[
            'name' => 'required',
            'addr'=>'required',
            'cata'=>'required',
        ]);
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Address::where('code',$code)->update($request->except(['_token']));
        if($query=='1'){
            return redirect(route('address_view',['code'=>$code,'update'=>'yes']));
        }else{
            return redirect(route('address_view',['code'=>$code]));
        }
    }

    public function delete($code)
    {
        ## 删除分单 get
        $res = Address::where('code',$code)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Address::where('code',$code)->delete();
            return redirect(route('address_list',['del'=>'yes','delno'=>$code]));
        }else{
            return redirect(route('address_list',['del'=>'no','delno'=>$code]));
        }
    }
}
