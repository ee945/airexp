@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if(isset($del))
          @if($del=="yes")
          <div class="alert alert-warning" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除成功: &nbsp;{{ $delno }}&nbsp;分配销售已删除</strong>
          </div>
          @elseif($del=="no")
          <div class="alert alert-danger" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>删除失败: &nbsp;{{ $delno }}&nbsp;未分配销售人</strong>
          </div>
          @endif
        @endif
        @if(isset($addno))
          <div class="alert alert-success" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>添加成功: &nbsp;已为&nbsp;<a href="{{ route('seller_view',['forward'=>$addno])}}">{{ $addno }}</a>&nbsp;分配销售人</strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=8% style="vertical-align:middle">
              {!! Form::label('search_forward', '货源: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('search_forward',isset($search_forward)?$search_forward:null,['class' => 'form-control']) !!}
            </td>
            <td width=8% style="vertical-align:middle">
              {!! Form::label('search_seller', '销售人: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('search_seller',isset($search_seller)?$search_seller:null,['class' => 'form-control']) !!}
            </td>
            <td width=7% style="vertical-align:middle">
              {!! Form::label('search_remark', '备注: ') !!}
            </td>
            <td width=10%>
              {!! Form::text('search_remark',isset($search_remark)?$search_remark:null,['class' => 'form-control']) !!}
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
            <td width=16%>
              <button type="button" onClick="location.href='{!! route('seller_add') !!}'" class="form-control btn-primary">添加销售分配</button>
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
              <th class="text-center" width=15%>货源</th>
              <th class="text-center" width=15%>销售人</th>
              <th class="text-center" width=20%>备注</th>
              <th class="text-center" width=10%></th>
              <th class="text-center" width=40%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($sellers as $seller)
            <tr>
              <td><a href="{{ route('seller_view',['forward'=>$seller->forward])}}">{{ $seller->forward }}</a></td>
              <td>{{ $seller->seller }}</td>
              <td>{{ $seller->remark }}</td>
              <td class="text-center">
                <a href="{{ route('seller_del',['forward'=>$seller->forward])}}" onclick="if(confirm('确定删除&nbsp;“{{$seller->forward}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $sellers->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_forward').value=null;
      document.getElementById('search_seller').value=null;
      document.getElementById('search_remark').value=null;
    }
  </script>
@stop