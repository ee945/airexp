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
            <strong>输入成功: &nbsp;<a href="{{ route('port_view',['code'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=8% style="vertical-align:middle">
              {!! Form::label('search_code', '目的港代码: ') !!}
            </td>
            <td width=6%>
              {!! Form::text('search_code',isset($search_code)?$search_code:null,['class' => 'form-control']) !!}
            </td>
            <td width=8% style="vertical-align:middle">
              {!! Form::label('search_name', '目的港全称: ') !!}
            </td>
            <td width=12%>
              {!! Form::text('search_name',isset($search_name)?$search_name:null,['class' => 'form-control']) !!}
            </td>
            <td width=7% style="vertical-align:middle">
              {!! Form::label('search_zone', '国家地区: ') !!}
            </td>
            <td width=6%>
              {!! Form::text('search_zone',isset($search_zone)?$search_zone:null,['class' => 'form-control']) !!}
            </td>
            <td width=7% style="vertical-align:middle">
              {!! Form::label('perpage', '每页显示: ') !!}
            </td>
            <td width=6%>
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['class' => 'form-control']) !!}
            </td>
            <td class="text-center" width=7%>
              {!! Form::submit('查询', ['class' => 'form-control']) !!}
            </td>
            <td class="text-center" width=7%>
              <button type="button" onclick="reset_search()" class="form-control">重置</button>
            </td>
            <td width=14%>
              <button type="button" onClick="location.href='{!! route('port_add') !!}'" class="form-control btn-primary">添加目的港</button>
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
              <th class="text-center" width=15%>代码</th>
              <th class="text-center" width=20%>全称</th>
              <th class="text-center" width=10%>地区</th>
              <th class="text-center" width=15%>M价</th>
              <th class="text-center" width=15%>N价</th>
              <th class="text-center" width=15%>Q价</th>
              <th class="text-center" width=10%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($ports as $port)
            <tr>
              <td><a href="{{ route('port_view',['code'=>$port->code])}}">{{ $port->code }}</a></td>
              <td>{{ $port->name }}</td>
              <td>{{ $port->zone }}</td>
              <td>{{ $port->m }}</td>
              <td>{{ $port->n }}</td>
              <td>{{ $port->q }}</td>
              <td class="text-center">
                <a href="{{ route('port_del',['code'=>$port->code])}}" onclick="if(confirm('确定删除&nbsp;“{{$port->code}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $ports->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script src="/js/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $(":text").attr("onkeyup",'this.value=this.value.toUpperCase()');
      $("textarea").attr("onkeyup",'this.value=this.value.toUpperCase()');
    });
    function reset_search(){
      document.getElementById('search_code').value=null;
      document.getElementById('search_name').value=null;
      document.getElementById('search_zone').value=null;
    }
  </script>
@stop