<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Jincang;

class JincangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lists(Request $request)
    {
        ## 显示进仓列表
        $title = "进仓列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部进仓单记录，按托运日期、航班日期排序
        $query = Jincang::orderBy('jcno','desc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_jcno'])&&$search['search_jcno']!="")
            $query->where('jcno','like','%'.$search['search_jcno'].'%');
        if(isset($search['search_dest'])&&$search['search_dest']!="")
            $query->where('dest','like','%'.$search['search_dest'].'%');
        if(isset($search['search_client'])&&$search['search_client']!="")
            $query->where('client','like','%'.$search['search_client'].'%');
        if(isset($search['search_forward'])&&$search['search_forward']!="")
            $query->where('forward','like','%'.$search['search_forward'].'%');
        if(isset($search['search_factory'])&&$search['search_factory']!="")
            $query->where('factory','like','%'.$search['search_factory'].'%');
        if(isset($search['search_carrier'])&&$search['search_carrier']!="")
            $query->where('carrier','like','%'.$search['search_carrier'].'%');
        if(isset($search['search_delivery'])&&$search['search_delivery']!="")
            $query->where('delivery','like','%'.$search['search_delivery'].'%');
        if(isset($search['search_cargodata'])&&$search['search_cargodata']!="")
            $query->where('cargodata','like','%'.$search['search_cargodata'].'%');
        if(isset($search['search_remark'])&&$search['search_remark']!="")
            $query->where('remark','like','%'.$search['search_remark'].'%');
        if(isset($search['search_fltstart'])&&$search['search_fltstart']!="")
            $query->where('fltdate','>=',$search['search_fltstart']);
        if(isset($search['search_fltend'])&&$search['search_fltend']!="")
            $query->where('fltdate','<=',$search['search_fltend']);
        if(isset($search['search_regstart'])&&$search['search_regstart']!="")
            $query->where('regdate','>=',$search['search_regstart']);
        if(isset($search['search_regend'])&&$search['search_regend']!="")
            $query->where('regdate','<=',$search['search_regend']);
        // 按perpage值进行分页
        $jincangs = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // 返回进仓单列表视图 - 传入参数（进仓单记录集合、网页title，以及查询条件）
        return view(theme("jincang.list"),compact('jincangs','title'))->with($search);
    }

    public function show($jcno)
    {
        ## 进仓登记信息
        $title = "进仓修改";

        $jincang = Jincang::where('jcno',$jcno)->first();
        // 找不到该进仓编号则返回列表页
        if(empty($jcno))return redirect(route('jincang_list'));
        return view(theme("jincang.form"), compact('jincang','title'));
    }

    public function add()
    {
        ## 进仓登记输入
        $title = "进仓登记";

        return view(theme("jincang.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建进仓单 post
        // 自定义验证规则
        $this->validate($request,[
            'regdate' => 'required|date',
            'jcno' => 'required|unique:exp_jincang,jcno|regex:/^[0-9A-Z-]{6,12}$/',
            'forward'=>'required',
        ]);
        Jincang::create($request->all());
        return redirect(route('jincang_list',['addno'=>$request->get('jcno')]));
    }

    public function update(Request $request)
    {
        ## 更新进仓单 post
        $jcno = $request->get('jcno');
        // 自定义验证规则
        $this->validate($request,[
            'regdate' => 'required|date',
            'forward'=>'required',
        ]);
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Jincang::where('jcno',$jcno)->update($request->except(['_token','forwardcode','factorycode']));
        if($query=='1'){
            return redirect(route('jincang_view',['jcno'=>$jcno,'update'=>'yes']));
        }else{
            return redirect(route('jincang_view',['jcno'=>$jcno]));
        }
    }

    public function delete($jcno)
    {
        ## 删除分单 get
        $res = Jincang::where('jcno',$jcno)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Jincang::where('jcno',$jcno)->delete();
            return redirect(route('jincang_list',['del'=>'yes','delno'=>$jcno]));
        }else{
            return redirect(route('jincang_list',['del'=>'no','delno'=>$jcno]));
        }
    }
}
