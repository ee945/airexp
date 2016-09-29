@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row text-center">
      {!! Form::open() !!}
      <table class="table text-left" style="width:90%;">
        <col span="8" />
        <tr>
          <td style="width:80px;">{!! Form::label('opdate', '操作日期: ') !!}</td>
          <td>{!! Form::text('opdate',isset($hawb->opdate)?$hawb->opdate:null,['size'=>'16']) !!}</td>
          <td style="width:80px;"></td>
          <td></td>
          <td style="width:80px;"></td>
          <td></td>
        </tr>
        <tr>
          <td>{!! Form::label('hawb', '分单号: ') !!}</td>
          <td>{!! Form::text('hawb',isset($hawb->hawb)?$hawb->hawb:null,['size'=>'16','readonly'=>'readonly']) !!}</td>
          <td>{!! Form::label('mawb', '总单号: ') !!}</td>
          <td>{!! Form::text('mawb',isset($hawb->mawb)?$hawb->mawb:null,['size'=>'16']) !!}</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>{!! Form::label('dest', '目的港: ') !!}</td>
          <td>
            {!! Form::text('dest',isset($hawb->dest)?$hawb->dest:null,['size'=>'3']) !!}
            {!! Form::label('desti', "&nbsp;") !!}
            {!! Form::text('desti',isset($hawb->desti)?$hawb->desti:null,['size'=>'10']) !!}
          </td>
          <td>{!! Form::label('fltno', '航班号: ') !!}</td>
          <td>{!! Form::text('fltno',isset($hawb->fltno)?$hawb->fltno:null,['size'=>'16']) !!}</td>
          <td>{!! Form::label('fltdate', '航班日期: ') !!}</td>
          <td>{!! Form::text('fltdate',isset($hawb->fltdate)?$hawb->fltdate:null,['size'=>'16']) !!}</td>
        </tr>
        <tr>
          <td>{!! Form::label('forwardcode', '货源: ') !!}</td>
          <td>
            {!! Form::text('forwardcode',null,['size'=>'3']) !!}
            {!! Form::label('forward', "&nbsp;") !!}
            {!! Form::text('forward',isset($hawb->forward)?$hawb->forward:null,['size'=>'5']) !!}
            {!! Form::label('seller', "&nbsp;") !!}
            {!! Form::text('seller',isset($hawb->seller)?$hawb->seller:null,['size'=>'4']) !!}
          </td>
          <td>{!! Form::label('factorycode', '生产厂家: ') !!}</td>
          <td>
            {!! Form::text('factorycode',null,['size'=>'3']) !!}
            {!! Form::label('factory', "&nbsp;") !!}
            {!! Form::text('factory',isset($hawb->factory)?$hawb->factory:null,['size'=>'10']) !!}
          </td>
          <td>{!! Form::label('carrier', '承运方: ') !!}</td>
          <td>
            {!! Form::text('carrier',isset($hawb->carrier)?$hawb->carrier:null,['size'=>'6']) !!}
            {!! Form::label('carriername', "&nbsp;") !!}
            {!! Form::text('carriername',isset($hawb->carriername)?$hawb->carriername:null,['size'=>'7']) !!}
          </td>
        </tr>
        <tr>
          <td>{!! Form::label('num', '件数: ') !!}</td>
          <td>{!! Form::text('num',isset($hawb->num)?$hawb->num:null,['size'=>'16']) !!}</td>
          <td>{!! Form::label('gw', '重量: ') !!}</td>
          <td>{!! Form::text('gw',isset($hawb->gw)?$hawb->gw:null,['size'=>'16']) !!}</td>
          <td>{!! Form::label('cbm', '体积: ') !!}</td>
          <td>
            {!! Form::text('cbm',isset($hawb->cbm)?$hawb->cbm:null,['size'=>'6']) !!}
            {!! Form::label('cw', "&nbsp;") !!}
            {!! Form::text('cw',isset($hawb->cw)?$hawb->cw:null,['size'=>'7','readonly'=>'readonly']) !!}
          </td>
        </tr>
        <tr>
          <td>{!! Form::label('paymt', '付费方式: ') !!}</td>
          <td>{!! Form::text('paymt',isset($hawb->paymt)?$hawb->paymt:null,['size'=>'16']) !!}</td>
          <td>{!! Form::label('arranged', '价格显示: ') !!}</td>
          <td>
            {!! Form::radio('arranged',0,isset($hawb->arranged)?($hawb->arranged=="0"?true:false):true) !!}不显示&nbsp;
            {!! Form::radio('arranged',1,isset($hawb->arranged)?($hawb->arranged=="1"?true:false):false) !!}显示&nbsp;
          </td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>{!! Form::label('remark', '备注: ') !!}</td>
          <td>{!! Form::textarea('remark',isset($hawb->remark)?$hawb->remark:null,['rows'=>5,'cols'=>25]) !!}</td>
          <td colspan="4">
            <div class="alert alert-danger" role="alert" style="padding:5px;margin-bottom:5px;display:none;" id="alert_mawb">
              <strong>错误！</strong>总单号不符合规则
            </div>
            <div class="alert alert-danger" role="alert" style="padding:5px;margin-bottom:5px;display:none;" id="alert_paymt">
              <strong>错误！</strong>不存在的付费方式
            </div>
            <div class="alert alert-warning" role="alert" style="padding:5px;margin-bottom:5px;display:none;" id="alert_heavy">
              <strong>警告！</strong>此货物过重
            </div>
            <div class="alert alert-warning" role="alert" style="padding:5px;margin-bottom:5px;display:none;" id="alert_light">
              <strong>警告！</strong>此货物过轻
            </div>
          </td>
        </tr>
          <tr>
          <td></td>
          <td><input class="btn btn-primary" id="submit" type="submit" name="edithawb" value="修改"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      {!! Form::close() !!}
    </div>
  </div> <!-- /container -->
  <script>

  </script>
@stop