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
            <td>
              {!! Form::label('search_hawb', '分单号: ') !!}
              {!! Form::text('search_hawb',isset($search_hawb)?$search_hawb:null,['size'=>'8']) !!}
            </td>
            <td>
              {!! Form::label('search_mawb', '总单号: ') !!}
              {!! Form::text('search_mawb',isset($search_mawb)?$search_mawb:null,['size'=>'10']) !!}
            </td>
            <td>
              {!! Form::label('search_dest', '目的港: ') !!}
              {!! Form::text('search_dest',isset($search_dest)?$search_dest:null,['size'=>'3']) !!}
            </td>
            <td>
              {!! Form::label('search_fltno', '航班号: ') !!}
              {!! Form::text('search_fltno',isset($search_fltno)?$search_fltno:null,['size'=>'6']) !!}
            </td>
            <td>
              {!! Form::label('search_carrier', '承运人: ') !!}
              {!! Form::text('search_carrier',isset($search_carrier)?$search_carrier:null,['size'=>'4']) !!}
            </td>
            <td>
              {!! Form::label('search_paymt', '付费方式: ') !!}
              {!! Form::text('search_paymt',isset($search_paymt)?$search_paymt:null,['size'=>'2']) !!}
            </td>
            <td colspan="2">
              {!! Form::label('search_fltstart', '航班日期: ') !!}
              {!! Form::text('search_fltstart',isset($search_fltstart)?$search_fltstart:null,['size'=>'8']) !!}
              {!! Form::label('search_fltend','-') !!}
              {!! Form::text('search_fltend',isset($search_fltend)?$search_fltend:null,['size'=>'8']) !!}
            </td>
            <td>{!! Form::submit('查询') !!}</td>
          </tr>
          <tr>
            <td colspan="4">
              <div class="btn-group-sm">
                <button class="btn btn-default" type="button">TOTAL:</button>
                <button class="btn btn-success" type="button">NUM &nbsp;<span class="badge">{{ $total_num }}</span></button>
                <button class="btn btn-primary" type="button">GW &nbsp;<span class="badge">{{ $total_gw }}</span></button>
                <button class="btn btn-info" type="button">CW &nbsp;<span class="badge">{{ $total_cw }}</span></button>
                <button class="btn btn-warning" type="button">CBM &nbsp;<span class="badge">{{ $total_cbm }}</span></button>
              </div>
            </td>
            <td>
              {!! Form::label('search_consignee', '收货人: ') !!}
              {!! Form::text('search_consignee',isset($search_consignee)?$search_consignee:null,['size'=>'4']) !!}
            </td>
            <td>
              {!! Form::label('search_forward', '货源: ') !!}
              {!! Form::text('search_forward',isset($search_forward)?$search_forward:null,['size'=>'4']) !!}
            </td>
            <td>
              {!! Form::label('search_factory', '生产单位: ') !!}
              {!! Form::text('search_factory',isset($search_factory)?$search_factory:null,['size'=>'4']) !!}
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
              <th class="text-center" width=7.8%>分运单号</th>
              <th class="text-center" width=10.1%>总运单号</th>
              <th class="text-center" width=4.8%>目的港</th>
              <th class="text-center" width=5.8%>航班号</th>
              <th class="text-center" width=8.1%>航班日期</th>
              <th class="text-center" width=4.1%>件数</th>
              <th class="text-center" width=5.9%>实际重量</th>
              <th class="text-center" width=5.9%>收费重量</th>
              <th class="text-center" width=5.1%>体积</th>
              <th class="text-center" width=3.7%>付费</th>
              <th class="text-center" width=6.1%>货源</th>
              <th class="text-center" width=8.4%>生产单位</th>
              <th class="text-center" width=4.8%>承运人</th>
              <th class="text-center" width=8.1%>操作日期</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawbs as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td>{{ $hawb->mawb }}</td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td class="text-center">{{ $hawb->fltdate }}</td>
              <td class="text-right">{{ $hawb->num }}</td>
              <td class="text-right">{{ $hawb->gw }}</td>
              <td class="text-right">{{ $hawb->cw }}</td>
              <td class="text-right">{{ round($hawb->cbm,3) }}</td>
              <td class="text-center">{{ $hawb->paymt }}</td>
              <td>{{ $hawb->forward }}</td>
              <td>{{ $hawb->factory }}</td>
              <td>{{ $hawb->carrier }}</td>
              <td class="text-center">{{ $hawb->opdate }}</td>
              <td class="text-center">
                <a href="{{ route('hawb_print',['hawb'=>$hawb->hawb])}}" type="button" class="btn btn-xs btn-success">打印</a>
                <a href="{{ route('manifest',['hawb'=>$hawb->mawb])}}" type="button" class="btn btn-xs btn-primary">清单</a>
                <a href="{{ route('hawb_del',['hawb'=>$hawb->hawb])}}" onclick="if(confirm('确定删除&nbsp;“{{$hawb->hawb}}”&nbsp;?')==false)return false;" type="button" class="btn btn-xs btn-danger">删除</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $hawbs->render() }}
      </div>
    </div>
  </div> <!-- /container -->
  <script>
    function reset_search(){
      document.getElementById('search_hawb').value=null;
      document.getElementById('search_mawb').value=null;
      document.getElementById('search_dest').value=null;
      document.getElementById('search_fltno').value=null;
      document.getElementById('search_carrier').value=null;
      document.getElementById('search_paymt').value=null;
      document.getElementById('search_fltstart').value=null;
      document.getElementById('search_fltend').value=null;
      document.getElementById('search_consignee').value=null;
      document.getElementById('search_forward').value=null;
      document.getElementById('search_factory').value=null;
    }
  </script>
@stop