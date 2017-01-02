<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Port;

class PortController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function getPort($dest)
    {
    	# code...
    	$port = Port::where('code',$dest)->first();
    	return $port;
    }

    public function lists(Request $request)
    {
        ## 显示目的港列表
        $title = "目的港列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部目的港记录，按代码排序
        $query = Port::orderBy('code','asc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_code'])&&$search['search_code']!="")
            $query->where('code','like','%'.$search['search_code'].'%');
        if(isset($search['search_name'])&&$search['search_name']!="")
            $query->where('name','like','%'.$search['search_name'].'%');
        if(isset($search['search_zone'])&&$search['search_zone']!="")
            $query->where('zone','like','%'.$search['search_zone'].'%');
        // 按perpage值进行分页
        $ports = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // 返回目的港列表视图 - 传入参数（目的港记录集合、网页title，以及查询条件）
        return view(theme("port.list"),compact('ports','title'))->with($search);
    }

    public function show($code)
    {
        ## 查看或修改目的港
        $title = "修改目的港";

        $port = Port::where('code',$code)->first();
        // 找不到该目的港则返回列表页
        if(empty($code))return redirect(route('port_list'));
        return view(theme("port.form"), compact('port','title'));
    }

    public function add()
    {
        ## 添加目的港
        $title = "添加目的港";

        return view(theme("port.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建目的港 post
        // 自定义验证规则
        $this->validate($request,[
            'code' => 'required|unique:exp_port,code',
            'name' => 'required',
            'zone'=>'required',
        ]);
        port::create($request->all());
        return redirect(route('port_list',['addno'=>$request->get('code')]));
    }

    public function update(Request $request)
    {
        ## 修改目的港 post
        $code = $request->get('code');
        // 自定义验证规则
        $this->validate($request,[
            'name' => 'required',
            'zone'=>'required',
        ]);
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Port::where('code',$code)->update($request->except(['_token']));
        if($query=='1'){
            return redirect(route('port_view',['code'=>$code,'update'=>'yes']));
        }else{
            return redirect(route('port_view',['code'=>$code]));
        }
    }

    public function delete($code)
    {
        ## 删除目的港 get
        $res = Port::where('code',$code)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Port::where('code',$code)->delete();
            return redirect(route('port_list',['del'=>'yes','delno'=>$code]));
        }else{
            return redirect(route('port_list',['del'=>'no','delno'=>$code]));
        }
    }
}
