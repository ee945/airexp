<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分单打印</title>
<style type="text/css">
div {
margin:0;font-family:Arial, 黑体, "MS UI Gothic",sans-serif, Helvetica;font-size:12px;
}
#depar {
position:absolute;left:{{ $depar_x }}px;top:{{ $depar_y }}px;}
#desti {
position:absolute;left:{{ $desti_x }}px;top:{{ $desti_y }}px;}
#mawb {
position:absolute;left:{{ $mawb_x }}px;top:{{ $mawb_y }}px;font-size:14px;}
#hawb {
position:absolute;left:{{ $hawb_x }}px;top:{{ $hawb_y }}px;font-size:14px;}
#hawbfoot {
position:absolute;left:{{ $hawbfoot_x }}px;top:{{ $hawbfoot_y }}px;font-size:14px;}
#dest {
position:absolute;left:{{ $dest_x }}px;top:{{ $dest_y }}px;}
#carrier {
position:absolute;left:{{ $carrier_x }}px;top:{{ $carrier_y }}px;}
#flt {
position:absolute;left:{{ $flt_x }}px;top:{{ $flt_y }}px;}
#consignee {
position:absolute;left:{{ $consignee_x }}px;top:{{ $consignee_y }}px;}
#notify {
position:absolute;left:{{ $notify_x }}px;top:{{ $notify_y }}px;}
#shipper {
position:absolute;left:{{ $shipper_x }}px;top:{{ $shipper_y }}px;}
#prtdate {
position:absolute;left:{{ $prtdate_x }}px;top:{{ $prtdate_y }}px;}
#sha {
position:absolute;left:{{ $sha_x }}px;top:{{ $sha_y }}px;}
#agent {
position:absolute;left:{{ $agent_x }}px;top:{{ $agent_y }}px;}
#curr {
position:absolute;left:{{ $curr_x }}px;top:{{ $curr_y }}px;}
#paymt {
position:absolute;left:{{ $paymt_x }}px;top:{{ $paymt_y }}px;}
#nvd {
position:absolute;left:{{ $nvd_x }}px;top:{{ $nvd_y }}px;}
#case {
position:absolute;left:{{ $case_x }}px;top:{{ $case_y }}px;}
#num {
position:absolute;left:{{ $num_x }}px;top:{{ $num_y }}px;}
#gw {
position:absolute;left:{{ $gw_x }}px;top:{{ $gw_y }}px;}
#kg {
position:absolute;left:{{ $kg_x }}px;top:{{ $kg_y }}px;}
#rclass {
position:absolute;left:{{ $rclass_x }}px;top:{{ $rclass_y }}px;}
#cw {
position:absolute;left:{{ $cw_x }}px;top:{{ $cw_y }}px;}
#farrange {
position:absolute;left:{{ $farrange_x }}px;top:{{ $farrange_y }}px;}
#special {
position:absolute;left:{{ $special_x }}px;top:{{ $special_y }}px;}
#cgodescp {
position:absolute;left:{{ $cgodescp_x }}px;top:{{ $cgodescp_y }}px;}
#cbm {
position:absolute;left:{{ $cbm_x }}px;top:{{ $cbm_y }}px;}
#asarrangeda {
position:absolute;left:{{ $asarrangeda_x }}px;top:{{ $asarrangeda_y }}px;}
#asarrangedb {
position:absolute;left:{{ $asarrangedb_x }}px;top:{{ $asarrangedb_y }}px;}
#asarrangedc {
position:absolute;left:{{ $asarrangedc_x }}px;top:{{ $asarrangedc_y }}px;}
</style>
</head>
<body>
<div id="depar">{{ $hawb->depar }}</div>
<div id="desti">{{ $hawb->desti }}</div>
<div id="mawb">{{ $hawb->mawb }}</div>
<div id="hawb">{{ $hawb->hawb }}</div>
<div id="hawbfoot">{{ $hawb->hawb }}</div>
<div id="dest">{{ $hawb->dest }}</div>
<div id="carrier">{{ substr($hawb->fltno,0,2)}}</div>
<div id="flt">{{ $hawb->fltno }}&nbsp;/&nbsp;{{ strtoupper(date("d,M",strtotime($hawb->fltdate))) }}</div>
<pre><div id="consignee">{{ $hawb->consignee }}</div></pre>
<pre><div id="notify">{{ $hawb->notify }}</div></pre>
<pre><div id="shipper">{{ $hawb->shipper }}</div></pre>
<div id="prtdate">{{ date("M. d, Y",strtotime($hawb->opdate)) }}</div>
<div id="sha">{{ $hawb->depar }}</div>
<div id="agent">{{ $hawb->agentabbr }}</div>
<div id="curr">{{ $hawb->curr }}</div>
<pre><div id="paymt">{{ $paymtli }}</div></pre>
<div id="nvd">{{ $hawb->nvd }}</div>
<div id="case">{{ $hawb->package }}</div>
<div id="num">{{ $hawb->num }}</div>
<div id="gw">{{ $hawb->gw }}</div>
<div id="kg">K.</div>
<div id="rclass">{{ $hawb->rclass }}</div>
<div id="cw">{{ $hawb->cw }}</div>
<pre><div id="special">{{ $hawb->special }}</div></pre>
<div id="farrange">{{ $farrange }}</div>
<div id="asarrangeda">{{ $asarranged }}</div>
<div id="asarrangedb">{{ $asarranged }}</div>
<div id="asarrangedc">{{ $asarranged }}</div>
<pre><div id="cgodescp">{{ $hawb->cgodescp }}</div></pre>
<div id="cbm">{{ round($hawb->cbm,3) }}&nbsp;CBM</div>
</body>
</html>