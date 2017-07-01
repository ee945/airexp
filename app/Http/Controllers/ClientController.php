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
        // 返回客户列表视图 - 传入参数（客户记录集合、网页title，以及查询条件）
        return view(theme("client.list"),compact('clients','title'))->with($search);
    }

    public function show($code)
    {
        ## 查看或修改客户
        $title = "修改客户";

        $client = Client::where('code',$code)->first();
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
            'code' => 'required|unique:addresses,code',
            'name' => 'required',
            'cata'=>'required',
        ]);
        Client::create($request->all());
        return redirect(route('client_list',['addno'=>$request->get('code')]));
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
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Client::where('code',$code)->update($request->except(['_token']));
        if($query=='1'){
            return redirect(route('client_view',['code'=>$code,'update'=>'yes']));
        }else{
            return redirect(route('client_view',['code'=>$code]));
        }
    }

    public function delete($code)
    {
        ## 删除客户 get
        $res = Client::where('code',$code)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Client::where('code',$code)->delete();
            return redirect(route('client_list',['del'=>'yes','delno'=>$code]));
        }else{
            return redirect(route('client_list',['del'=>'no','delno'=>$code]));
        }
    }
}
