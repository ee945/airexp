<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getContact($contactcode)
    {
        # code...
        $contact = Contact::where('code',$contactcode)->first();
        return $contact;
    }

    public function lists(Request $request)
    {
        ## 显示联系人列表
        $title = "联系人列表";

        // 获取表单搜索条件
        $search = $request->all();
        // 获取全部联系人记录，按姓名排序
        $query = Contact::where('status','>',0)->orderBy('status','desc')->orderBy('name','asc');
        // 逐一判断是否有筛选条件
        if(isset($search['search_code'])&&$search['search_code']!="")
            $query->where('code','like','%'.$search['search_code'].'%');
        if(isset($search['search_name'])&&$search['search_name']!="")
            $query->where('name','like','%'.$search['search_name'].'%');
        if(isset($search['search_company'])&&$search['search_company']!="")
            $query->where('company','like','%'.$search['search_company'].'%');
        if(isset($search['search_title'])&&$search['search_title']!="")
            $query->where('title','like','%'.$search['search_title'].'%');
        if(isset($search['search_mobile'])&&$search['search_mobile']!="")
            $query->where('mobile','like','%'.$search['search_mobile'].'%');
        // 按perpage值进行分页
        $contacts = $query->paginate(isset($search['perpage'])?$search['perpage']:40);
        // 返回联系人列表视图 - 传入参数（联系人记录集合、网页title，以及查询条件）
        return view(theme("contact.list"),compact('contacts','title'))->with($search);
    }

    public function show($id)
    {
        ## 查看或修改联系人
        $title = "修改联系人";
        $contact = Contact::find($id);
        return view(theme("contact.form"), compact('contact','title'));
    }

    public function add()
    {
        ## 添加联系人
        $title = "添加联系人";

        return view(theme("contact.form"), compact('title'));
    }

    public function create(Request $request)
    {
        ## 新建联系人 post
        // 自定义验证规则
        $this->validate($request,[
            'code' => 'unique:contacts,code',
            'name' => 'required',
            'company'=>'required',
            'mail'=>'email',
        ]);
        Contact::create($request->all());
        return redirect(route('contact_list',['addname'=>$request->get('name')]));
    }

    public function update($id,Request $request)
    {
        ## 修改联系人 post
        // 自定义验证规则
        $contact = Contact::find($id);
        if($contact->code != $request->code){
        	$this->validate(request(),[
                'code' => 'unique:contacts,code',
        	]);
        }
        $this->validate(request(),[
            'name' => 'required',
            'company'=>'required',
            'mail'=>'email',
            'status'=>'required|integer|min:1',
        ]);
        // 判断执行结果，并提示更新成功+返回列表，否则直接返回列表
        $query = Contact::where('id',$contact->id)->update($request->except(['_token']));
        if($query=='1'){
            return redirect(route('contact_view',['id'=>$id,'update'=>'yes']));
        }else{
            return redirect(route('contact_view',['id'=>$id]));
        }
    }

    public function delete($id)
    {
        ## 删除联系人 get
        $contact = Contact::find($id);
        // 判断查询结果，找到则执行删除，并提示删除成功+返回列表，否则直接返回列表
        if($contact){
            $contact->delete();
            return redirect(route('contact_list',['del'=>'yes','delname'=>$contact->name]));
        }else{
            return redirect(route('contact_list',['del'=>'no','delno'=>$id]));
        }
    }
}
