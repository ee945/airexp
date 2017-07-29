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
            <td style="width:10%;">{!! Form::label('code', '代码: ') !!}</td>
            <td style="width:33%;">{!! Form::text('code',isset($contact->code)?$contact->code:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td style="width:10%;"></td>
            <td style="width:33%;"></td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('name', '姓名: ') !!}</td>
            <td>{!! Form::text('name',isset($contact->name)?$contact->name:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td>{!! Form::label('gender', '性别: ') !!}</td>
            <td>
              {!! Form::radio('gender','男',isset($contact->gender)?($contact->gender=="男"?true:false):false) !!}男&nbsp;&nbsp;&nbsp;&nbsp;
              {!! Form::radio('gender','女',isset($contact->gender)?($contact->gender=="女"?true:false):false) !!}女&nbsp;&nbsp;&nbsp;&nbsp;
              {!! Form::radio('gender','未知',isset($contact->gender)?($contact->gender=="未知"?true:false):true) !!}未知&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('company', '公司: ') !!}</td>
            <td>{!! Form::text('company',isset($contact->company)?$contact->company:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td>{!! Form::label('title', '职位: ') !!}</td>
            <td>{!! Form::text('title',isset($contact->title)?$contact->title:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('mobile', '手机: ') !!}</td>
            <td>{!! Form::text('mobile',isset($contact->mobile)?$contact->mobile:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td>{!! Form::label('im', '即时通讯: ') !!}</td>
            <td>{!! Form::text('im',isset($contact->im)?$contact->im:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('tel', '座机: ') !!}</td>
            <td>{!! Form::text('tel',isset($contact->tel)?$contact->tel:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td>{!! Form::label('fax', '传真: ') !!}</td>
            <td>{!! Form::text('fax',isset($contact->fax)?$contact->fax:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('mail', '邮件: ') !!}</td>
            <td>{!! Form::text('mail',isset($contact->mail)?$contact->mail:null,['size'=>'16','class' => 'form-control']) !!}</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>{!! Form::label('address', '地址: ') !!}</td>
            <td>{!! Form::textarea('address',isset($contact->address)?$contact->address:null,['rows'=>6,'cols'=>50,'class' => 'form-control']) !!}</td>
            <td>{!! Form::label('remark', '备注: ') !!}</td>
            <td>{!! Form::textarea('remark',isset($contact->remark)?$contact->remark:null,['rows'=>6,'cols'=>50,'class' => 'form-control']) !!}</td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>
              {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}<button type="button" onClick="location.href='{!! route('contact_list') !!}'" class="form-control btn-danger" style="width:80px;float:right">返回</button>
            <td></td>
            <td></td>
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