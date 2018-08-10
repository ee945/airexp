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
            <strong>输入成功: &nbsp;<a href="{{ route('address_view',['cata'=>$cata,'code'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_code', '代码: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_name', '名称: ') !!}
            </td>
            <td width=13% style="vertical-align:middle">
              {!! Form::label('search_cata', '分类: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_addr', '地址: ') !!}
            </td>
            <td width=14% style="vertical-align:middle">
              {!! Form::label('search_remark', '备注: ') !!}
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
              {!! Form::select('search_cata', [
                '' => '',
                '分单发货人' => '分单发货人',
                '分单收货人' => '分单收货人',
                '分单通知人' => '分单通知人',
                '总单发货人' => '总单发货人',
                '总单收货人' => '总单收货人'
                ], null, ['class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_addr',isset($search_addr)?$search_addr:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('search_remark',isset($search_remark)?$search_remark:null,['size'=>'6','class' => 'form-control']) !!}
            </td>
            <td>
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['size'=>'4','class' => 'form-control']) !!}
            </td>
            <td colspan="2">
              <button type="button" onClick="location.href='{!! route('address_add') !!}'" class="form-control btn-primary">添加地址</button>
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
              <th class="text-center" width=11%>代码</th>
              <th class="text-center" width=13%>名称</th>
              <th class="text-center" width=10%>分类</th>
              <th class="text-center" width=43%>地址</th>
              <th class="text-center" width=18%>备注</th>
              <th class="text-center" width=5%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($addrs as $addr)
            <tr>
              <td><a href="{{ route('address_view',['cata'=>$addr->cata,'code'=>$addr->code])}}">{{ $addr->code }}</a></td>
              <td>{{ $addr->name }}</td>
              <td>{{ $addr->cata }}</td>
              <td>{{ explode("\n", $addr->addr)[0] }}</td>
              <td>{{ explode("\n", $addr->remark)[0] }}</td>
              <td class="text-center">
                <a href="{{ route('address_del',['cata'=>$addr->cata,'code'=>$addr->code])}}" onclick="if(confirm('确定删除&nbsp;“{{$addr->code}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $addrs->render() }}
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