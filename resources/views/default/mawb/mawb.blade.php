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
        <div class="alert alert-success text-center" style="padding:8px 0px;margin-bottom:15px" role="alert">
          <strong>保存成功！</strong>
          <a href="{{ route('print_mawb',['mawb'=>$mawb->mawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger text-left" style="padding-bottom: 5px;margin-bottom:15px" role="alert">
          <div style="width:880px;margin-left:auto;margin-right:auto;">
            <ul>
              @foreach ($errors->all() as $error)
              <li><strong>{{ $error }}</strong></li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
        <table class="mawbtab" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
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
            <td colspan="3" rowspan="2"><span style="color:#000000;float:left;">AIR WAYBILL</span>
            <input type="text" name="mawb" value="{$mawb}" hidden="hidden">
            <input type="text" name="depa" value="{$depa}" hidden="hidden">
            <span style="color:#000000;float:right;font-size:36px;"><a href="manifest.php?manimawb={$mawb}">{$mawb}</a></span></td>
            </tr>
            <tr>
              <td height="90" colspan="2" style="border-top: 0px;"><textarea name="shipper" cols="45" rows="5" style="text-transform:uppercase;">{$shipper}</textarea></td>
            </tr>
            <tr>
              <td height="20" style="border-bottom: 0px;">Consignee's Name and Address*</td>
              <td><input id="oversea" type="text" name="oversea" size="3" value="{$oversea}" style="text-transform:uppercase;"></td>
              <td colspan="3" rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="90" colspan="2" style="border-top: 0px;"><textarea id="consignee" name="consignee" cols="45" rows="5" style="text-transform:uppercase;">{$consignee}</textarea></td>
            </tr>
            <tr>
              <td height="45" colspan="2">Issuing Carrier's Agent Name and City<br />
              <input id="agentabbr" type="text" name="agentabbr" value="{$agentabbr}" style="text-transform:uppercase;"/></td>
              <td colspan="3" rowspan="3">Accounting Information
                <br />
                FREIGHT PREPAID
              </td>
            </tr>
            <tr>
              <td height="40">Agent's IATA Code<br />
              <input type="text" name="agentcode" value="{$agentcode}" style="text-transform:uppercase;"/></td>
              <td>Account NO.<br />
              <input type="text" name="agentaccount" value="{$agentaccount}" style="text-transform:uppercase;"/></td>
            </tr>
            <tr>
              <td height="40" colspan="2">Airport of Departure(addr. OF First Carrier) and Requested Routing
                <br />
                <input id="depar" type="text" name="depar" value="{$depar}" style="text-transform:uppercase;"/>    </td>
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
                  <td height="25"><input id="dest" type="text" name="dest" size=3 value="{$dest}" style="text-transform:uppercase;"></td>
                  <td><input type="text" name="carrier" size=3 value="{$carrier}" style="text-transform:uppercase;"></td>
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
                  <td colspan="2" width="15%" align="center">WT/VAL</td>
                  <td colspan="2" width="15%" align="center">Other</td>
                  <td width="26%">D.V.for Carriage</td>
                  <td>D.V.for Custom</td>
                </tr>
                <tr>
                  <td height="25">CNY</td>
                  <td>&nbsp;</td>
                  <td>PP</td>
                  <td>&nbsp;</td>
                  <td>PP</td>
                  <td>&nbsp;</td>
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
                  <td height="25"><input type="text" name="desti" size=6 value="{$desti}" style="text-transform:uppercase;"></td>
                  <td colspan="2" style="border-top:0px;"><input type="text" name="fltno" size=4 value="{$fltno}" style="text-transform:uppercase;">/<input id="fltdate" type="text" name="fltdate" size=6 value="{$fltdate}" onchange="javascript:if(!/^(19|20)\d{2}(0[1-9]|1[012])$/gi.test(this.value))alert('日期错误');"></td>
                  <td colspan="2" style="border-top:0px;">&nbsp;</td>
                </tr>
              </table>
              </td>
              <td colspan="3">Amount of Insurance</td>
            </tr>
            <tr>
              <td height="50" colspan="5">Handling Information<br />
              <input type="text" name="special" size=20 value="{$special}" style="text-transform:uppercase;"/></td>
            </tr>
            <tr>
              <td colspan="5" style="padding:0">
              <table width="100%" frame="void" rules="all" border="1" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td width="5%" height="30">No of Pieces</td>
                  <td width="15%">Gross Weight</td>
                  <td width="5%">KG<br>
                    lb</td>
                  <td width="5%">Rate Class</td>
                  <td width="15%">Chargeable Weight</td>
                  <td width="10%">Rate/Charge</td>
                  <td width="15%">Total</td>
                  <td width="30%">Nature and Quantity of Goods</td>
                </tr>
                <tr>
                  <td height="25" style="border-bottom:0px;"><input type="text" name="package" size=3 value="{$package}" style="text-transform:uppercase;"></td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td style="border-bottom:0px;">&nbsp;</td>
                  <td rowspan="3" align="center" valign="top">
                  <textarea id="cgodescp" name="cgodescp" cols="40" rows="12">{$cgodescp}</textarea><br />
                  <input id="cbm" type="text" name="cbm" size=5 value="{$cbm}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')">
                  <input id="getcbm" type="button" name="getcbm" value="CBM">
                  <input id="getres" type="button" name="getres" value="RES">
                  </td>
                </tr>
                <tr>
                  <td height="150" valign="top" style="border-top:0px;"><input id="num" type="text" name="num" size=3 value="{$num}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                  <td valign="top" style="border-top:0px;"><input id="gw" type="text" name="gw" size=5 value="{$gw}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;"><input type="text" name="k" size=1 value="K." style="text-transform:uppercase;"></td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;"><input id="rclass" type="text" name="rclass" size=1 value="{$rclass}" style="text-transform:uppercase;"></td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;"><input id="cw" type="text" name="cw" size=5 value="{$cw}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                  <td valign="top" style="border-top:0px;border-bottom:0px;"><input id="up" type="text" name="up" size=3 value="{$up}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                  <td valign="top" style="border-top:0px;"><input id="freight" type="text" name="freight" size=8 value="{$freight}" readonly=readonly></td>
                </tr>
                <tr>
                  <td height="25"><input id="num2" type="text" name="num2" size=3 value="{$num}" readonly=readonly></td>
                  <td><input id="gw2" type="text" name="gw2" size=5 value="{$gw}" readonly=readonly></td>
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
                  <table width="80%" border="0">
                    <tr align="center">
                      <td width="20%"><input id="awn" type="text" name="awn" size=5 value="{$awn}" style="text-transform:uppercase;"></td>
                      <td width="30%">&nbsp;</td>
                      <td width="40%"><input id="aw" type="text" name="aw" size=5 value="{$aw}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                    </tr>
                    <tr align="center">
                      <td><input id="myn" type="text" name="myn" size=5 value="{$myn}" style="text-transform:uppercase;"></td>
                      <td><input id="myup" type="text" name="myup" size=3 value="{$myup}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                      <td><input id="my" type="text" name="my" size=5 value="{$my}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                    </tr>
                    <tr align="center">
                      <td><input id="scn" type="text" name="scn" size=5 value="{$scn}" style="text-transform:uppercase;"></td>
                      <td><input id="scup" type="text" name="scup" size=3 value="{$scup}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                      <td><input id="sc" type="text" name="sc" size=5 value="{$sc}" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')"></td>
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2"><input id="freight2" type="text" name="freight2" size=8 value="{$freight}" readonly=readonly></td>
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
                  <input id="signature" type="text" name="signature" value="{$signature}" style="text-transform:uppercase;"><br /><br />
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
                  <td height="25" colspan="2"><input id="other" type="text" name="other" size=8 value="{$other}" readonly=readonly></td>
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
                      <td width="30%"><input type="text" name="opdate" size=8 value="{$opdate}" onchange="javascript:if(!/^(19|20)\d{2}(0[1-9]|1[012])$/gi.test(this.value))alert('日期错误');"></td>
                      <td width="30%"><input id="atplace" type="text" name="atplace" size=8 value="{$atplace}" style="text-transform:uppercase;"></td>
                      <td><input type="text" name="operator" size=8  value="{$operator}" style="text-transform:uppercase;"></td>
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
                  <td height="25" colspan="2"><input id="amount" type="text" name="amount" size=8 value="{$amount}" readonly=readonly></td>
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
                  <td rowspan="2" align="right" style="font-size:36px;">{$mawb}</td>
                </tr>
                <tr align="center">
                  <td height="25" colspan="2">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  </tr>
              </table>
              </td>
            </tr>
          </table>
        <div style="position:relative;left:50%;top:0px;margin-top: 10px;margin-left: -90px;">
          {!! Form::submit('保存',['class'=>'btn btn-primary form-control','style'=>'width:80px;']) !!}
          <a href="{{ route('print_mawb',['mawb'=>$mawb->mawb])}}" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <script src="/js/jquery.min.js"></script>
@stop