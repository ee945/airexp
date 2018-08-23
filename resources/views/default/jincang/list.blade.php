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
            <strong>输入成功: &nbsp;<a href="{{ route('jincang_view',['jcno'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        @if(isset($status))
          @if($status=="in")
          <div class="alert alert-warning" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>操作成功 &nbsp;{{ $jcno }}&nbsp;已进仓</strong>
          </div>
          @elseif($status=="out")
          <div class="alert alert-success" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>操作成功 &nbsp;{{ $jcno }}&nbsp;已出仓</strong>
          </div>
          @elseif($status=="no")
          <div class="alert alert-danger" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
            <strong>操作失败 &nbsp;{{ $jcno }}&nbsp;未找到</strong>
          </div>
          @endif
        @endif
        <table class="table table-condensed table-responsive" style="width:90%;margin:2px auto;">
          <tr>
            <td width=15%>
              {!! Form::label('search_jcno', '进仓编号: ') !!}
              {!! Form::text('search_jcno',isset($search_jcno)?$search_jcno:null,['size'=>'8']) !!}
            </td>
            <td width=12%>
              {!! Form::label('search_dest', '目的港: ') !!}
              {!! Form::text('search_dest',isset($search_dest)?$search_dest:null,['size'=>'5']) !!}
            </td>
            <td width=10%>
              {!! Form::label('search_forward', '货源: ') !!}
              {!! Form::text('search_forward',isset($search_forward)?$search_forward:null,['size'=>'5']) !!}
            </td>
            <td width=11%>
              {!! Form::label('search_client', '托运人: ') !!}
              {!! Form::text('search_client',isset($search_client)?$search_client:null,['size'=>'5']) !!}
            </td>
            <td width=15%>
              {!! Form::label('search_cargodata', '货物信息: ') !!}
              {!! Form::text('search_cargodata',isset($search_cargodata)?$search_cargodata:null,['size'=>'8']) !!}
            </td>
            <td width=22%>
              {!! Form::label('search_fltstart', '航班日期: ') !!}
              {!! Form::text('search_fltstart',isset($search_fltstart)?$search_fltstart:null,['size'=>'8']) !!}
              {!! Form::label('search_fltend','-') !!}
              {!! Form::text('search_fltend',isset($search_fltend)?$search_fltend:null,['size'=>'8']) !!}
            </td>
            <td class="text-center" width=6%>{!! Form::submit('查询') !!}</td>
          </tr>
          <tr>
            <td>
              {!! Form::label('perpage', '每页显示: ') !!}
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['size'=>'8']) !!}
            </td>
            <td>
              {!! Form::label('search_remark', "备注: ") !!}
              {!! Form::text('search_remark',isset($search_remark)?$search_remark:null,['size'=>'7']) !!}
            </td>
            <td>
              {!! Form::label('search_factory', '厂家: ') !!}
              {!! Form::text('search_factory',isset($search_factory)?$search_factory:null,['size'=>'5']) !!}
            </td>
            <td>
              {!! Form::label('search_carrier', '承运人: ') !!}
              {!! Form::text('search_carrier',isset($search_carrier)?$search_carrier:null,['size'=>'5']) !!}
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
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="width:90%;margin: 0 auto;">
          <thead>
            <tr>
              <th class="text-center" width=8%>进仓编号</th>
              <th class="text-center" width=6%>目的港</th>
              <th class="text-center" width=9%>托运日期</th>
              <th class="text-center" width=9%>预配日期</th>
              <th class="text-center" width=7%>货源</th>
              <th class="text-center" width=7%>托运人</th>
              <th class="text-center" width=9%>生产单位</th>
              <th class="text-center" width=6%>承运人</th>
              <th class="text-center" width=15%>货物信息</th>
              <th class="text-center" width=15%>备注</th>
              <th class="text-center" width=10%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($jincangs as $jincang)
            <tr {{$jincang->status==1?"style=background-color:#aaa;color:#fff":""}}>
              <td class="hawb"><a href="{{ route('jincang_view',['jcno'=>$jincang->jcno])}}">{{ $jincang->jcno }}</a></td>
              <td>{{ $jincang->dest }}</td>
              <td class="text-center">{{ $jincang->regdate }}</td>
              <td class="text-center jincang">{{ $jincang->fltdate == "0000-00-00"?"未定":$jincang->fltdate }}</td>
              <td>{{ $jincang->forward }}</td>
              <td>{{ $jincang->client }}</td>
              <td>{{ $jincang->factory }}</td>
              <td>{{ $jincang->carrier }}</td>
              <td>{{ $jincang->cargodata }}</td>
              <td>{{ $jincang->remark }}</td>
              <td class="text-center">
                <a href="{{ route('jincang_status',['jcno'=>$jincang->jcno])}}" onclick="if(confirm('{{$jincang->status==1?"重新进仓":"确定出仓"}}&nbsp;“{{$jincang->jcno}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs {{$jincang->status==1?"btn-success":"btn-warning"}}">{{$jincang->status==1?"已出":"出仓"}}</a>
                <a href="{{ route('jincang_del',['jcno'=>$jincang->jcno])}}" onclick="if(confirm('确定删除&nbsp;“{{$jincang->jcno}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div style="width: 90%;margin:0 auto;">
          {{ $jincangs->render() }}
        </div>
      </div>
    </div>
  </div> <!-- /container -->
  <script src="/js/jquery.min.js"></script>
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

    //点击预配日期自动更新为实际航班日期
    $(".jincang").click(function(){
      var hawb = $(this).siblings(".hawb").text();
      var predate = $(this).text();
      $.get('{{url('get/fltdate')}}/'+hawb,function(json){
        if(json.fltdate!=null){
          if(json.fltdate!=predate){
            if(confirm("实际出口日期："+json.fltdate+"，是否更新？")){
              $(location).attr('href', '{{url('update/fltdate')}}/'+hawb+'/'+json.fltdate)
            }
          }
        }
      });
    });
  </script>
@stop