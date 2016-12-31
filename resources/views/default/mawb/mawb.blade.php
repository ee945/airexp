@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        <style>
          .mawbtab tr td{padding:5px;}
        </style>
        {!! Form::model($mawb) !!}
        @if($errors->any())
        <div class="alert alert-danger text-left" style="width:880px;padding-bottom: 5px;margin:0 auto 10px auto" role="alert">
          <div style="margin:0 auto;">
            <ul>
              @foreach ($errors->all() as $error)
              <li><strong>{{ $error }}</strong></li>
              @endforeach
            </ul>
          </div>
        </div>
        @elseif(isset($_GET['save']))
        <div class="alert alert-success text-center" style="width:880px;padding:8px 0px;margin:0 auto 10px auto" role="alert">
          <strong>保存成功！</strong>
          <a href="{{ route('print_mawb',['mawb'=>$mawb->mawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        @endif
        <table class="mawbtab" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;border-collapse:collapse;margin:0 auto">
          <colgroup>
            <col width="220px" />
            <col width="220px" />
            <col width="420px" />
            <col width="10px" />
            <col width="10px" />
          </colgroup>
          <tr>
            <td height="20" style="border-bottom: 0px;">Shipper's Name and Address</td>
            <td>Shipper's Account Number</td>
            <td colspan="3" rowspan="2">
              <span style="float:left;">AIR WAYBILL</span>
              {!! Form::text('mawb',null,['hidden'=>'hidden']) !!}
              {!! Form::text('depa',null,['hidden'=>'hidden']) !!}
              <span style="float:right;font-size:36px;"><a href="">{{ $mawb->mawb }}</a></span>
            </td>
          </tr>
          <tr>
            <td height="90" colspan="2" style="border-top: 0px;">
              {!! Form::textarea('shipper',null,['rows'=>5,'cols'=>45]) !!}
            </td>
          </tr>
          <tr>
            <td height="20" style="border-bottom: 0px;">Consignee's Name and Address*</td>
            <td>
              {!! Form::text('oversea',null,['size'=>10]) !!}
            </td>
            <td colspan="3" rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="90" colspan="2" style="border-top: 0px;">
              {!! Form::textarea('consignee',null,['rows'=>5,'cols'=>45]) !!}
            </td>
          </tr>
          <tr>
            <td height="45" colspan="2">Issuing Carrier's Agent Name and City<br />
              {!! Form::text('agentabbr',null) !!}
            </td>
            <td colspan="3" rowspan="3">Accounting Information<br />FREIGHT PREPAID</td>
          </tr>
          <tr>
            <td height="40">Agent's IATA Code<br />
              {!! Form::text('agentcode',null) !!}
            </td>
            <td>Account NO.<br />
              {!! Form::text('agentaccount',null) !!}
            </td>
          </tr>
          <tr>
            <td height="40" colspan="2">Airport of Departure(addr. OF First Carrier) and Requested Routing<br />
              {!! Form::text('depar',null) !!}
            </td>
          </tr>
            <tr>
              <td colspan="2" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="15%" height="20">To</td>
                  <td width="35%">By First Carrier</td>
                  <td width="15%">to</td>
                  <td width="10%">by</td>
                  <td width="15%">to</td>
                  <td>by</td>
                </tr>
                <tr>
                  <td height="25">{!! Form::text('dest',null,['size'=>5]) !!}</td>
                  <td>{!! Form::text('carrier',null,['size'=>5]) !!}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </td>
              <td colspan="3" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="8%" height="20">Currency</td>
                  <td width="6%">CHGS</td>
                  <td colspan="2" width="14%" align="center">WT/VAL</td>
                  <td colspan="2" width="14%" align="center">Other</td>
                  <td width="24%">D.V.for Carriage</td>
                  <td>D.V.for Custom</td>
                </tr>
                <tr>
                  <td height="25"><input type="text" value="CNY" readonly="readonly" size="3"></td>
                  <td>&nbsp;</td>
                  <td width="7%">PP</td>
                  <td width="7%">&nbsp;</td>
                  <td width="7%">PP</td>
                  <td width="7%">&nbsp;</td>
                  <td>NVD.</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24%" height="20">Airport of Dest.</td>
                  <td width="23%" style="border-bottom:0px;">Flt Date</td>
                  <td colspan="2" width="30%" align="center">For Carrier Use Only</td>
                  <td width="23%" style="border-bottom:0px;">Flt Date</td>
                </tr>
                <tr>
                  <td height="25">{!! Form::text('desti',null,['size'=>10]) !!}</td>
                  <td colspan="2" style="border-top:0px;">
                    {!! Form::text('fltno',null,['size'=>6]) !!}/{!! Form::text('fltdate',null,['size'=>10]) !!}</td>
                  <td colspan="2" style="border-top:0px;">&nbsp;</td>
                </tr>
              </table>
              </td>
              <td colspan="3">Amount of Insurance</td>
            </tr>
            <tr>
              <td height="50" colspan="5">Handling Information<br />
              {!! Form::textarea('special',null,['rows'=>2,'cols'=>100]) !!}
              </td>
            </tr>
            <tr>
              <td colspan="5" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td width="8%" height="30">No of Pieces</td>
                  <td width="14%">Gross Weight</td>
                  <td width="5%">KG<br>lb</td>
                  <td width="5%">Rate Class</td>
                  <td width="14%">Chargeable Weight</td>
                  <td width="10%">Rate/Charge</td>
                  <td width="14%">Total</td>
                  <td width="30%">Nature and Quantity of Goods</td>
                </tr>
                <tr>
                  <td height="25" style="border-bottom:0px;">{!! Form::text('package',null,['size'=>4]) !!}</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td rowspan="3" align="center" valign="top">
                  {!! Form::textarea('cgodescp',null,['rows'=>12,'cols'=>40]) !!}<br />
                  {!! Form::text('cbm',isset($mawb->cbm)?round($mawb->cbm,3):null,['size'=>6]) !!}
                  <input type='button' name="getcbm" value="CBM"/>
                  <input type='button' name="getres" value="RES"/>
                  {{-- <button name="getres">RES</button> --}}
                  </td>
                </tr>
                <tr>
                  <td height="150" valign="top" style="border-top:0px;">{!! Form::text('num',null,['size'=>4]) !!}</td>
                  <td valign="top" style="border-top:0px;">{!! Form::text('gw',null,['size'=>8]) !!}</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">K.</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">{!! Form::text('rclass',null,['size'=>1]) !!}</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">{!! Form::text('cw',null,['size'=>8]) !!}</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">{!! Form::text('up',null,['size'=>5]) !!}</td>
                  <td valign="top" style="border-top:0px;">{!! Form::text('freight',null,['size'=>10,'readonly'=>'readonly']) !!}</td>
                </tr>
                <tr>
                  <td style="border-top:0px;" height="25">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                  <td style="border-top:0px;">&nbsp;</td>
                </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td height="300" colspan="5" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <colgroup>
                  <col width="100px" />
                  <col width="100px" />
                  <col width="100px" />
                  <col width="100px" />
                  <col width="600px" />
                </colgroup>
                <tr>
                  <td width="10%" height="20" align="center">Prepaid</td>
                  <td colspan="2" width="20%" align="center">Weight Charge</td>
                  <td width="10%" align="center">Collect</td>
                  <td width="60%" rowspan="6" valign="top">
                  Other Charges<br />
                  <table width="90%" border="0">
                    <tr align="center">
                      <td width="33%">{!! Form::text('awn',null,['size'=>8]) !!}</td>
                      <td width="33%">&nbsp;</td>
                      <td>{!! Form::text('aw',null,['size'=>8,'class'=>'text-right']) !!}</td>
                    </tr>
                    <tr align="center">
                      <td>{!! Form::text('myn',null,['size'=>8]) !!}</td>
                      <td>{!! Form::text('myup',null,['size'=>8,'class'=>'text-right']) !!}</td>
                      <td>{!! Form::text('my',null,['size'=>8,'class'=>'text-right']) !!}</td>
                    </tr>
                    <tr align="center">
                      <td>{!! Form::text('scn',null,['size'=>8]) !!}</td>
                      <td>{!! Form::text('scup',null,['size'=>8,'class'=>'text-right']) !!}</td>
                      <td>{!! Form::text('sc',null,['size'=>8,'class'=>'text-right']) !!}</td>
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="20">&nbsp;</td>
                  <td colspan="2">Valuation Charge</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="20">&nbsp;</td>
                  <td colspan="2">Tax</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr>
                  <td height="20" align="center">&nbsp;</td>
                  <td colspan="2" align="center">Total Other Charge Due Agent</td>
                  <td align="center">&nbsp;</td>
                  <td rowspan="5" align="center">Shipper certifies that the particulars on the face hereof are correct and that insofar as any part of the consignment contains dangerous goods,such part is properly described by name and is in proper condition for carriage by air according to the applicable Dangerous Goods Regulations.<br /><br />
                  {!! Form::text('signature',null,['size'=>18]) !!}<br /><br />
                  Signature of shipper or his Agent
                  </td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="20">&nbsp;</td>
                  <td colspan="2">Total Other Charge Due Carrier</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="25" colspan="2">{!! Form::text('other',null,['size'=>10,'class'=>'text-right','readonly'=>'readonly']) !!}</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="20" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr>
                  <td height="20" colspan="2" align="center">Total Prepaid</td>
                  <td colspan="2" align="center">Total Collect</td>
                  <td rowspan="4" align="center">
                  <table width="70%">
                    <tr>
                      <td width="33%">{!! Form::text('opdate',null,['size'=>10]) !!}</td>
                      <td width="33%">{!! Form::text('atplace',null,['size'=>10]) !!}</td>
                      <td>{!! Form::text('operator',null,['size'=>10]) !!}</td>
                    </tr>
                    <tr>
                      <td>Executed On date</td>
                      <td>at place</td>
                      <td>Signature</td>
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2">{!! Form::text('amount',null,['size'=>10,'class'=>'text-right','readonly'=>'readonly']) !!}</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr align="center">
                  <td height="20" colspan="2">Currency Rate</td>
                  <td colspan="2">CC charges in Dest.</td>
                  </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
                <tr>
                  <td height="20" colspan="2" align="center">Charges at Dest</td>
                  <td colspan="2" align="center">Total Collect Charges</td>
                  <td rowspan="2" align="right" style="font-size:36px;">{{ $mawb->mawb }}</td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <div class="text-center" style="padding:10px 0px;">
          {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}
          <a href="{{ route('print_mawb',['mawb'=>$mawb->mawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <script src="/js/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(":text").attr("style",'text-transform:uppercase;');
      $("textarea").attr("style",'text-transform:uppercase;');
    });

    //输入海外代理代码，自动显示海外代理（即总单收货人）地址
    $("input[name='oversea']").blur(function(){
      var oversea=$("input[name='oversea']").val();
      if(oversea!=''){
        $.get('{{url('get/mconsignee')}}/'+oversea,function(json){
          if(json.addr==null)json.addr=='';
          $("textarea[name='consignee']").val(json.addr);
        });
      }
    });

    //输入运价级别后，自动根据数据库中保存的目的港信息，显示运费单价
    $("input[name='rclass']").blur(function(){
      var dest=$("input[name='dest']").val();
      var rclass=$("input[name='rclass']").val().toUpperCase();
      if(dest!=''){
        $.get('{{url('get/dest')}}/'+dest,function(json){
          if(json.name==null)json.name=='';
          if(rclass=="M"){
            $("input[name='up']").val(json.m);
          }else if(rclass=="N"){
            $("input[name='up']").val(json.n);
          }else if(rclass=="Q"){
            $("input[name='up']").val(json.q);
          }
        });
      }
    });

    $("input[name='rclass']").blur(function(){
    //输入运价级别后,同时判断是否是minimum运价
      rclass=$("input[name='rclass']").val().toUpperCase();
      cw=$("input[name='cw']").val();
      up=$("input[name='up']").val();
      other=$("input[name='other']").val();
      if(rclass=="M"){
        freight=up; //如果是M运价,则单价即为运费
      }else{
        freight=Math.round(cw*up*100)/100;  //如不是M价，运费为收费重量*单价，取整
      }
      amount=freight*1+other*1  //总价=运费+其他杂费
      $("input[name='freight']").attr("value",freight);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='cw']").blur(function(){
    //输入收费重量后自动刷新其他费用信息
      rclass=$("input[name='rclass']").val().toUpperCase();
      cw=$("input[name='cw']").val();
      up=$("input[name='up']").val();
      aw=$("input[name='aw']").val();
      myup=$("input[name='myup']").val();
      scup=$("input[name='scup']").val();
      other=$("input[name='other']").val();
      if(rclass=="M"){
        freight=up;
      }else{
        freight=Math.round(cw*up*100)/100;
      }
      my=cw*myup;  //油费
      sc=cw*scup;  //战险
      other=aw*1+my*1+sc*1;  //杂费
      amount=freight*1+other*1;  //总费用
      $("input[name='cw']").attr("value",cw);
      $("input[name='freight']").attr("value",freight);
      $("input[name='my']").attr("value",my);
      $("input[name='sc']").attr("value",sc);
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='cw']").blur(function(){
    //判断收费重量是否小于实际重量
      gw=$("input[name='gw']").val();
      cw=$("input[name='cw']").val();
      if(eval(cw)<eval(gw)){
      alert("收费重量不能小于实际重量！");
      return false;
    }
    });

    $("input[name='up']").blur(function(){
    //输入单价后自动刷新其他费用信息
      rclass=$("input[name='rclass']").val().toUpperCase();
      cw=$("input[name='cw']").val();
      up=$("input[name='up']").val();
      other=$("input[name='other']").val();
    if(rclass=="M"){
        freight=up;
      }else{
        freight=Math.round(cw*up*100)/100;
      }
      amount=freight*1+other*1
      $("input[name='freight']").attr("value",freight);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='myup']").blur(function(){
    //输入油费单价后自动刷新其他费用信息
      gw=$("input[name='gw']").val();
      cw=$("input[name='cw']").val();
      aw=$("input[name='aw']").val();
      sc=$("input[name='sc']").val();
      freight=$("input[name='freight']").val();
      myup=$("input[name='myup']").val();
      my=cw*myup;
      other=aw*1+my*1+sc*1;
      amount=freight*1+other*1
      $("input[name='my']").attr("value",my);
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='scup']").blur(function(){
    //输入战险单价后自动刷新其他费用信息
      gw=$("input[name='gw']").val();
      cw=$("input[name='cw']").val();
      freight=$("input[name='freight']").val();
      aw=$("input[name='aw']").val();
      my=$("input[name='my']").val();
      scup=$("input[name='scup']").val();
      sc=cw*scup;
      other=aw*1+my*1+sc*1;
      amount=freight*1+other*1
      $("input[name='sc']").attr("value",sc);
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='aw']").blur(function(){
    //输入制单费（总单单证费）后自动刷新其他费用信息
      freight=$("input[name='freight']").val();
      aw=$("input[name='aw']").val();
      my=$("input[name='my']").val();
      sc=$("input[name='sc']").val();
      other=aw*1+my*1+sc*1;
      amount=freight*1+other*1
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='my']").blur(function(){
    //输入油费后自动刷新其他费用信息，一般输入油费单价后，此项会自动输入
      freight=$("input[name='freight']").val();
      aw=$("input[name='aw']").val();
      my=$("input[name='my']").val();
      sc=$("input[name='sc']").val();
      other=aw*1+my*1+sc*1;
      amount=freight*1+other*1
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='sc']").blur(function(){
    //输入战险后自动刷新其他费用信息，一般输入战险单价后，此项会自动输入，注意：战险有minimum，需手动修改
      freight=$("input[name='freight']").val();
      aw=$("input[name='aw']").val();
      my=$("input[name='my']").val();
      sc=$("input[name='sc']").val();
      other=aw*1+my*1+sc*1;
      amount=freight*1+other*1
      $("input[name='other']").attr("value",other);
      $("input[name='amount']").attr("value",amount);
    });

    $("input[name='getcbm']").click(function(){
    //体积快捷输入按钮
    //正常泡货情况下，运单上体积小于实际体积，等于实际重量*0.006，向下取整
      gw=$("input[name='gw']").val();
      cbm=gw*0.006;
      if(cbm<0.01){
        cbm=Math.floor(gw*0.006*1000)/1000;
      }else if(cbm<0.1){
        cbm=Math.floor(gw*0.006*100)/100;
      }else{
        cbm=Math.floor(gw*0.006*10)/10;
      }  //此处分3种情况，防止体积过小而被割舍取整为0
      $("input[name='cbm']").attr("value",cbm);
    });

    $("input[name='getres']").click(function(){
    //快速在品名栏加上NOT RESTRICTED非限制货物（OSA货物常用）
      cgodescp=$("textarea[name='cgodescp']").val()+"\nNOT RESTRICTED";
      console.log(cgodescp);
      $("textarea[name='cgodescp']").val(cgodescp);
    });
</script>
@stop