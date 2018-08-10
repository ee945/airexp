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

    public function show($cata,$code)
    {
        ## 查看或修改地址
        $title = "修改地址";

        $addr = Address::where('code',$code)->where('cata',$cata)->first();
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
            'code' => 'required',
            'name' => 'required',
            'addr'=>'required',
            'cata'=>'required',
        ]);
        // 查找同类中是否已存在该地址代码
        $newaddr = Address::where('cata',$request->get('cata'))->where('code',$request->get('code'))->first();
        if(!empty($newaddr)){
            echo "<script>alert('".$request->get('cata')." 已存在 ".$request->get('code')."');history.back(-1)</script>";
        }else{
            Address::create($request->all());
            return redirect(route('address_list',['cata'=>$request->get('cata'),'addno'=>$request->get('code')]));
        }
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
        // 根据代码和分类查询当前已有结果
        $query = Address::where('code',$code)->where('cata',$request->get('cata'));
        // 统计查询个数
        $querycount = $query->count();
        // 取得查询记录id（未找到则默认设为0）
        $queryid = $query->first() != null?$query->first()->id:0;
        // 取得当前记录id
        $requestid = $request->get('id');
        // 判断查询结果：未找到已存在记录 或 修改当前记录，则按id号执行更新，否则提示已存在并返回
        if($querycount=="0" or $queryid == $requestid){
            $queryupdate = Address::where('id',$request->get('id'))->update($request->except(['_token']));
            return redirect(route('address_view',['cata'=>$request->get('cata'),'code'=>$code,'update'=>'yes']));
        }else{
            echo "<script>alert('".$request->get('cata')." 已存在 ".$request->get('code')."');history.back(-1)</script>";
        }
    }

    public function delete($cata,$code)
    {
        ## 删除地址 get
        $res = Address::where('code',$code)->where('cata',$cata)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Address::where('code',$code)->where('cata',$cata)->delete();
            return redirect(route('address_list',['del'=>'yes','delno'=>$code]));
        }else{
            return redirect(route('address_list',['del'=>'no','delno'=>$code]));
        }
    }
}
