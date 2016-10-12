<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>总单打印</title>
<style type="text/css">
div {
margin:0;font-family:Arial, 黑体, "MS UI Gothic",sans-serif, Helvetica;font-size:12px;
}
#mawb {
position:absolute;left:{{ $mawb_x }}px;top:{{ $mawb_y }}px;font-size:14px;font-weight:bold;}
#mawb_topleft {
position:absolute;left:{{ $mawb_topleft_x }}px;top:{{ $mawb_topleft_y }}px;font-size:14px;font-weight:bold;}
#mawb_topright {
position:absolute;left:{{ $mawb_topright_x }}px;top:{{ $mawb_topright_y }}px;font-size:14px;font-weight:bold;}
#mawb_bottom {
position:absolute;left:{{ $mawb_bottom_x }}px;top:{{ $mawb_bottom_y }}px;font-size:14px;font-weight:bold;}
#dest {
position:absolute;left:{{ $dest_x }}px;top:{{ $dest_y }}px;}
#desti {
position:absolute;left:{{ $desti_x }}px;top:{{ $desti_y }}px;}
#depa {
position:absolute;left:{{ $depa_x }}px;top:{{ $depa_y }}px;}
#depar {
position:absolute;left:{{ $depar_x }}px;top:{{ $depar_y }}px;}
#shipper {
position:absolute;left:{{ $shipper_x }}px;top:{{ $shipper_y }}px;}
#consignee {
position:absolute;left:{{ $consignee_x }}px;top:{{ $consignee_y }}px;}
#pay {
position:absolute;left:{{ $pay_x }}px;top:{{ $pay_y }}px;}
#agentabbr {
position:absolute;left:{{ $agentabbr_x }}px;top:{{ $agentabbr_y }}px;}
#agentcode {
position:absolute;left:{{ $agentcode_x }}px;top:{{ $agentcode_y }}px;}
#agentaccount {
position:absolute;left:{{ $agentaccount_x }}px;top:{{ $agentaccount_y }}px;}
#carrier {
position:absolute;left:{{ $carrier_x }}px;top:{{ $carrier_y }}px;}
#curr {
position:absolute;left:{{ $curr_x }}px;top:{{ $curr_y }}px;}
#wpp {
position:absolute;left:{{ $wpp_x }}px;top:{{ $wpp_y }}px;}
#opp {
position:absolute;left:{{ $opp_x }}px;top:{{ $opp_y }}px;}
#nvd {
position:absolute;left:{{ $nvd_x }}px;top:{{ $nvd_y }}px;}
#flt {
position:absolute;left:{{ $flt_x }}px;top:{{ $flt_y }}px;}
#special {
position:absolute;left:{{ $special_x }}px;top:{{ $special_y }}px;}
#package {
position:absolute;left:{{ $package_x }}px;top:{{ $package_y }}px;}
#num {
position:absolute;left:{{ $num_x }}px;top:{{ $num_y }}px;}
#numb {
position:absolute;left:{{ $numb_x }}px;top:{{ $numb_y }}px;}
#gw {
position:absolute;left:{{ $gw_x }}px;top:{{ $gw_y }}px;}
#gwb {
position:absolute;left:{{ $gwb_x }}px;top:{{ $gwb_y }}px;}
#kg {
position:absolute;left:{{ $kg_x }}px;top:{{ $kg_y }}px;}
#rclass {
position:absolute;left:{{ $rclass_x }}px;top:{{ $rclass_y }}px;}
#cw {
position:absolute;left:{{ $cw_x }}px;top:{{ $cw_y }}px;}
#up {
position:absolute;left:{{ $up_x }}px;top:{{ $up_y }}px;}
#freight {
position:absolute;left:{{ $freight_x }}px;top:{{ $freight_y }}px;}
#freightb {
position:absolute;left:{{ $freightb_x }}px;top:{{ $freightb_y }}px;}
#aw {
position:absolute;left:{{ $aw_x }}px;top:{{ $aw_y }}px;}
#my {
position:absolute;left:{{ $my_x }}px;top:{{ $my_y }}px;}
#sc {
position:absolute;left:{{ $sc_x }}px;top:{{ $sc_y }}px;}
#other {
position:absolute;left:{{ $other_x }}px;top:{{ $other_y }}px;}
#amount {
position:absolute;left:{{ $amount_x }}px;top:{{ $amount_y }}px;}
#cgodescp {
position:absolute;left:{{ $cgodescp_x }}px;top:{{ $cgodescp_y }}px;}
#cbm {
position:absolute;left:{{ $cbm_x }}px;top:{{ $cbm_y }}px;}
#signature {
position:absolute;left:{{ $signature_x }}px;top:{{ $signature_y }}px;}
#atplace {
position:absolute;left:{{ $atplace_x }}px;top:{{ $atplace_y }}px;}
#operator {
position:absolute;left:{{ $operator_x }}px;top:{{ $operator_y }}px;}
#opdate {
position:absolute;left:{{ $opdate_x }}px;top:{{ $opdate_y }}px;}
</style>
</head>
<body>
<div id="mawb">{{ $mawb->mawb }}</div>
<div id="mawb_topleft">{{ $mawb_topleft }}</div>
<div id="mawb_topright">{{ $mawb_topright }}</div>
<div id="mawb_bottom">{{ $mawb->mawb }}</div>

<div id="dest">{{ $mawb->dest }}</div>
<div id="depa">{{ $mawb->depa }}</div>
<div id="desti">{{ $mawb->desti }}</div>
<div id="depar">{{ $mawb->depar }}</div>
<div id="atplace">{{ $mawb->atplace }}</div>
<pre><div id="shipper">{{ $mawb->shipper }}</div></pre>
<pre><div id="consignee">{{ $mawb->consignee }}</div></pre>
<div id="pay">{{ $pay }}</div>
<div id="agentabbr">{{ $mawb->agentabbr }}</div>
<div id="signature">{{ $mawb->signature }}</div>
<div id="agentcode">{{ $mawb->agentcode }}</div>
<div id="agentaccount">{{ $mawb->agentaccount }}</div>
<div id="carrier">{{ $mawb->carrier }}</div>
<div id="curr">{{ $curr }}</div>
<div id="wpp">P</div>
<div id="opp">P</div>
<div id="nvd">{{ $nvd }}</div>
<div id="flt">{{ $flt }}</div>
<div id="special">{{ $mawb->special }}</div>
<div id="package">{{ $mawb->package }}</div>
<div id="num">{{ $mawb->num }}</div>
<div id="numb">{{ $mawb->num }}</div>
<div id="gw">{{ $mawb->gw }}</div>
<div id="gwb">{{ $mawb->gw }}</div>
<div id="kg">{{ $kg }}</div>
<div id="rclass">{{ $mawb->rclass }}</div>
<div id="cw">{{ $mawb->cw }}</div>
<div id="up">{{ $mawb->up }}</div>
<div id="freight">{{ $mawb->freight }}</div>
<div id="freightb">{{ $mawb->freight }}</div>
<div id="aw">{{ $aw }}</div>
<div id="my">{{ $my }}</div>
<div id="sc">{{ $sc }}</div>
<div id="other">{{ $mawb->other }}</div>
<div id="amount">{{ $mawb->amount }}</div>
<pre><div id="cgodescp">{{ $mawb->cgodescp }}</div></pre>
<div id="cbm">{{ $cbm }}</div>
<div id="operator">{{ $mawb->operator }}</div>
<div id="opdate">{{ $opdate }}</div>
</body>
</html>