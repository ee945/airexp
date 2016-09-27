@extends(theme('layout.layout'))

@section('container')
    <div class="container theme-showcase" role="main">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th class="text-center">分运单号</th>
                <th class="text-center">总运单号</th>
                <th class="text-center">目的港</th>
                <th class="text-center">航班号</th>
                <th class="text-center">航班日期</th>
                <th class="text-center">件数</th>
                <th class="text-center">实际重量</th>
                <th class="text-center">收费重量</th>
                <th class="text-center">体积</th>
                <th class="text-center">付费</th>
                <th class="text-center">货源</th>
                <th class="text-center">生产单位</th>
                <th class="text-center">承运人</th>
                <th class="text-center">操作日期</th>
                <th class="text-center">操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($hawbs as $hawb)
              <tr>
                <td>{{ $hawb->hawb }}</td>
                <td>{{ $hawb->mawb }}</td>
                <td>{{ $hawb->dest }}</td>
                <td>{{ $hawb->fltno }}</td>
                <td>{{ $hawb->fltdate }}</td>
                <td class="text-right">{{ $hawb->num }}</td>
                <td class="text-right">{{ $hawb->gw }}</td>
                <td class="text-right">{{ $hawb->cw }}</td>
                <td class="text-right">{{ round($hawb->cbm,2) }}</td>
                <td>{{ $hawb->paymt }}</td>
                <td>{{ $hawb->forward }}</td>
                <td>{{ $hawb->factory }}</td>
                <td>{{ $hawb->carrier }}</td>
                <td>{{ $hawb->opdate }}</td>
                <td>
                  <button type="button" class="btn btn-xs btn-primary">打印</button>
                  <button type="button" class="btn btn-xs btn-success">清单</button>
                  <button type="button" class="btn btn-xs btn-danger">删除</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $hawbs->render() }}
        </div>
      </div>
    </div> <!-- /container -->
@stop