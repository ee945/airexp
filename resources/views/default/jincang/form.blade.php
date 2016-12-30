@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if(isset($_GET['update']))
        <div class="alert alert-success text-left" style="padding:8px 15px;margin-bottom:10px" role="alert">
          <strong>修改成功！</strong>
        </div>
        @endif
        <table class="table text-left" style="width:90%;margin: 0 auto;">
          <col span="8" />
          <tr>
            <td style="width:15%;">{!! Form::label('regdate', '托运日期: ') !!}</td>
            <td style="width:35%;">{!! Form::date('regdate',isset($jincang->regdate)?$jincang->regdate:date('Y-m-d'),['size'=>'16']) !!}</td>
            <td style="width:15%;">{!! Form::label('fltdate', '航班日期: ') !!}</td>
            <td style="width:35%;">{!! Form::date('fltdate',isset($jincang->fltdate)?$jincang->fltdate:null,['size'=>'16']) !!}</td>
          </tr>
          <tr>
            <td>{!! Form::label('jcno', '进仓编号: ') !!}</td>
            @if($title=="进仓登记")
            <td>{!! Form::text('jcno',isset($jincang->jcno)?$jincang->jcno:null,['size'=>'16']) !!}</td>
            @elseif($title=="进仓修改")
            <td>{!! Form::text('jcno',isset($jincang->jcno)?$jincang->jcno:null,['size'=>'16','readonly'=>'readonly']) !!}</td>
            @endif
            <td rowspan="7">{!! Form::label('cargodata', '货物信息: ') !!}</td>
            <td rowspan="7">{!! Form::textarea('cargodata',isset($jincang->cargodata)?$jincang->cargodata:null,['rows'=>12,'cols'=>30]) !!}</td>
          </tr>
          <tr>
            <td>{!! Form::label('dest', '目的港: ') !!}</td>
            <td>{!! Form::text('dest',isset($jincang->dest)?$jincang->dest:null,['size'=>'16']) !!}</td>
          </tr>
          <tr>
          </tr>
          <tr>
            <td>{!! Form::label('client', '托运人: ') !!}</td>
            <td>{!! Form::text('client',isset($jincang->client)?$jincang->client:null,['size'=>'16']) !!}</td>
          </tr>
          <tr>
            <td>{!! Form::label('forwardcode', '货源: ') !!}</td>
            <td>
              {!! Form::text('forwardcode',null,['size'=>'4']) !!}
              {!! Form::label('forward', "&nbsp;") !!}
              {!! Form::text('forward',isset($jincang->forward)?$jincang->forward:null,['size'=>'9']) !!}
            </td>
          </tr>
          <tr>
            <td>{!! Form::label('factorycode', '厂家: ') !!}</td>
            <td>
              {!! Form::text('factorycode',null,['size'=>'4']) !!}
              {!! Form::label('factory', "&nbsp;") !!}
              {!! Form::text('factory',isset($jincang->factory)?$jincang->factory:null,['size'=>'9']) !!}
            </td>
          </tr>
          <tr>
            <td>{!! Form::label('carrier', '承运方: ') !!}</td>
            <td>{!! Form::text('carrier',isset($jincang->carrier)?$jincang->carrier:null,['size'=>'16']) !!}</td>
          </tr>
          <tr>
            <td>{!! Form::label('remark', '备注: ') !!}</td>
            <td>{!! Form::textarea('remark',isset($jincang->remark)?$jincang->remark:null,['rows'=>5,'cols'=>30]) !!}</td>
            <td>{!! Form::label('delivery', '交货要求: ') !!}</td>
            <td>{!! Form::textarea('delivery',isset($jincang->delivery)?$jincang->delivery:null,['rows'=>5,'cols'=>30]) !!}</td>
          </tr>
          @if($errors->any())
          <tr>
            <td colspan="2">
              <ul class="alert alert-danger" role="alert" style="padding:5px 20px;margin-bottom:5px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </td>
          </tr>
          @endif
          <tr>
            <td></td>
            <td>
              {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
  </div> <!-- /container -->

  <script src="/js/jquery.min.js"></script>
  <script>
    // $(document).ready(function(){
    //   $(":text").attr("onkeyup",'this.value=this.value.toUpperCase()');
    //   $("textarea").attr("onkeyup",'this.value=this.value.toUpperCase()');
    // });

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
  </script>
@stop