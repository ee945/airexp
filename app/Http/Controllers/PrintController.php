<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;
use App\Mawb;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function printHawb($hawb)
    {
    	## 分单打印
        $title = "打印分单";
        $data = [];
        $hawb = Hawb::where('hawb',$hawb)->first();

        // 找不到该分单则返回列表页
        if(empty($hawb))return redirect(route('hawb_list'));

        /* 特殊字段处理 -- 开始*/
        $data['carreier'] = substr($hawb->fltno,0,2);
        $data['flt'] = $hawb->fltno ." / ".strtoupper(date("d,M",strtotime($hawb->fltdate)));
        $data['prtdate'] = strtoupper(date("M. d, Y",strtotime($hawb->opdate)));
        $data['cbm'] = round($hawb->cbm,3)." CBM";
        // 付费方式
        if($hawb->paymt=="CP"){
          $data['paymtli']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;P";
          $data['pay']="FREIGHT COLLECT";
        }elseif($hawb->paymt=="CC"){
          $data['paymtli']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C";
          $data['pay']="FREIGHT COLLECT";
        }else{
          $data['paymtli']="&nbsp;P&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P";
          $data['pay']="FREIGHT PREPAID";
        }
        // 运费是否不显示
        if($hawb->arranged==0){
        	$data['asarranged']=" AS ARRANGED";
        }
        /* 特殊字段处理 -- 结束*/

        /* 打印位置部分 -- 开始 */
		//3个打印基本常数（已调整，基本不用改变）
		$showrate=3.65;  //显示比例
		$hleft=0;  //整体左边距
		$htop=4;   //整体上边距
		//以下为每个数据单独指定左边距，括号中第一个数字为真实分单上测量出的距离（减去整体左边距），单位毫米，可自行测量调整
        $data['mawb_x']= (25+$hleft)*$showrate;
        $data['hawb_x']= (170+$hleft)*$showrate;
        $data['hawbfoot_x']= (170+$hleft)*$showrate;
        $data['shipper_x']= (15+$hleft)*$showrate;
        $data['consignee_x']= (15+$hleft)*$showrate;
        $data['notify_x']= (15+$hleft)*$showrate;
        $data['pay_x']= (120+$hleft)*$showrate;
		$data['depar_x']= (15+$hleft)*$showrate;
        $data['dest_x']= (10+$hleft)*$showrate;
        $data['carrier_x']= (20+$hleft)*$showrate;
		$data['desti_x']= (15+$hleft)*$showrate;
		$data['flt_x']= (58+$hleft)*$showrate;
		$data['curr_x']= (110+$hleft)*$showrate;
		$data['paymt_x']= (124+$hleft)*$showrate;
		$data['nvd_x']= (150+$hleft)*$showrate;
        $data['special_x']= (20+$hleft)*$showrate;
		$data['case_x']= (10+$hleft)*$showrate;
		$data['num_x']= (10+$hleft)*$showrate;
		$data['gw_x']= (20+$hleft)*$showrate;
		$data['kg_x']= (36+$hleft)*$showrate;
		$data['rclass_x']= (44+$hleft)*$showrate;
		$data['cw_x']= (72+$hleft)*$showrate;
		$data['cgodescp_x']= (113+$hleft)*$showrate;
		$data['cbm_x']= (185+$hleft)*$showrate;
		if($hawb->paymt=="PP" or $hawb->paymt=="PC"){
			$data['asarrangeda_x']= (15+$hleft)*$showrate;
			$data['asarrangedb_x']= (15+$hleft)*$showrate;
		}
		if($hawb->paymt=="CP" or $hawb->paymt=="CC"){
			$data['asarrangeda_x']= (46+$hleft)*$showrate;
			$data['asarrangedb_x']= (46+$hleft)*$showrate;
		}
		$data['asarrangedc_x']= (100+$hleft)*$showrate;
        $data['prtdate_x']= (98+$hleft)*$showrate;
        $data['atplace_x']= (135+$hleft)*$showrate;
        $data['agent_x']= (135+$hleft)*$showrate;
		//以下为每个数据单独指定上边距，括号中第一个数字为真实分单上测量出的距离（减去整体上边距），单位毫米，可自行测量调整
        $data['mawb_y']= (8+$htop)*$showrate;
        $data['hawb_y']= (8+$htop)*$showrate;
        $data['hawbfoot_y']= (275+$htop)*$showrate;
        $data['shipper_y']= (19+$htop)*$showrate;
        $data['consignee_y']= (50+$htop)*$showrate;
        $data['notify_y']= (74+$htop)*$showrate;
        $data['pay_y']= (80+$htop)*$showrate;
		$data['depar_y']= (100+$htop)*$showrate;
		$data['dest_y']= (108+$htop)*$showrate;
		$data['carrier_y']= (108+$htop)*$showrate;
        $data['desti_y']= (117+$htop)*$showrate;
		$data['flt_y']= (117+$htop)*$showrate;
		$data['curr_y']= (108+$htop)*$showrate;
		$data['paymt_y']= (108+$htop)*$showrate;
		$data['nvd_y']= (108+$htop)*$showrate;
        $data['special_y']= (130+$htop)*$showrate;
		$data['case_y']= (150+$htop)*$showrate;
		$data['num_y']= (155+$htop)*$showrate;
		$data['gw_y']= (155+$htop)*$showrate;
		$data['kg_y']= (155+$htop)*$showrate;
		$data['rclass_y']= (155+$htop)*$showrate;
		$data['cw_y']= (155+$htop)*$showrate;
		$data['cgodescp_y']= (152+$htop)*$showrate;
		$data['cbm_y']= (201+$htop)*$showrate;
		$data['asarrangeda_y']= (216+$htop)*$showrate;
		$data['asarrangedb_y']= (258+$htop)*$showrate;
		$data['asarrangedc_y']= (216+$htop)*$showrate;
        $data['prtdate_y']= (260+$htop)*$showrate;
        $data['atplace_y']= (260+$htop)*$showrate;
        $data['agent_y']= (245+$htop)*$showrate;
        /* 打印位置部分 -- 结束 */

        return view(theme("print.hawb"), compact('hawb','title'))->with($data);
    }

    public function printMawb($mawbno)
    {
    	## 总单打印
        $title = "打印总单";
        $data = [];
        $mawb = Mawb::where('mawb',$mawbno)->first();

        // 找不到该总单则返回列表页
        if(empty($mawb))return redirect(route('mawb_list'));

        /* 特殊字段处理 -- 开始*/
        $data['mawb_topleft'] = substr($mawb->mawb,0,3);
        $data['mawb_topright'] = substr($mawb->mawb,-8);
        $data['curr'] = "CNY";
        $data['nvd'] = "NVD.";
        $data['pay'] = "FREIGHT PREPAID";
        $data['kg'] = "K.";
        $data['cbm'] = round($mawb->cbm,3)."&nbsp;CBM";
        $data['flt'] = $mawb->fltno." / ".strtoupper(date("d,M",strtotime($mawb->fltdate)));
        $data['opdate'] = strtoupper(date("M. d, Y",strtotime($mawb->opdate)));
        $data['aw'] = $mawb->awn." : ".$mawb->aw;
        $data['my'] = $mawb->myn." : ".$mawb->my;
        $data['sc'] = $mawb->scn." : ".$mawb->sc;
        /* 特殊字段处理 -- 结束*/

        /* 打印位置部分 -- 开始*/
        //3个打印基本常数（已调整，基本不用改变）
        $showrate=3.6;  //显示比例
        $mleft=12;  //整体左边距
        $mtop=1;    //整体上边距
        //以下为每个数据单独指定左边距，括号中第一个数字为真实总单上测量出的距离（减去整体左边距），单位毫米，可自行测量调整
        $data['mawb_x']= (150+$mleft)*$showrate;
        $data['mawb_topleft_x']= (21+$mleft)*$showrate;
        $data['mawb_topright_x']= (41+$mleft)*$showrate;
        $data['mawb_bottom_x']= (150+$mleft)*$showrate;
        $data['dest_x']= (21+$mleft)*$showrate;
        $data['desti_x']= (23+$mleft)*$showrate;
        $data['depa_x']= (31+$mleft)*$showrate;
        $data['depar_x']= (50+$mleft)*$showrate;
        $data['shipper_x']= (25+$mleft)*$showrate;
        $data['consignee_x']= (25+$mleft)*$showrate;
        $data['agentabbr_x']= (25+$mleft)*$showrate;
        $data['agentcode_x']= (25+$mleft)*$showrate;
        $data['agentaccount_x']= (70+$mleft)*$showrate;
        $data['carrier_x']= (35+$mleft)*$showrate;
        $data['flt_x']= (65+$mleft)*$showrate;
        $data['special_x']= (30+$mleft)*$showrate;
        $data['package_x']= (21+$mleft)*$showrate;
        $data['num_x']= (22+$mleft)*$showrate;
        $data['numb_x']= (22+$mleft)*$showrate;
        $data['gw_x']= (32+$mleft)*$showrate;
        $data['gwb_x']= (32+$mleft)*$showrate;
        $data['cw_x']= (82+$mleft)*$showrate;
        $data['cbm_x']= (165+$mleft)*$showrate;
        $data['rclass_x']= (51+$mleft)*$showrate;
        $data['up_x']= (100+$mleft)*$showrate;
        $data['freight_x']= (125+$mleft)*$showrate;
        $data['freightb_x']= (30+$mleft)*$showrate;
        $data['aw_x']= (95+$mleft)*$showrate;
        $data['my_x']= (120+$mleft)*$showrate;
        $data['sc_x']= (155+$mleft)*$showrate;
        $data['other_x']= (30+$mleft)*$showrate;
        $data['amount_x']= (30+$mleft)*$showrate;
        $data['cgodescp_x']= (150+$mleft)*$showrate;
        $data['signature_x']= (130+$mleft)*$showrate;
        $data['atplace_x']= (135+$mleft)*$showrate;
        $data['operator_x']= (175+$mleft)*$showrate;
        $data['opdate_x']= (95+$mleft)*$showrate;
        $data['pay_x']= (130+$mleft)*$showrate;
        $data['kg_x']= (44+$mleft)*$showrate;
        $data['curr_x']= (111+$mleft)*$showrate;
        $data['wpp_x']= (125+$mleft)*$showrate;
        $data['opp_x']= (135+$mleft)*$showrate;
        $data['nvd_x']= (155+$mleft)*$showrate;
        $data['scs_x']= (130+$mleft)*$showrate;
        //以下为每个数据单独指定上边距，括号中第一个数字为真实总单上测量出的距离（减去整体上边距），单位毫米，可自行测量调整
        $data['mawb_y']= (11+$mtop)*$showrate;
        $data['mawb_topleft_y']= (11+$mtop)*$showrate;
        $data['mawb_topright_y']= (11+$mtop)*$showrate;
        $data['mawb_bottom_y']= (273+$mtop)*$showrate;
        $data['dest_y']= (105+$mtop)*$showrate;
        $data['desti_y']= (114+$mtop)*$showrate;
        $data['depa_y']= (12+$mtop)*$showrate;
        $data['depar_y']= (97+$mtop)*$showrate;
        $data['shipper_y']= (21+$mtop)*$showrate;
        $data['consignee_y']= (46+$mtop)*$showrate;
        $data['agentabbr_y']= (75+$mtop)*$showrate;
        $data['agentcode_y']= (88+$mtop)*$showrate;
        $data['agentaccount_y']= (88+$mtop)*$showrate;
        $data['carrier_y']= (105+$mtop)*$showrate;
        $data['flt_y']= (114+$mtop)*$showrate;
        $data['special_y']= (125+$mtop)*$showrate;
        $data['package_y']= (145+$mtop)*$showrate;
        $data['num_y']= (150+$mtop)*$showrate;
        $data['numb_y']= (195+$mtop)*$showrate;
        $data['gw_y']= (150+$mtop)*$showrate;
        $data['gwb_y']= (195+$mtop)*$showrate;
        $data['cw_y']= (150+$mtop)*$showrate;
        $data['cbm_y']= (195+$mtop)*$showrate;
        $data['rclass_y']= (150+$mtop)*$showrate;
        $data['up_y']= (150+$mtop)*$showrate;
        $data['freight_y']= (150+$mtop)*$showrate;
        $data['freightb_y']= (206+$mtop)*$showrate;
        $data['aw_y']= (210+$mtop)*$showrate;
        $data['my_y']= (210+$mtop)*$showrate;
        $data['sc_y']= (210+$mtop)*$showrate;
        $data['other_y']= (239+$mtop)*$showrate;
        $data['amount_y']= (255+$mtop)*$showrate;
        $data['cgodescp_y']= (150+$mtop)*$showrate;
        $data['signature_y']= (241+$mtop)*$showrate;
        $data['atplace_y']= (258+$mtop)*$showrate;
        $data['operator_y']= (258+$mtop)*$showrate;
        $data['opdate_y']= (258+$mtop)*$showrate;
        $data['pay_y']= (80+$mtop)*$showrate;
        $data['kg_y']= (150+$mtop)*$showrate;
        $data['curr_y']= (105+$mtop)*$showrate;
        $data['wpp_y']= (105+$mtop)*$showrate;
        $data['opp_y']= (105+$mtop)*$showrate;
        $data['nvd_y']= (105+$mtop)*$showrate;
        $data['scs_y']= (85+$mtop)*$showrate;
        /* 打印位置部分 -- 结束 */

        return view(theme("print.mawb"), compact('mawb','title'))->with($data);
    }
}
