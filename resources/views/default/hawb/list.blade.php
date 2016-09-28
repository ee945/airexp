@extends(theme('layout.layout'))

@section('container')
    <div class="container theme-showcase" role="main">
      <div class="row">
        <div class="col-md-11">
          {!! Form::open() !!}
          <table class="table table-condensed" style="margin-bottom: 2px;">
            <tr>
              <td>
                {!! Form::label('hawb', '分单号: ') !!}
                {!! Form::text('hawb',null,['size'=>'12']) !!}
              </td>
              <td>
                {!! Form::label('dest', '目的港: ') !!}
                {!! Form::text('dest',null,['size'=>'4']) !!}
              </td>
              <td>
                {!! Form::label('fltno', '航班号: ') !!}
                {!! Form::text('fltno',null,['size'=>'5']) !!}
              </td>
              <td>
                {!! Form::label('forward', '货源: ') !!}
                {!! Form::text('forward',null,['size'=>'4']) !!}
              </td>
              <td>
                {!! Form::label('factory', '生产单位: ') !!}
                {!! Form::text('factory',null,['size'=>'8']) !!}
              </td>
              <td>
                {!! Form::label('paymt', '付费方式: ') !!}
                {!! Form::text('paymt',null,['size'=>'4']) !!}
              </td>
              <td>{!! Form::submit('查询') !!}</td>
            </tr>
            <tr>
              <td>
                {!! Form::label('mawb', '总单号: ') !!}
                {!! Form::text('mawb',null,['size'=>'12']) !!}
              </td>
              <td>
                {!! Form::label('carrier', '承运人: ') !!}
                {!! Form::text('carrier',null,['size'=>'4']) !!}
              </td>
              <td>
                {!! Form::label('consignee', '收货人: ') !!}
                {!! Form::text('consignee',null,['size'=>'5']) !!}
              </td>
              <td>
                {!! Form::label('seller', '销售: ') !!}
                {!! Form::text('seller',null,['size'=>'4']) !!}
              </td>
              <td>
                {!! Form::label('fltdate', '航班日期: ') !!}
                {!! Form::text('fltstart',null,['size'=>'8']) !!}
                -
                {!! Form::text('fltend',null,['size'=>'8']) !!}
              </td>
              <td>
                {!! Form::label('perpage', '每页显示: ') !!}
                {!! Form::text('perpage',null,['size'=>'4']) !!}
              </td>
              <td>{!! Form::reset('重置') !!}</td>
            </tr>
          </table>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-hover table-bordered table-condensed" style="margin-bottom: 0;">
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
                <th class="text-center"></th>
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