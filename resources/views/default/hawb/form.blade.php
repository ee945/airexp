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
          <td>
            {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}
            @if(isset($hawb->hawb))
            &nbsp;&nbsp;
            <a href="{{ route('hawb_print',['hawb'=>$hawb->hawb])}}" type="button" class="btn btn-success">打印</a>
            @endif
          </td>
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
    $(document).ready(function(){
      $(":text").attr("style",'text-transform:uppercase;');
      $("textarea").attr("style",'text-transform:uppercase;');
    });
    //输入体积自动处理收费重量
    $("input[name='cbm']").blur(function(){
      cbmw=$("input[name='cbm']").val()/0.006;
      gw=$("input[name='gw']").val();
      cw=Math.round((cbmw>=gw)?cbmw:gw);
      $("input[name='cw']").attr("value",cw);
    });

    //输入实际重量自动处理收费重量
    $("input[name='gw']").blur(function(){
      cbmw=$("input[name='cbm']").val()/0.006;
      gw=$("input[name='gw']").val();
      cw=Math.round((cbmw>=gw)?cbmw:gw);
      $("input[name='cw']").attr("value",cw);
    });

    //输入目的港三字代码自动显示补全机场全称
    $("input[name='dest']").blur(function(){
      var dest = $("input[name='dest']").val();
      if(dest!=''){
        $.get('{{url('get/dest')}}/'+dest,function(json){
          if(json.name==null)json.name=='';
          $("input[name='desti']").val(json.name);
        });
      }
    });

    //输入货源代码自动显示补全名称
    $("input[name='forwardcode']").blur(function(){
      var forwardcode = $("input[name='forwardcode']").val();
      if(forwardcode!=""){
        $.get('{{url('get/forward')}}/'+forwardcode,function(json){
          if(json.name==null)json.name=='';
          $("input[name='forward']").val(json.name);
        });
      }
    });

    //输入生产单位代码自动显示补全名称
    $("input[name='factorycode']").blur(function(){
      var factorycode = $("input[name='factorycode']").val();
      if(forwardcode!=""){
        $.get('{{url('get/factory')}}/'+factorycode,function(json){
          if(json.name==null)json.name=='';
          $("input[name='factory']").val(json.name);
        });
      }
    });

    //输入承运人代码自动显示补全名称
    $("input[name='carrier']").blur(function(){
      var carrier = $("input[name='carrier']").val();
      if(carrier!=""){
        $.get('{{url('get/carrier')}}/'+carrier,function(json){
          if(json.name==null)json.name=='';
          $("input[name='carriername']").val(json.name);
        });
      }
    });

    $("input[name='forward']").blur(function(){
    //根据货源名称自动显示补全所属销售人
      var forward = $("input[name='forward']").val();
      var defaultseller = "{{ env('CONF_AGENT_CODE', 'CODE') }}";
      if(forward!=""){
        $.get('{{url('get/seller')}}/'+forward,function(json){
          if(json.seller!=null){
            $("input[name='seller']").val(json.seller);
          }else{
            $("input[name='seller']").val(defaultseller);
          }
        });
      }
    });
  </script>
@stop