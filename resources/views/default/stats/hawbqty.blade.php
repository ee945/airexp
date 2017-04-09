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
              {!! Form::label('perpage', '显示数量: ') !!}&nbsp;
              {!! Form::text('perpage',isset($perpage)?$perpage:200,['size'=>'4']) !!}&nbsp;
              <span {{$query_count>200?"style=color:red":""}}>查询到 {{ $query_count }} 条结果</span>
            </td>
          </tr>
          <tr>
            <td colspan="10">
              {!! Form::label('filter_fltstart', '航班日期: ') !!}
              {!! Form::date('filter_fltstart',isset($filter_fltstart)?$filter_fltstart:date('Y-m-01')) !!}
              {!! Form::label('filter_fltend','-') !!}
              {!! Form::date('filter_fltend',isset($filter_fltend)?$filter_fltend:date('Y-m-t')) !!}
              <button class="btn btn-sm btn-success" type="button" onclick="selThisWeek()">本周</button>
              <button class="btn btn-sm btn-success" type="button" onclick="selLastWeek()">上周</button>
              <button class="btn btn-sm btn-primary" type="button" onclick="selThisMonth()">本月</button>
              <button class="btn btn-sm btn-primary" type="button" onclick="selLastMonth()">上月</button>
              <button class="btn btn-sm btn-info" type="button" onclick="selThisYear()">本年</button>
              <button class="btn btn-sm btn-info" type="button" onclick="selLastYear()">上年</button>
            </td>
          </tr>
          <tr>
            <td colspan="10">
              {!! Form::label('filter_weekday', '星期筛选: ') !!}
              {!! Form::checkbox('filter_weekday[0]', '0', !isset($perpage)?true:isset($filter_weekday[0])) !!}周一&nbsp;
              {!! Form::checkbox('filter_weekday[1]', '1', !isset($perpage)?true:isset($filter_weekday[1])) !!}周二&nbsp;
              {!! Form::checkbox('filter_weekday[2]', '2', !isset($perpage)?true:isset($filter_weekday[2])) !!}周三&nbsp;
              {!! Form::checkbox('filter_weekday[3]', '3', !isset($perpage)?true:isset($filter_weekday[3])) !!}周四&nbsp;
              {!! Form::checkbox('filter_weekday[4]', '4', !isset($perpage)?true:isset($filter_weekday[4])) !!}周五&nbsp;
              {!! Form::checkbox('filter_weekday[5]', '5', !isset($perpage)?true:isset($filter_weekday[5])) !!}周六&nbsp;
              {!! Form::checkbox('filter_weekday[6]', '6', !isset($perpage)?true:isset($filter_weekday[6])) !!}周日&nbsp;&nbsp;
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
      document.getElementsByName("filter_weekday[0]")[0].checked = true;
      document.getElementsByName("filter_weekday[1]")[0].checked = true;
      document.getElementsByName("filter_weekday[2]")[0].checked = true;
      document.getElementsByName("filter_weekday[3]")[0].checked = true;
      document.getElementsByName("filter_weekday[4]")[0].checked = true;
      document.getElementsByName("filter_weekday[5]")[0].checked = true;
      document.getElementsByName("filter_weekday[6]")[0].checked = true;
    }
    function checkWeekday() {
      var chk = document.getElementsByName('chk_weekday');
      if(chk[0].checked==true){
        document.getElementsByName("filter_weekday[0]")[0].checked = true;
        document.getElementsByName("filter_weekday[1]")[0].checked = true;
        document.getElementsByName("filter_weekday[2]")[0].checked = true;
        document.getElementsByName("filter_weekday[3]")[0].checked = true;
        document.getElementsByName("filter_weekday[4]")[0].checked = true;
        document.getElementsByName("filter_weekday[5]")[0].checked = true;
        document.getElementsByName("filter_weekday[6]")[0].checked = true;
      }else{
        document.getElementsByName("filter_weekday[0]")[0].checked = false;
        document.getElementsByName("filter_weekday[1]")[0].checked = false;
        document.getElementsByName("filter_weekday[2]")[0].checked = false;
        document.getElementsByName("filter_weekday[3]")[0].checked = false;
        document.getElementsByName("filter_weekday[4]")[0].checked = false;
        document.getElementsByName("filter_weekday[5]")[0].checked = false;
        document.getElementsByName("filter_weekday[6]")[0].checked = false;
      }
    }
    function selThisWeek() {
      // 设置航班日期范围为本周
      var thisDate=new Date()
      diff = thisDate.getDay()==0?thisDate.getDay()+6:thisDate.getDay()-1;
      weekstart = new Date(thisDate.setDate(thisDate.getDate()-diff));
      weekend = new Date(thisDate.setDate(thisDate.getDate()+6))
      fltmonth = weekstart.getMonth()<9?"0"+(weekstart.getMonth()+1):weekstart.getMonth()+1;
      fltdate = weekstart.getDate()<9?"0"+(weekstart.getDate()):weekstart.getDate();
      fltstart = weekstart.getFullYear()+"-"+fltmonth+"-"+fltdate;
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      fltmonth = weekend.getMonth()<9?"0"+(weekend.getMonth()+1):weekend.getMonth()+1;
      fltdate = weekend.getDate()<10?"0"+(weekend.getDate()):weekend.getDate();
      fltend = weekend.getFullYear()+"-"+fltmonth+"-"+fltdate;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
    function selLastWeek() {
      // 设置航班日期范围为上周
      var thisDate=new Date()
      diff = thisDate.getDay()==0?thisDate.getDay()+6:thisDate.getDay()-1;
      weekstart = new Date(thisDate.setDate(thisDate.getDate()-diff-7));
      weekend = new Date(thisDate.setDate(thisDate.getDate()+6))
      fltmonth = weekstart.getMonth()<9?"0"+(weekstart.getMonth()+1):weekstart.getMonth()+1;
      fltdate = weekstart.getDate()<9?"0"+(weekstart.getDate()):weekstart.getDate();
      fltstart = weekstart.getFullYear()+"-"+fltmonth+"-"+fltdate;
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      fltmonth = weekend.getMonth()<9?"0"+(weekend.getMonth()+1):weekend.getMonth()+1;
      fltdate = weekend.getDate()<10?"0"+(weekend.getDate()):weekend.getDate();
      fltend = weekend.getFullYear()+"-"+fltmonth+"-"+fltdate;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
    function selThisMonth() {
      // 设置航班日期范围为本月
      var thisDate=new Date()
      if(thisDate.getMonth()==11){
        newyear = thisDate.getFullYear()+1;
        newmonth = 0;
      }else{
        newyear = thisDate.getFullYear();
        newmonth = thisDate.getMonth()+1;
      }
      newDate = new Date(newyear,newmonth,0)
      fltmonth = newDate.getMonth()<9?"0"+(newDate.getMonth()+1):newDate.getMonth()+1;
      fltstart = newDate.getFullYear()+"-"+fltmonth+"-"+"01";
      fltend = newDate.getFullYear()+"-"+fltmonth+"-"+newDate.getDate();
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
    function selLastMonth() {
      // 设置航班日期范围为上月
      var thisDate=new Date()
      newyear = thisDate.getFullYear();
      newmonth = thisDate.getMonth();
      newDate = new Date(thisDate.getFullYear(),thisDate.getMonth(),0)
      fltmonth = newDate.getMonth()<9?"0"+(newDate.getMonth()+1):newDate.getMonth()+1;
      fltstart = newDate.getFullYear()+"-"+fltmonth+"-"+"01";
      fltend = newDate.getFullYear()+"-"+fltmonth+"-"+newDate.getDate();
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
    function selThisYear() {
      // 设置航班日期范围为本年
      var thisDate=new Date()
      fltstart = thisDate.getFullYear()+"-"+"01"+"-"+"01";
      fltend = thisDate.getFullYear()+"-"+"12"+"-"+"31";
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
    function selLastYear() {
      // 设置航班日期范围为上年
      var thisDate=new Date()
      fltstart = (thisDate.getFullYear()-1)+"-"+"01"+"-"+"01";
      fltend = (thisDate.getFullYear()-1)+"-"+"12"+"-"+"31";
      document.getElementsByName("filter_fltstart")[0].value = fltstart;
      document.getElementsByName("filter_fltend")[0].value = fltend;
    }
  </script>
@stop