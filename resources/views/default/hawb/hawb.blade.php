@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        <style>
          .mawbtab tr td{padding:5px;}
        </style>
        {!! Form::open() !!}
        @if(isset($_GET['save']))
        <div class="alert alert-success text-center" style="width:880px;padding:8px 0px;margin-bottom:15px" role="alert">
          <strong>保存成功！</strong>
          <a href="{{ route('print_hawb',['hawb'=>$hawb->hawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger text-left" style="width:880px;padding-bottom: 5px;margin-bottom:15px" role="alert">
          <div style="margin-left:auto;margin-right:auto;">
            <ul>
              @foreach ($errors->all() as $error)
              <li><strong>{{ $error }}</strong></li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
        <table class="mawbtab" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
          <colgroup>
            <col width="220px" />
            <col width="220px" />
            <col width="220px" />
            <col width="220px" />
          </colgroup>
          <tr>
            <td colspan="2" height="20" style="font-size:20px;">MAWB <span style="color:#000000;font-size:20px;">{!! $hawb->mawb !!}</span></td>
            <td colspan="2" height="20" align="right" style="font-size:20px;">HAWB YH - <span style="color:#000000;font-size:20px;">{!! Form::text('hawb',$hawb->hawb,['hidden'=>'hidden']) !!}{!! $hawb->hawb !!}</span></td>
          </tr>
          <tr >
            <td colspan="2" valign="top">Shipper's Name and Address
            {!! Form::text('shippercode',null,['size'=>'8']) !!}<br>
            {!! Form::textarea('shipper',isset($hawb->shipper)?$hawb->shipper:null,['rows'=>5,'cols'=>45]) !!}
            </td>
            <td colspan="2" valign="top">LOGO</td>
          </tr>

          <tr >
            <td colspan="2" valign="top">Consignee's Name and Address
            {!! Form::text('consigneecode',null,['size'=>'8']) !!}<br>
            {!! Form::textarea('consignee',isset($hawb->consignee)?$hawb->consignee:null,['rows'=>5,'cols'=>45]) !!}
            </td>
            <td colspan="2" valign="top">Hawb Condition Information</td>
          </tr>

          <tr >
            <td colspan="2" valign="top">Also Notify
            {!! Form::text('notifycode',null,['size'=>'8']) !!}<br>
            {!! Form::textarea('notify',($hawb->notify!="")?$hawb->notify:$notify,['rows'=>5,'cols'=>45]) !!}
            </td>
            <td colspan="2" rowspan="2" valign="top">Accounting Information</td>
          </tr>

          <tr>
            <td colspan="2">
              Airport of Departure<br>
              {!! Form::text('depar',($hawb->depar!="")?$hawb->depar:$depar,['size'=>'20']) !!}
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding:0px">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="6" align="center">Routing and Destination</td>
                </tr>
                <tr>
                  <td width="15%">To</td>
                  <td width="35%">By First Carrier</td>
                  <td width="15%">to</td>
                  <td width="10%">by</td>
                  <td width="15%">to</td>
                  <td>by</td>
                </tr>
                <tr>
                  <td>{!! Form::text('dest',$hawb->dest,['size'=>'3','readonly'=>'readonly']) !!}</td>
                  <td>{!! Form::text('fltprefix',substr($hawb->fltno,0,2),['size'=>'3','readonly'=>'readonly']) !!}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td colspan="2" style="padding:0px">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr>
                  <td rowspan='2' width="12%">Currency</td>
                  <td rowspan='2' colspan="2" width="20%" align="center">WT/VAL</td>
                  <td rowspan='2' colspan="2" width="20%" align="center">Other</td>
                  <td width="24%" align="center" style="border-bottom:0px;">D.V.for</td>
                  <td width="24%" align="center" style="border-bottom:0px;">D.V.for</td>
                </tr>
                <tr>
                  <td width="24%" align="center" style="border-top:0px;">Carriage</td>
                  <td width="24%" align="center" style="border-top:0px;">Custom</td>
                </tr>
                <tr>
                  <td height="25">{!! Form::text('curr',($hawb->curr!="")?$hawb->curr:$curr,['size'=>'4']) !!}</td>
                  <td width="10%" align="center">{{ $wtp }}</td>
                  <td width="10%" align="center">{{ $wtc }}</td>
                  <td width="10%" align="center">{{ $otp }}</td>
                  <td width="10%" align="center">{{ $otc }}</td>
                  <td>{!! Form::text('nvd',($hawb->nvd!="")?$hawb->nvd:$nvd,['size'=>'4']) !!}</td>
                  <td>{!! Form::text('ncv',($hawb->ncv!="")?$hawb->ncv:$ncv,['size'=>'4']) !!}</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table width="100%">
                <tr>
                  <td>Airport of Destination</td>
                </tr>
                <tr>
                  <td height="20">{!! Form::text('desti',isset($hawb->desti)?$hawb->desti:null,['size'=>'16']) !!}</td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td>Flight/Date</td>
                </tr>
                <tr>
                  <td height="20">{!! Form::text('fltno',isset($hawb->fltno)?$hawb->fltno:null,['size'=>'6']) !!}&nbsp;
                  /&nbsp;{!! Form::text('fltdate',isset($hawb->fltdate)?$hawb->fltdate:null,['size'=>'10']) !!}</td>
                </tr>
              </table>
            </td>
            <td colspan="2">
              Amount of Insurance
            </td>
          </tr>
          <tr>
              <td colspan="4">Handling Information<br>
                {!! Form::textarea('special',isset($hawb->special)?$hawb->special:null,['rows'=>2,'cols'=>100]) !!}
              </td>
          </tr>
          <tr>
            <td colspan="4" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td width="6%" height="30">No.</td>
                  <td width="9%">G.W.</td>
                  <td width="5%">KG<br>lb</td>
                  <td width="13%" colspan="2">Rate Class</td>
                  <td width="12%">C.W.</td>
                  <td width="8%">Rate/Charge</td>
                  <td width="47%" colspan="2">Nature and Quantity of Goods</td>
                </tr>
                <tr>
                  <td height="25" style="border-bottom:0px;">{!! Form::text('package',isset($hawb->package)?$hawb->package:null,['size'=>'3']) !!}</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td width="3%" style="border-bottom:0px;">&nbsp;</td>
                  <td width="10%" style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td align="center" valign="top" colspan="2" rowspan="3">{!! Form::textarea('cgodescp',isset($hawb->cgodescp)?$hawb->cgodescp:null,['rows'=>12,'cols'=>50]) !!}<br />{!! Form::text('cbm',isset($hawb->cbm)?round($hawb->cbm,3):null,['size'=>'6']) !!}&nbsp;CBM</td>
                </tr>
                <tr>
                  <td height="150" valign="top" style="border-top:0px;">{!! Form::text('num',isset($hawb->num)?$hawb->num:null,['size'=>'3']) !!}</td>
                  <td valign="top" style="border-top:0px;">{!! Form::text('gw',isset($hawb->gw)?$hawb->gw:null,['size'=>'5']) !!}</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">K.</td>
                  <td width="3%" valign="top" style="border-top:0px;border-bottom:0px;">{!! Form::text('rclass',isset($hawb->rclass)?$hawb->rclass:null,['size'=>'1']) !!}</td>
                  <td width="10%" valign="top" style="border-top:0px;border-bottom:0px;">&nbsp;</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;">{!! Form::text('cw',isset($hawb->cw)?$hawb->cw:null,['size'=>'5','readonly'=>'readonly']) !!}</td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;"></td>
                </tr>
                <tr>
                  <td height="20">&nbsp;</td>
                  <td>&nbsp;</td>
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
              <td colspan="4" style="padding:0px">
                <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                    <colgroup>
                      <col width="10%">
                      <col width="10%">
                      <col width="10%">
                      <col width="10%">
                      <col width="60%">
                    </colgroup>
                    <tbody><tr>
                      <td width="10%" height="15" align="center">Prepaid</td>
                      <td colspan="2" width="20%" align="center">Weight Charge</td>
                      <td width="10%" align="center">Collect</td>
                      <td width="60%" rowspan="6" valign="top">
                        Other Charges<br>&nbsp;
                      </td>
                    </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15">&nbsp;</td>
                      <td colspan="2">Valuation Charge</td>
                      <td>&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15">&nbsp;</td>
                      <td colspan="2">Tax</td>
                      <td>&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="15" align="center">&nbsp;</td>
                      <td colspan="2" align="center">TotalOtherChargeDueAgent</td>
                      <td align="center">&nbsp;</td>
                      <td rowspan="5" align="center">Shipper certifies that the particulars on the face hereof are correct and that insofar as any part of the consignmencontains dangerous goods,such part is properly described by name and is in proper condition for carriage by air according to the applicable DangerouGoods Regulations.<br><br>
                      {!! Form::text('agentabbr',($hawb->agentabbr!="")?$hawb->agentabbr:$agentabbr,['size'=>'12']) !!}<br><br>
                      Signature of shipper or his Agent
                      </td>
                    </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15">&nbsp;</td>
                      <td colspan="2">TotalOtherChargeDueCarrier</td>
                      <td>&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="4">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="15" colspan="2" align="center">Total Prepaid</td>
                      <td colspan="2" align="center">Total Collect</td>
                      <td rowspan="4" align="center">
                        <table width="70%">
                          <tr>
                            <td width="30%">{!! Form::text('opdate',isset($hawb->opdate)?$hawb->opdate:null,['size'=>'12']) !!}</td>
                            <td width="30%">{!! ($hawb->depar!="")?$hawb->depar:$depar !!}</td>
                            <td></td>
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
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="2">Currency Rate</td>
                      <td colspan="2">CC charges in Dest.</td>
                      </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="15" colspan="2" align="center">Charges at Dest</td>
                      <td colspan="2" align="center">Total Collect Charges</td>
                      <td rowspan="2" align="right" style="font-size:20px;">HAWB YH - <span style="color:#000000;font-size:20px;">{!! $hawb->hawb !!}</span>&nbsp;</td>
                    </tr>
                    <tr align="center">
                      <td height="15" colspan="2">&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                  </tbody>
                </table>
              </td>
          </tr>
        </table>
        <div class="text-center" style="width:880px;padding:10px 0px;">
          {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}
          <a href="{{ route('print_hawb',['hawb'=>$hawb->hawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

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

    //输入发货人代码自动显示补全地址
    $("input[name='shippercode']").blur(function(){
      var shippercode = $("input[name='shippercode']").val();
      if(shippercode!=''){
        $.get('{{url('get/hshipper')}}/'+shippercode,function(json){
          if(json.addr==null)json.addr=='';
          $("textarea[name='shipper']").val(json.addr);
        });
      }
    });

    //输入收货人代码自动显示补全地址
    $("input[name='consigneecode']").blur(function(){
      var consigneecode = $("input[name='consigneecode']").val();
      if(consigneecode!=''){
        $.get('{{url('get/hconsignee')}}/'+consigneecode,function(json){
          if(json.addr==null)json.addr=='';
          $("textarea[name='consignee']").val(json.addr);
        });
      }
    });

    //输入通知人代码自动显示补全地址
    $("input[name='notifycode']").blur(function(){
      var notifycode = $("input[name='notifycode']").val();
      if(notifycode!=''){
        $.get('{{url('get/hnotify')}}/'+notifycode,function(json){
          if(json.addr==null)json.addr=='';
          $("textarea[name='notify']").val(json.addr);
        });
      }
    });
  </script>
@stop