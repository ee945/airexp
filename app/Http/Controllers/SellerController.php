<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Seller;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function getSeller($forward)
    {
    	# code...
    	$seller = Seller::where('forward',$forward)->first();
    	return $seller;
    }

    public function lists(Request $request)
    {
        ## 显示销售列表
        $title = "销售列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部销售记录，按代码排序
        $query = Seller::orderBy('forward','asc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_forward'])&&$search['search_forward']!="")
            $query->where('forward','like','%'.$search['search_forward'].'%');
        if(isset($search['search_seller'])&&$search['search_seller']!="")
            $query->where('seller','like','%'.$search['search_seller'].'%');
        if(isset($search['search_remark'])&&$search['search_remark']!="")
            $query->where('remark','like','%'.$search['search_remark'].'%');
        // 按perpage值进行分页
        $sellers = $query->paginate(isset($search['perpage'])?$search['perpage']:20);
        // dd($sellers);
        // 返回销售列表视图 - 传入参数（销售记录集合、网页title，以及查询条件）
        return view(theme("seller.list"),compact('sellers','title'))->with($search);
    }

    public function show($forward)
    {
        ## 查看或修改销售分配
        $title = "修改销售分配";

        $seller = Seller::where('forward',$forward)->first();
        // dd($seller);
        // 找不到该销售则返回列表页
        if(empty($forward))return redirect(route('seller_list'));
        return view(theme("seller.form"), compact('seller','title'));
    }

    public function add()
    {
        ## 添加销售分配
        $title = "添加销售分配";

        return view(theme("seller.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建销售分配 post
        // 自定义验证规则
        $this->validate($request,[
            'forward' => 'required|unique:sellers,forward',
            'seller' => 'required',
        ]);
        Seller::create($request->all());
        return redirect(route('seller_list',['addno'=>$request->get('forward')]));
    }

    public function update(Request $request)
    {
        ## 修改销售分配 post
        $forward = $request->get('forward');
        // 自定义验证规则
        $this->validate($request,[
            'seller' => 'required',
        ]);
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Seller::where('forward',$forward)->update($request->except(['_token']));
        if($query=='1'){
            return redirect(route('seller_view',['forward'=>$forward,'update'=>'yes']));
        }else{
            return redirect(route('seller_view',['forward'=>$forward]));
        }
    }

    public function delete($forward)
    {
        ## 删除销售分配 get
        $res = Seller::where('forward',$forward)->first();
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($res){
            Seller::where('forward',$forward)->delete();
            return redirect(route('seller_list',['del'=>'yes','delno'=>$forward]));
        }else{
            return redirect(route('seller_list',['del'=>'no','delno'=>$forward]));
        }
    }
}
