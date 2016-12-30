@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if(isset($del))
          @if($del=="yes")
          <div class="alert alert-warning" style="padding:8px 15px;margin-bottom:10px" role="alert">
            <strong>删除成功: &nbsp;{{ $delno }}&nbsp;已删除</strong>
          </div>
          @elseif($del=="no")
          <div class="alert alert-danger" style="padding:8px 15px;margin-bottom:10px" role="alert">
            <strong>删除失败: &nbsp;{{ $delno }}&nbsp;未找到</strong>
          </div>
          @endif
        @endif
        @if(isset($addno))
          <div class="alert alert-success" style="padding:8px 15px;margin-bottom:10px" role="alert">
            <strong>输入成功: &nbsp;<a href="{{ route('jincang_view',['jcno'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="margin-bottom: 2px;">
          <tr>
            <td width=15%>
              {!! Form::label('search_jcno', '进仓编号: ') !!}
              {!! Form::text('search_jcno',isset($search_jcno)?$search_jcno:null,['size'=>'8']) !!}
            </td>
            <td width=15%>
              {!! Form::label('search_dest', '目的港: ') !!}
              {!! Form::text('search_dest',isset($search_dest)?$search_dest:null,['size'=>'6']) !!}
            </td>
            <td width=12%>
              {!! Form::label('search_forward', '货源: ') !!}
              {!! Form::text('search_forward',isset($search_forward)?$search_forward:null,['size'=>'6']) !!}
            </td>
            <td width=12%>
              {!! Form::label('search_client', '托运人: ') !!}
              {!! Form::text('search_client',isset($search_client)?$search_client:null,['size'=>'6']) !!}
            </td>
            <td width=16%>
              {!! Form::label('search_cargodata', '货物信息: ') !!}
              {!! Form::text('search_cargodata',isset($search_cargodata)?$search_cargodata:null,['size'=>'8']) !!}
            </td>
            <td width=22%>
              {!! Form::label('search_fltstart', '航班日期: ') !!}
              {!! Form::text('search_fltstart',isset($search_fltstart)?$search_fltstart:null,['size'=>'8']) !!}
              {!! Form::label('search_fltend','-') !!}
              {!! Form::text('search_fltend',isset($search_fltend)?$search_fltend:null,['size'=>'8']) !!}
            </td>
            <td class="text-center" width=10%>{!! Form::submit('查询') !!}</td>
          </tr>
          <tr>
            <td>
              {!! Form::label('perpage', '每页显示: ') !!}
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['size'=>'8']) !!}
            </td>
            <td>
              {!! Form::label('search_remark', "备注: ") !!}
              {!! Form::text('search_remark',isset($search_remark)?$search_remark:null,['size'=>'8']) !!}
            </td>
            <td>
              {!! Form::label('search_factory', '厂家: ') !!}
              {!! Form::text('search_factory',isset($search_factory)?$search_factory:null,['size'=>'6']) !!}
            </td>
            <td>
              {!! Form::label('search_carrier', '承运人: ') !!}
              {!! Form::text('search_carrier',isset($search_carrier)?$search_carrier:null,['size'=>'6']) !!}
            </td>
            <td>
              {!! Form::label('search_delivery', '交货要求: ') !!}
              {!! Form::text('search_delivery',isset($search_delivery)?$search_delivery:null,['size'=>'8']) !!}
            </td>
            <td>
              {!! Form::label('search_regstart', '托运日期: ') !!}
              {!! Form::text('search_regstart',isset($search_regstart)?$search_regstart:null,['size'=>'8']) !!}
              {!! Form::label('search_regend','-') !!}
              {!! Form::text('search_regend',isset($search_regend)?$search_regend:null,['size'=>'8']) !!}
            </td>
            <td class="text-center"><button type="button" onclick="reset_search()">重置</button></td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="margin-bottom: 0;">
          <thead>
            <tr>
              <th class="text-center" width=7.8%>进仓编号</th>
              <th class="text-center" width=4.8%>目的港</th>
              <th class="text-center" width=8.1%>航班日期</th>
              <th class="text-center" width=6.1%>货源</th>
              <th class="text-center" width=4.8%>托运人</th>
              <th class="text-center" width=8.4%>生产单位</th>
              <th class="text-center" width=4.8%>承运人</th>
              <th class="text-center" width=8.1%>托运日期</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($jincangs as $jincang)
            <tr>
              <td><a href="{{ route('jincang_view',['jcno'=>$jincang->jcno])}}">{{ $jincang->jcno }}</a></td>
              <td>{{ $jincang->dest }}</td>
              <td class="text-center">{{ $jincang->fltdate }}</td>
              <td>{{ $jincang->forward }}</td>
              <td>{{ $jincang->client }}</td>
              <td>{{ $jincang->factory }}</td>
              <td>{{ $jincang->carrier }}</td>
              <td class="text-center">{{ $jincang->regdate }}</td>
              <td class="text-center">
                <a href="{{ route('jincang_del',['jcno'=>$jincang->jcno])}}" onclick="if(confirm('确定删除&nbsp;“{{$jincang->jcno}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $jincangs->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_jcno').value=null;
      document.getElementById('search_dest').value=null;
      document.getElementById('search_client').value=null;
      document.getElementById('search_forward').value=null;
      document.getElementById('search_factory').value=null;
      document.getElementById('search_carrier').value=null;
      document.getElementById('search_delivery').value=null;
      document.getElementById('search_cargodata').value=null;
      document.getElementById('search_remark').value=null;
      document.getElementById('search_fltstart').value=null;
      document.getElementById('search_fltend').value=null;
      document.getElementById('search_regstart').value=null;
      document.getElementById('search_regend').value=null;
    }
  </script>
@stop