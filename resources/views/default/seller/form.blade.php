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
            <td style="width:20%;">{!! Form::label('forward', '货源: ') !!}</td>
            @if($title=="添加销售分配")
            <td style="width:45%;">{!! Form::text('forward',isset($seller->forward)?$seller->forward:null,['size'=>'16','class' => 'form-control']) !!}</td>
            @elseif($title=="修改销售分配")
            <td style="width:45%;">{!! Form::text('forward',isset($seller->forward)?$seller->forward:null,['size'=>'16','class' => 'form-control','readonly'=>'readonly']) !!}</td>
            @endif
            <td style="width:35%;"></td>
          </tr>
          <tr>
            <td>{!! Form::label('seller', '销售人: ') !!}</td>
            <td>{!! Form::text('seller',isset($seller->seller)?$seller->seller:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('remark', '备注: ') !!}</td>
            <td>{!! Form::textarea('remark',isset($seller->remark)?$seller->remark:null,['rows'=>6,'cols'=>50,'class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>
              {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}<button type="button" onClick="location.href='{!! route('seller_list') !!}'" class="form-control btn-danger" style="width:80px;float:right">返回</button>
            </td>
          </tr>
        </table>
        {!! Form::close() !!}
      </div>
    </div>
  </div> <!-- /container -->

  <script src="/js/jquery.min.js"></script>
  <script>
  </script>
@stop