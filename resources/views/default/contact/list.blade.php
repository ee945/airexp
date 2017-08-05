@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if(isset($del))
          @if($del=="yes")
          <div class="alert alert-warning" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除成功: &nbsp;{{ $delname }}&nbsp;已删除</strong>
          </div>
          @elseif($del=="no")
          <div class="alert alert-danger" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除失败: 编号&nbsp;{{ $delno }}&nbsp;未找到</strong>
          </div>
          @endif
        @endif
        @if(isset($addno))
          <div class="alert alert-success" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>输入成功: &nbsp;<a href="{{ route('contact_view',['code'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_code', '代码: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_name', '姓名: ') !!}
            </td>
            <td width=13% style="vertical-align:middle">
              {!! Form::label('search_company', '公司: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_title', '职位: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_mobile', '手机: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('perpage', '每页显示: ') !!}
            </td>
            <td class="text-center" width=8%>
              {!! Form::submit('查询', ['class' => 'form-control']) !!}
            </td>
            <td class="text-center" width=8%>
              <button type="button" onclick="reset_search()" class="form-control">重置</button>
            </td>
          </tr>
          <tr>
            <td>
              {!! Form::text('search_code',isset($search_code)?$search_code:null,['size'=>'6', 'class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_name',isset($search_name)?$search_name:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_company',isset($search_company)?$search_company:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_title',isset($search_title)?$search_title:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_mobile',isset($search_mobile)?$search_mobile:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('perpage',isset($perpage)?$perpage:40,['size'=>'4','class' => 'form-control']) !!}
            </td>
            <td colspan="2">
              <button type="button" onClick="location.href='{!! route('contact_add') !!}'" class="form-control btn-primary">添加联系人</button>
            </td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="width:90%;margin: 0 auto;">
          <thead>
            <tr>
              <th class="text-center" width=10%>代码</th>
              <th class="text-center" width=12%>姓名</th>
              <th class="text-center" width=12%>公司</th>
              <th class="text-center" width=13%>职位</th>
              <th class="text-center" width=16%>手机</th>
              <th class="text-center" width=16%>座机</th>
              <th class="text-center" width=14%>IM</th>
              <th class="text-center" width=7%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($contacts as $contact)
            <tr>
              <td>{{ $contact->code }}</td>
              <td><a href="{{ route('contact_view',['code'=>$contact->id])}}">{{ $contact->name }}</a></td>
              <td>{{ $contact->company }}</td>
              <td>{{ $contact->title }}</td>
              <td>{{ $contact->mobile }}</td>
              <td>{{ $contact->tel }}</td>
              <td>{{ $contact->im }}</td>
              <td class="text-center">
                <a href="{{ route('contact_del',['id'=>$contact->id])}}" onclick="if(confirm('确定删除&nbsp;“{{$contact->name}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $contacts->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_code').value=null;
      document.getElementById('search_name').value=null;
      document.getElementById('search_company').value=null;
      document.getElementById('search_title').value=null;
      document.getElementById('search_mobile').value=null;
    }
  </script>
@stop