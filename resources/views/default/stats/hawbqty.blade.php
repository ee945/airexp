@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        <table class="table table-condensed table-responsive" style="margin-bottom: 2px;">
          <tr>
            <td colspan="10">
              {!! Form::submit('开始统计') !!}&nbsp;
              <button type="button" onclick="reset_filter()">重置条件</button>&nbsp;
              {!! Form::label('perpage', '每页显示: ') !!}&nbsp;
              {!! Form::text('perpage',isset($perpage)?$perpage:100,['size'=>'4']) !!}
            </td>
          </tr>
          <tr>
            <td colspan="10">
              {!! Form::label('filter_fltstart', '航班日期: ') !!}
              {!! Form::date('filter_fltstart',isset($filter_fltstart)?$filter_fltstart:date('Y-m-01')) !!}
              {!! Form::label('filter_fltend','-') !!}
              {!! Form::date('filter_fltend',isset($filter_fltend)?$filter_fltend:date('Y-m-t')) !!}
              <button class="btn btn-sm btn-success" type="button">本周</button>
              <button class="btn btn-sm btn-success" type="button">上周</button>
              <button class="btn btn-sm btn-primary" type="button">本月</button>
              <button class="btn btn-sm btn-primary" type="button">上月</button>
              <button class="btn btn-sm btn-info" type="button">本年</button>
              <button class="btn btn-sm btn-info" type="button">上年</button>
            </td>
          </tr>
          <tr>
            <td colspan="10">
              {!! Form::label('filter_weekday', '星期筛选: ') !!}
              {!! Form::checkbox('filter_weekday', '1', true); !!}周一&nbsp;
              {!! Form::checkbox('filter_weekday', '2', true); !!}周二&nbsp;
              {!! Form::checkbox('filter_weekday', '3', true); !!}周三&nbsp;
              {!! Form::checkbox('filter_weekday', '4', true); !!}周四&nbsp;
              {!! Form::checkbox('filter_weekday', '5', true); !!}周五&nbsp;
              {!! Form::checkbox('filter_weekday', '6', true); !!}周六&nbsp;
              {!! Form::checkbox('filter_weekday', '7', true); !!}周日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              {!! Form::checkbox('chk_weekday', '0', true, ['onclick'=>'checkWeekday()']); !!}全选&nbsp;
            </td>
          </tr>
          <tr>
            <td colspan="2">
              {!! Form::label('filter_dest', '目的港: ') !!}
              {!! Form::text('filter_dest',isset($filter_dest)?$filter_dest:null,['size'=>'6']) !!}
            </td>
            <td colspan="2">
              {!! Form::label('filter_fltno', '航班号: ') !!}
              {!! Form::text('filter_fltno',isset($filter_fltno)?$filter_fltno:null,['size'=>'6']) !!}
            </td>
            <td colspan="2">
              {!! Form::label('filter_carrier', '承运人: ') !!}
              {!! Form::text('filter_carrier',isset($filter_carrier)?$filter_carrier:null,['size'=>'6']) !!}
            </td>
            <td colspan="2">
              {!! Form::label('filter_forward', '货源: ') !!}
              {!! Form::text('filter_forward',isset($filter_forward)?$filter_forward:null,['size'=>'6']) !!}
            </td>
            <td colspan="2">
              {!! Form::label('filter_factory', '生产单位: ') !!}
              {!! Form::text('filter_factory',isset($filter_factory)?$filter_factory:null,['size'=>'6']) !!}
            </td>
          </tr>
          <tr>
            <td colspan="10">
              <div class="btn-group-md">
                <button class="btn btn-default" type="button">总计 &nbsp;<span class="badge">{{ $total_count }}</span> &nbsp;票</button>
                <button class="btn btn-success" type="button">件数 &nbsp;<span class="badge">{{ $total_num }}</span></button>
                <button class="btn btn-primary" type="button">实际重量 &nbsp;<span class="badge">{{ number_format($total_gw,0,'.',',') }}</span></button>
                <button class="btn btn-info" type="button">收费重量 &nbsp;<span class="badge">{{ number_format($total_cw,0,'.',',') }}</span></button>
                <button class="btn btn-warning" type="button">体积 &nbsp;<span class="badge">{{ $total_cbm }}</span></button>
              </div>
            </td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="margin-bottom: 0;width: 85%">
          <thead>
            <tr>
              <th class="text-center" width=9%>分运单号</th>
              <th class="text-center" width=10%>总运单号</th>
              <th class="text-center" width=5%>目的港</th>
              <th class="text-center" width=6%>航班号</th>
              <th class="text-center" width=8%>航班日期</th>
              <th class="text-center" width=4%>件数</th>
              <th class="text-center" width=6%>实际重量</th>
              <th class="text-center" width=6%>收费重量</th>
              <th class="text-center" width=5%>体积</th>
              <th class="text-center" width=7%>货源</th>
              <th class="text-center" width=9%>生产单位</th>
              <th class="text-center" width=5%>承运人</th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawbs as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td><a href="{{ route('mawb_print',['mawb'=>$hawb->mawb])}}">{{ $hawb->mawb }}</a></td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td class="text-center">{{ $hawb->fltdate }}</td>
              <td class="text-right">{{ $hawb->num }}</td>
              <td class="text-right">{{ $hawb->gw }}</td>
              <td class="text-right">{{ $hawb->cw }}</td>
              <td class="text-right">{{ round($hawb->cbm,3) }}</td>
              <td>{{ $hawb->forward }}</td>
              <td>{{ $hawb->factory }}</td>
              <td>{{ $hawb->carrier }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $hawbs->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_filter(){
      document.getElementById('filter_fltstart').value=null;
      document.getElementById('filter_fltend').value=null;
      document.getElementById('filter_dest').value=null;
      document.getElementById('filter_fltno').value=null;
      document.getElementById('filter_carrier').value=null;
      document.getElementById('filter_forward').value=null;
      document.getElementById('filter_factory').value=null;
      var weekday = document.getElementsByName('filter_weekday');
      var len = weekday.length;
      for (var i = 0; i < len; i++) weekday[i].checked = true;
    }
    function checkWeekday() {
      var weekday = document.getElementsByName('filter_weekday');
      var len = weekday.length;
      var chk = document.getElementsByName('chk_weekday');
      if(chk[0].checked==true){
        for (var i = 0; i < len; i++) weekday[i].checked = true;
      }else{
        for (var i = 0; i < len; i++) weekday[i].checked = false;
      }
    }
  </script>
@stop