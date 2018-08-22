<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function getForward($forwardcode)
    {
    	# code...
    	$forward = Client::where('code',$forwardcode)->where('cata','货源')->first();
    	return $forward;
    }

    public function getFactory($factorycode)
    {
    	# code...
    	$factory = Client::where('code',$factorycode)->where('cata','生产单位')->first();
    	return $factory;
    }

    public function getCarrierName($carrier)
    {
    	# code...
    	$carriername = Client::where('code',$carrier)->where('cata','承运人')->first();
    	return $carriername;
    }

    public function lists(Request $request)
    {
        ## 显示客户列表
        $title = "客户列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部客户记录，按代码排序
        $query = Client::orderBy('code','asc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_code'])&&$search['search_code']!="")
            $query->where('code','like','%'.$search['search_code'].'%');
        if(isset($search['search_name'])&&$search['search_name']!="")
            $query->where('name','like','%'.$search['search_name'].'%');
        if(isset($search['search_cata'])&&$search['search_cata']!="")
            $query->where('cata',$search['search_cata']);
        // 按perpage值进行分页
        $clients = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        $total_count = $clients->count('id');
        // 返回客户列表视图 - 传入参数（客户记录集合、网页title，以及查询条件）
        return view(theme("client.list"),compact('clients','title','total_count'))->with($search);
    }

    public function show($cata,$code)
    {
        ## 查看或修改客户
        $title = "修改客户";

        $client = Client::where('code',$code)->where('cata',$cata)->first();
        // 找不到该客户则返回列表页
        if(empty($code))return redirect(route('client_list'));
        return view(theme("client.form"), compact('client','title'));
    }

    public function add()
    {
        ## 添加客户
        $title = "添加客户";

        return view(theme("client.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建客户 post
        // 自定义验证规则
        $this->validate($request,[
            'code' => 'required',
            'name' => 'required',
            'cata'=>'required',
        ]);
        // 查找同类中是否已存在该客户代码
        $newclient = Client::where('cata',$request->get('cata'))->where('code',$request->get('code'))->first();
        if(!empty($newclient)){
            echo "<script>alert('".$request->get('cata')." 已存在 ".$request->get('code')."');history.back(-1)</script>";
        }else{
            Client::create($request->all());
            return redirect(route('client_list',['cata'=>$request->get('cata'),'addno'=>$request->get('code')]));
        }
    }

    public function update(Request $request)
    {
        ## 修改客户 post
        $code = $request->get('code');
        // 自定义验证规则
        $this->validate($request,[
            'name' => 'required',
            'cata'=>'required',
        ]);
        // 根据代码和分类查询当前已有结果
        $query = Client::where('code',$code)->where('cata',$request->get('cata'));
        // 统计查询个数
        $querycount = $query->count();
        // 取得查询记录id（未找到则默认设为0）
        $queryid = $query->first() != null?$query->first()->id:0;
        // 取得当前记录id
        $requestid = $request->get('id');
        // 判断查询结果：未找到已存在记录 或 修改当前记录，则按id号执行更新，否则提示已存在并返回
        if($querycount=="0" or $queryid == $requestid){
            $queryupdate = Client::where('id',$request->get('id'))->update($request->except(['_token']));
            return redirect(route('client_view',['cata'=>$request->get('cata'),'code'=>$code,'update'=>'yes']));
        }else{
            echo "<script>alert('".$request->get('cata')." 已存在 ".$request->get('code')."');history.back(-1)</script>";
        }
    }

    public function delete($cata,$code)
    {
        ## 删除客户 get
        $res = Client::where('code',$code)->where('cata',$cata)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Client::where('code',$code)->where('cata',$cata)->delete();
            return redirect(route('client_list',['del'=>'yes','delno'=>$code]));
        }else{
            return redirect(route('client_list',['del'=>'no','delno'=>$code]));
        }
    }
}
