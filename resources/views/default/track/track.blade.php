@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="margin:0 auto;width:90%">
          <thead>
            <tr>
              <th colspan="8" style="font-size: 1.5em;">明日航班</th>
            </tr>
            <tr>
              <th width=10%>分运单号</th>
              <th width=12%>总运单号</th>
              <th width=10%>目的港</th>
              <th width=10%>航班号</th>
              <th width=12%>航班日期</th>
              <th width=6%>件数</th>
              <th width=8%>重量</th>
              <th width=14%></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawb_after1 as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td><a href="{{ route('mawb_print',['mawb'=>$hawb->mawb])}}">{{ $hawb->mawb }}</a></td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td>{{ $hawb->fltdate }}</td>
              <td>{{ $hawb->num }}</td>
              <td>{{ $hawb->gw }}</td>
              <td>
                <a href="{{ route('track_arrival',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-success">运抵</a>
                <a href="{{ route('track_flight',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-primary">航班</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <thead>
            <tr>
              <th colspan="8" style="font-size: 1.5em;">今日航班</th>
            </tr>
            <tr>
              <th>分运单号</th>
              <th>总运单号</th>
              <th>目的港</th>
              <th>航班号</th>
              <th>航班日期</th>
              <th>件数</th>
              <th>重量</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawb_today as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td><a href="{{ route('mawb_print',['mawb'=>$hawb->mawb])}}">{{ $hawb->mawb }}</a></td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td>{{ $hawb->fltdate }}</td>
              <td>{{ $hawb->num }}</td>
              <td>{{ $hawb->gw }}</td>
              <td>
                <a href="{{ route('track_arrival',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-success">运抵</a>
                <a href="{{ route('track_flight',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-primary">航班</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <thead>
            <tr>
              <th colspan="8" style="font-size: 1.5em;">昨日航班</th>
            </tr>
            <tr>
              <th>分运单号</th>
              <th>总运单号</th>
              <th>目的港</th>
              <th>航班号</th>
              <th>航班日期</th>
              <th>件数</th>
              <th>重量</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawb_before1 as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td><a href="{{ route('mawb_print',['mawb'=>$hawb->mawb])}}">{{ $hawb->mawb }}</a></td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td>{{ $hawb->fltdate }}</td>
              <td>{{ $hawb->num }}</td>
              <td>{{ $hawb->gw }}</td>
              <td>
                <a href="{{ route('track_arrival',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-success">运抵</a>
                <a href="{{ route('track_flight',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-primary">航班</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <thead>
            <tr>
              <th colspan="8" style="font-size: 1.5em;">前日航班</th>
            </tr>
            <tr>
              <th>分运单号</th>
              <th>总运单号</th>
              <th>目的港</th>
              <th>航班号</th>
              <th>航班日期</th>
              <th>件数</th>
              <th>重量</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hawb_before2 as $hawb)
            <tr>
              <td><a href="{{ route('hawb_view',['hawb'=>$hawb->hawb])}}">{{ $hawb->hawb }}</a></td>
              <td><a href="{{ route('mawb_print',['mawb'=>$hawb->mawb])}}">{{ $hawb->mawb }}</a></td>
              <td>{{ $hawb->dest }}</td>
              <td>{{ $hawb->fltno }}</td>
              <td>{{ $hawb->fltdate }}</td>
              <td>{{ $hawb->num }}</td>
              <td>{{ $hawb->gw }}</td>
              <td>
                <a href="{{ route('track_arrival',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-success">运抵</a>
                <a href="{{ route('track_flight',['mawb'=>$hawb->mawb])}}" target="_blank" type="button" class="btn btn-xs btn-primary">航班</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- /container -->
  <script>
  </script>
@stop