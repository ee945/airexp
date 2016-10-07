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
            <strong>输入成功: &nbsp;<a href="{{ route('hawb_view',['hawb'=>$addno])}}">{{ $addno }}</a></strong>
          </div>
        @endif
        <table class="table table-condensed table-responsive" style="margin-bottom: 2px;">
          <tr>
            <td width=15%>
              {!! Form::label('search_mawb', '总单号: ') !!}
              {!! Form::text('search_mawb',isset($search_mawb)?$search_mawb:null,['size'=>'10']) !!}
            </td>
            <td width=15%>
              {!! Form::label('search_dest', '目的港: ') !!}
              {!! Form::text('search_dest',isset($search_dest)?$search_dest:null,['size'=>'10']) !!}
            </td>
            <td width=15%>
              {!! Form::label('search_consignee', '收货人: ') !!}
              {!! Form::text('search_consignee',isset($search_consignee)?$search_consignee:null,['size'=>'10']) !!}
            </td>
            <td width=15%>
              {!! Form::label('search_fltno', '航班号: ') !!}
              {!! Form::text('search_fltno',isset($search_fltno)?$search_fltno:null,['size'=>'10']) !!}
            </td>
            <td colspan="2"  width=30%>
              {!! Form::label('search_fltstart', '航班日期: ') !!}
              {!! Form::text('search_fltstart',isset($search_fltstart)?$search_fltstart:null,['size'=>'10']) !!}
              {!! Form::label('search_fltend','-') !!}
              {!! Form::text('search_fltend',isset($search_fltend)?$search_fltend:null,['size'=>'10']) !!}
            </td>
            <td>{!! Form::submit('查询') !!}</td>
          </tr>
          <tr>
            <td colspan="3">
              <div class="btn-group-sm">
                <button class="btn btn-default" type="button">TOTAL:</button>
                <button class="btn btn-success" type="button">NUM &nbsp;<span class="badge">{{ $total_num }}</span></button>
                <button class="btn btn-primary" type="button">GW &nbsp;<span class="badge">{{ $total_gw }}</span></button>
                <button class="btn btn-info" type="button">CW &nbsp;<span class="badge">{{ $total_cw }}</span></button>
                <button class="btn btn-warning" type="button">CBM &nbsp;<span class="badge">{{ $total_cbm }}</span></button>
              </div>
            </td>
            <td>
              {!! Form::label('search_carrier', '承运人: ') !!}
              {!! Form::text('search_carrier',isset($search_carrier)?$search_carrier:null,['size'=>'10']) !!}
            </td>
            <td>
              {!! Form::label('search_oversea', '海外代理: ') !!}
              {!! Form::text('search_oversea',isset($search_oversea)?$search_oversea:null,['size'=>'10']) !!}
            </td>
            <td>
              {!! Form::label('perpage', '每页显示: ') !!}
              {!! Form::text('perpage',isset($perpage)?$perpage:20,['size'=>'4']) !!}
            </td>
            <td><button type="button" onclick="reset_search()">重置</button></td>
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
              <th class="text-center" width=10%>总运单号</th>
              <th class="text-center" width=5%>目的港</th>
              <th class="text-center" width=7%>航班号</th>
              <th class="text-center" width=9%>航班日期</th>
              <th class="text-center" width=5%>件数</th>
              <th class="text-center" width=6%>实际重量</th>
              <th class="text-center" width=6%>收费重量</th>
              <th class="text-center" width=5%>体积</th>
              <th class="text-center" width=8%>总运费</th>
              <th class="text-center" width=8%>总金额</th>
              <th class="text-center" width=6%>海外代理</th>
              <th class="text-center" width=5%>承运人</th>
              <th class="text-center" width=9%>操作日期</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($mawbs as $mawb)
            <tr>
              <td><a href="{{ route('mawb_print',['mawb'=>$mawb->mawb])}}">{{ $mawb->mawb }}</a></td>
              <td>{{ $mawb->dest }}</td>
              <td>{{ $mawb->fltno }}</td>
              <td class="text-center">{{ $mawb->fltdate }}</td>
              <td class="text-right">{{ $mawb->num }}</td>
              <td class="text-right">{{ $mawb->gw }}</td>
              <td class="text-right">{{ $mawb->cw }}</td>
              <td class="text-right">{{ round($mawb->cbm,3) }}</td>
              <td class="text-right">{{ round($mawb->freight,2) }}</td>
              <td class="text-right">{{ round($mawb->amount,2) }}</td>
              <td class="text-center">{{ $mawb->oversea }}</td>
              <td class="text-center">{{ $mawb->carrier }}</td>
              <td class="text-center">{{ $mawb->opdate }}</td>
              <td class="text-center">
                <a href="{{ route('mawb_print',['mawb'=>$mawb->mawb])}}" type="button" class="btn btn-xs btn-success">打印</a>
                <a href="{{ route('manifest',['mawb'=>$mawb->mawb])}}" type="button" class="btn btn-xs btn-primary">清单</a>
                <a href="{{ route('mawb_del',['mawb'=>$mawb->mawb])}}" onclick="if(confirm('确定删除&nbsp;“{{$mawb->mawb}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $mawbs->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_mawb').value=null;
      document.getElementById('search_dest').value=null;
      document.getElementById('search_consignee').value=null;
      document.getElementById('search_fltno').value=null;
      document.getElementById('search_fltstart').value=null;
      document.getElementById('search_fltend').value=null;
      document.getElementById('search_carrier').value=null;
      document.getElementById('search_oversea').value=null;
    }
  </script>
@stop