@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if(isset($del))
          @if($del=="yes")
          <div class="alert alert-warning" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除成功: &nbsp;{{ $delno }}&nbsp;已删除</strong>
          </div>
          @elseif($del=="no")
          <div class="alert alert-danger" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除失败: &nbsp;{{ $delno }}&nbsp;未找到</strong>
          </div>
          @endif
        @endif
        @if(isset($addno))
          <div class="alert alert-success" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>输入成功: &nbsp;<a href="{{ route('client_view',['cata'=>$cata,'code'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=6% style="vertical-align:middle">
              {!! Form::label('search_code', '代码: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('search_code',isset($search_code)?$search_code:null,['size'=>'6', 'class' => 'form-control']) !!}
            </td>
            <td width=6% style="vertical-align:middle">
              {!! Form::label('search_name', '名称: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('search_name',isset($search_name)?$search_name:null,['size'=>'6', 'class' => 'form-control']) !!}
            </td>
            <td width=6% style="vertical-align:middle">
              {!! Form::label('search_cata', '分类: ') !!}
            </td>
            <td width=10%>
              {!! Form::select('search_cata', [
                '' => '',
                '货源' => '货源',
                '生产单位' => '生产单位',
                '承运人' => '承运人'
                ], null, ['class' => 'form-control']) !!}
            </td>
            <td width=8% style="vertical-align:middle">
              {!! Form::label('perpage', '每页显示: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['size'=>'4','class' => 'form-control']) !!}
            </td>
            <td class="text-center" width=8%>
              {!! Form::submit('查询', ['class' => 'form-control']) !!}
            </td>
            <td class="text-center" width=8%>
              <button type="button" onclick="reset_search()" class="form-control">重置</button>
            </td>
            <td class="text-center" width=16%>
              <button type="button" onClick="location.href='{!! route('client_add') !!}'" class="form-control btn-primary">添加客户</button>
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
              <th class="text-center" width=15%>名称</th>
              <th class="text-center" width=15%>分类</th>
              <th class="text-center" width=10%></th>
              <th class="text-center" width=50%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $client)
            <tr>
              <td><a href="{{ route('client_view',['cata'=>$client->cata,'code'=>$client->code])}}">{{ $client->code }}</a></td>
              <td>{{ $client->name }}</td>
              <td>{{ $client->cata }}</td>
              <td class="text-center">
                <a href="{{ route('client_del',['cata'=>$client->cata,'code'=>$client->code])}}" onclick="if(confirm('确定删除&nbsp;“{{$client->cata}}&nbsp;:&nbsp;{{$client->code}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $clients->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_code').value=null;
      document.getElementById('search_name').value=null;
      document.getElementById('search_addr').value=null;
      document.getElementById('search_cata').value=null;
      document.getElementById('search_remark').value=null;
    }
  </script>
@stop