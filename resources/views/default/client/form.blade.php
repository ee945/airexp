@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open() !!}
        @if($errors->any())
        <div class="alert alert-danger text-left" style="width:90%;padding:5px 10px;margin:0 auto 10px auto" role="alert">
          <div style="margin:0 auto">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @elseif(isset($_GET['update']))
        <div class="alert alert-success text-left" style="width:90%;padding:8px 15px;margin:0 auto 10px auto" role="alert">
          <strong>修改成功！</strong>
        </div>
        @endif
        <table class="table text-left" style="width:90%;margin: 0 auto;">
          <col span="8" />
          <tr>
            <td style="width:20%;">{!! Form::label('code', '代码: ') !!}</td>
            @if($title=="添加客户")
            <td style="width:45%;">{!! Form::text('code',isset($client->code)?$client->code:null,['size'=>'16','class' => 'form-control']) !!}</td>
            @elseif($title=="修改客户")
            <td style="width:45%;">{!! Form::text('code',isset($client->code)?$client->code:null,['size'=>'16','class' => 'form-control','readonly'=>'readonly']) !!}</td>
            @endif
            <td style="width:35%;">{!! Form::hidden('id',isset($client->id)?$client->id:null,['class' => 'form-control','readonly'=>'readonly']) !!}</td>
          </tr>
          <tr>
            <td>{!! Form::label('name', '名称: ') !!}</td>
            <td>{!! Form::text('name',isset($client->name)?$client->name:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
          </tr>
          <tr>
            <td>{!! Form::label('cata', '类别: ') !!}</td>
            <td>
              {!! Form::select('cata', [
                '' => '',
                '货源' => '货源',
                '生产单位' => '生产单位',
                '承运人' => '承运人'
                ], isset($client->cata)?$client->cata:null, ['class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>
              {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}<button type="button" onClick="location.href='{!! route('client_list') !!}'" class="form-control btn-danger" style="width:80px;float:right">返回</button>
            </td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
  </div> <!-- /container -->

  <script src="/js/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#code").attr("onkeyup",'this.value=this.value.toUpperCase()');
    });
  </script>
@stop