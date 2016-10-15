@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        <div style="width:960px;">
        <p style="margin-left:35%;margin-right:65%;margin-bottom:15px;width:500px;font-weight:bold;font-size:26px;">HOUSE CARGO MANIFEST</p>
        </div>
        <style>
          .mani {width:960px;font-size:12px;}
          .mani tr td{font-family:宋体;padding:3px 5px;}
        </style>
        <table class="mani" border="1">
          <tr>
            <td width="25%" align="center">Air Freight Agent</td>
            <td width="15%" align="center">Master AWB No.</td>
            <td width="15%" align="center">Port of Discharge</td>
            <td width="15%" align="center">Total No.of Shipment</td>
            <td width="15%" align="center">Flight No.</td>
            <td width="15%" align="center">Date</td>
          </tr>
          <tr>
            <td></td>
            <td>{{ $hawb_first->mawb }}</span></td>
            <td>{{ $hawb_first->dest }}</span></td>
            <td>{{ $hawb_count }}</span></td>
            <td>{{ $hawb_first->fltno }}</td>
            <td>{{ $hawb_first->fltdate }}</td>
          </tr>
        </table>
        <br />
        <table class="mani" border="1">
          <tr>
            <td width="96px"> Hawb No.</td>
            <td width="48px"> No. of Pkg</td>
            <td width="50px"> WT. in Kilo(Lb)</td>
            <td width="187px"> Nature of Goods</td>
            <td width="60px"> Port of Lading</td>
            <td width="60px"> Final Dest</td>
            <td width="177px">Name &amp; Address of Shipper</td>
            <td width="177px">Name &amp; Address of Consignee</td>
            <td width="106px">For Offical Use Only</td>
          </tr>
          @foreach($hawbs as $hawb)
          <tr>
            <td>{{ "YH-".$hawb->hawb }}</td>
            <td>{{ $hawb->num }}</td>
            <td>{{ $hawb->gw }}</td>
            <td>{{ substr($hawb->cgodescp,0,stripos($hawb->cgodescp, "\n")) }}</td>
            <td>SHA</td>
            <td>{{ $hawb->dest }}</td>
            <td>{{ str_replace('\n',"\n",$hawb->shipper) }}</td>
            <td>{{ str_replace('\n',"\n",$hawb->consignee) }}</td>
            <td></td>
          </tr>
          @endforeach
          <tr>
            <td>TOTAL:</td>
            <td>{{$amount_num}}</td>
            <td>{{$amount_gw}}</td>
            <td colspan=6></td>
          </tr>
        </table>
        <div class="text-center" style="width:880px;padding:10px 0px;">
          <a href="{{ route('manifest_export',['mawb'=>$hawb_first->mawb])}}" target="_blank" type="button" class="btn btn-primary" style="width:80px;margin-left: 20px;">导出</a>
          <a href="javascript:alert('ok');" target="_blank" type="button" class="btn btn-success" style="width:80px;margin-left: 20px;">打印</a>
        </div>
      </div>
    </div>
  </div>
@stop