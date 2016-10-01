@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row text-center">
      {!! Form::open() !!}
        @if(isset($_GET['update']))
        <div class="alert alert-success text-left" style="padding:8px 15px;margin-bottom:10px" role="alert">
          <strong>修改成功！</strong>
        </div>
        @endif
      <table class="table text-left" style="width:90%;">
        <col span="8" />
        <tr>
          <td style="width:80px;">{!! Form::label('opdate', '操作日期: ') !!}</td>
          <td>{!! Form::date('opdate',isset($hawb->opdate)?$hawb->opdate:date('Y-m-d'),['size'=>'16']) !!}</td>
          <td style="width:80px;"></td>
          <td></td>
          <td style="width:80px;"></td>
          <td></td>
        </tr>
        <tr>
          <td>{!! Form::label('hawb', '分单号: ') !!}</td>
          @if($title=="分单输入")
          <td>{!! Form::text('hawb',isset($hawb->hawb)?$hawb->hawb:null,['size'=>'16']) !!}</td>
          @elseif($title=="分单修改")
          <td>{!! Form::text('hawb',isset($hawb->hawb)?$hawb->hawb:null,['size'=>'16','readonly'=>'readonly']) !!}</td>
          @endif
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
          <td>{!! Form::date('fltdate',isset($hawb->fltdate)?$hawb->fltdate:date('Y-m-d',strtotime("+1 day")),['size'=>'16']) !!}</td>
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
            {!! Form::text('carriername',isset($hawb->carriername)?$hawb->carriername:null,['size'=>'7','readonly'=>'readonly']) !!}
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
            @if($errors->any())
            <ul class="alert alert-danger" role="alert" style="padding:5px 20px;margin-bottom:5px;">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif
          </td>
        </tr>
          <tr>
          <td></td>
          <td>{!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:100px;']) !!}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      {!! Form::close() !!}
    </div>
  </div> <!-- /container -->

  <script src="/js/jquery.min.js"></script>
  <script>
    $("input[name='cbm']").blur(function(){
    //输入体积自动处理收费重量
      cbmw=$("input[name='cbm").val()/0.006;
      gw=$("input[name='gw']").val();
      cw=Math.round((cbmw>=gw)?cbmw:gw);
      $("input[name='cw']").attr("value",cw);
    });
    $("input[name='gw']").blur(function(){
    //输入实际重量自动处理收费重量
      cbmw=$("input[name='cbm").val()/0.006;
      gw=$("input[name='gw']").val();
      cw=Math.round((cbmw>=gw)?cbmw:gw);
      $("input[name='cw']").attr("value",cw);
    });
  </script>
@stop