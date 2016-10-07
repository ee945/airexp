<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;

class PrintController extends Controller
{
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
        // 付费方式
        if($hawb->paymt=="CP"){
          $data['paymtli']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;P";
          $data['farrange']="FREIGHT COLLECT";
        }elseif($hawb->paymt=="CC"){
          $data['paymtli']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C";
          $data['farrange']="FREIGHT COLLECT";
        }else{
          $data['paymtli']="&nbsp;P&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P";
          $data['farrange']="FREIGHT PREPAID";
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
		$data['depar_x']= (15+$hleft)*$showrate;
		$data['desti_x']= (15+$hleft)*$showrate;
		$data['mawb_x']= (25+$hleft)*$showrate;
		$data['hawb_x']= (170+$hleft)*$showrate;
		$data['hawbfoot_x']= (170+$hleft)*$showrate;
		$data['dest_x']= (10+$hleft)*$showrate;
		$data['carrier_x']= (20+$hleft)*$showrate;
		$data['flt_x']= (58+$hleft)*$showrate;
		$data['consignee_x']= (15+$hleft)*$showrate;
		$data['notify_x']= (15+$hleft)*$showrate;
		$data['shipper_x']= (15+$hleft)*$showrate;
		$data['prtdate_x']= (98+$hleft)*$showrate;
		$data['sha_x']= (135+$hleft)*$showrate;
		$data['agent_x']= (135+$hleft)*$showrate;
		$data['curr_x']= (110+$hleft)*$showrate;
		$data['paymt_x']= (124+$hleft)*$showrate;
		$data['nvd_x']= (150+$hleft)*$showrate;
		$data['case_x']= (10+$hleft)*$showrate;
		$data['num_x']= (10+$hleft)*$showrate;
		$data['gw_x']= (20+$hleft)*$showrate;
		$data['kg_x']= (36+$hleft)*$showrate;
		$data['rclass_x']= (44+$hleft)*$showrate;
		$data['cw_x']= (72+$hleft)*$showrate;
		$data['special_x']= (20+$hleft)*$showrate;
		$data['cgoname_x']= (113+$hleft)*$showrate;
		$data['cgodescp_x']= (113+$hleft)*$showrate;
		$data['cbm_x']= (185+$hleft)*$showrate;
		$data['farrange_x']= (120+$hleft)*$showrate;
		if($hawb->paymt=="PP" or $hawb->paymt=="PC"){
			$data['asarrangeda_x']= (15+$hleft)*$showrate;
			$data['asarrangedb_x']= (15+$hleft)*$showrate;
		}
		if($hawb->paymt=="CP" or $hawb->paymt=="CC"){
			$data['asarrangeda_x']= (46+$hleft)*$showrate;
			$data['asarrangedb_x']= (46+$hleft)*$showrate;
		}
		$data['asarrangedc_x']= (100+$hleft)*$showrate;
		//以下为每个数据单独指定上边距，括号中第一个数字为真实分单上测量出的距离（减去整体上边距），单位毫米，可自行测量调整
		$data['depar_y']= (100+$htop)*$showrate;
		$data['desti_y']= (117+$htop)*$showrate;
		$data['mawb_y']= (8+$htop)*$showrate;
		$data['hawb_y']= (8+$htop)*$showrate;
		$data['hawbfoot_y']= (275+$htop)*$showrate;
		$data['dest_y']= (108+$htop)*$showrate;
		$data['carrier_y']= (108+$htop)*$showrate;
		$data['flt_y']= (117+$htop)*$showrate;
		$data['consignee_y']= (50+$htop)*$showrate;
		$data['notify_y']= (74+$htop)*$showrate;
		$data['shipper_y']= (19+$htop)*$showrate;
		$data['prtdate_y']= (260+$htop)*$showrate;
		$data['sha_y']= (260+$htop)*$showrate;
		$data['agent_y']= (245+$htop)*$showrate;
		$data['curr_y']= (108+$htop)*$showrate;
		$data['paymt_y']= (108+$htop)*$showrate;
		$data['nvd_y']= (108+$htop)*$showrate;
		$data['case_y']= (150+$htop)*$showrate;
		$data['num_y']= (155+$htop)*$showrate;
		$data['gw_y']= (155+$htop)*$showrate;
		$data['kg_y']= (155+$htop)*$showrate;
		$data['rclass_y']= (155+$htop)*$showrate;
		$data['cw_y']= (155+$htop)*$showrate;
		$data['special_y']= (130+$htop)*$showrate;
		$data['cgoname_y']= (147+$htop)*$showrate;
		$data['cgodescp_y']= (152+$htop)*$showrate;
		$data['cbm_y']= (201+$htop)*$showrate;
		$data['farrange_y']= (80+$htop)*$showrate;
		$data['asarrangeda_y']= (216+$htop)*$showrate;
		$data['asarrangedb_y']= (258+$htop)*$showrate;
		$data['asarrangedc_y']= (216+$htop)*$showrate;
        /* 打印位置部分 -- 结束 */

        return view(theme("print.hawb"), compact('hawb','title'))->with($data);
    }
}
