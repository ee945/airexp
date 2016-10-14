@extends(theme('layout.layout'))

@section('container')
  <div class="container theme-showcase" role="main">
    <div class="row">
      <div class="col-md-12">
        <div style="width:960px;">
        <p style="margin-left:35%;margin-right:65%;margin-bottom:15px;width:500px;font-weight:bold;font-size:26px;">HOUSE CARGO MANIFEST</p>
        </div>
        <table border="1" cellpadding="0" cellspacing="0" style="width:960px;border-collapse:collapse;font-size:12px">
          <tr>
            <td width="25%" align="center" style="padding:3px 5px;">Air Freight Agent</td>
            <td width="15%" align="center" style="padding:3px 5px;">Master AWB No.</td>
            <td width="15%" align="center" style="padding:3px 5px;">Port of Discharge</td>
            <td width="15%" align="center" style="padding:3px 5px;">Total No.of Shipment</td>
            <td width="15%" align="center" style="padding:3px 5px;">Flight No.</td>
            <td width="15%" align="center" style="padding:3px 5px;">Date</td>
          </tr>
          <tr>
            <td style="padding:3px 5px;"></td>
            <td style="padding:3px 5px;">{{ $hawb_first->mawb }}</span></td>
            <td style="padding:3px 5px;">{{ $hawb_first->dest }}</span></td>
            <td style="padding:3px 5px;">{{ $hawb_count }}</span></td>
            <td style="padding:3px 5px;">{{ $hawb_first->fltno }}</td>
            <td style="padding:3px 5px;">{{ $hawb_first->fltdate }}</td>
          </tr>
        </table>
        <br />
        <table border="1" cellspacing="0" cellpadding="0" style="width:960px;border-collapse:collapse;font-size:12px">
          <tr>
            <td width="96px" style="padding:3px 5px;"> Hawb No.</td>
            <td width="48px" style="padding:3px 5px;"> No. of Pkg</td>
            <td width="50px" style="padding:3px 5px;"> WT. in Kilo(Lb)</td>
            <td width="187px" style="padding:3px 5px;"> Nature of Goods</td>
            <td width="60px" style="padding:3px 5px;"> Port of Lading</td>
            <td width="60px" style="padding:3px 5px;"> Final Dest</td>
            <td width="177px" style="padding:3px 5px;">Name &amp; Address of Shipper</td>
            <td width="177px" style="padding:3px 5px;">Name &amp; Address of Consignee</td>
            <td width="106px" style="padding:3px 5px;">For Offical Use Only</td>
          </tr>
          @foreach($hawbs as $hawb)
          <tr>
            <td style="padding:3px 5px;">{{ "YH-".$hawb->hawb }}</td>
            <td style="padding:3px 5px;">{{ $hawb->num }}</td>
            <td style="padding:3px 5px;">{{ $hawb->gw }}</td>
            <td style="padding:3px 5px;">{{ substr($hawb->cgodescp,0,stripos($hawb->cgodescp, "\n")) }}</td>
            <td style="padding:3px 5px;">SHA</td>
            <td style="padding:3px 5px;">{{ $hawb->dest }}</td>
            <td style="padding:3px 5px;">{{ str_replace('\n',"\n",$hawb->shipper) }}</td>
            <td style="padding:3px 5px;">{{ str_replace('\n',"\n",$hawb->consignee) }}</td>
            <td style="padding:3px 5px;"></td>
          </tr>
          @endforeach
          <tr>
            <td style="padding:3px 5px;">TOTAL:</td>
            <td style="padding:3px 5px;">{{$amount_num}}</td>
            <td style="padding:3px 5px;">{{$amount_gw}}</td>
            <td style="padding:3px 5px;" colspan=6></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
@stop