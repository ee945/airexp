<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;
use Carbon\Carbon;

class TrackController extends Controller
{
    private $mawb3;
    private $mawb8;

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        # 货物追踪模块导航页
        $title = "货物追踪";
        $hawb_today = Hawb::orderBy('fltdate','desc')->orderBy('hawb','desc')->where('fltdate',Carbon::today())->get();
        $hawb_after1 = Hawb::orderBy('fltdate','desc')->orderBy('hawb','desc')->where('fltdate',Carbon::tomorrow())->get();
        $hawb_before1 = Hawb::orderBy('fltdate','desc')->orderBy('hawb','desc')->where('fltdate',Carbon::yesterday())->get();
        $hawb_before2 = Hawb::orderBy('fltdate','desc')->orderBy('hawb','desc')->where('fltdate',Carbon::yesterday()->subDay())->get();
        $data['today'] = Carbon::today()->format('m.d');
        $data['after1'] = Carbon::tomorrow()->format('m.d');
        $data['before1'] = Carbon::yesterday()->format('m.d');
        $data['before2'] = Carbon::yesterday()->subDay()->format('m.d');
        return view(theme("track.track"),compact('hawb_today','hawb_after1','hawb_before1','hawb_before2','title'))->with($data);
    }

    public function airline()
    {
        # 航空公司官网货运追踪网址列表
        echo "Airline cargo track url list is under construction...";
    }

    public function status($mawb)
    {
        # 本系统内查询货物状态
        echo "货物状态:".$mawb."<br>";
        echo "Cargo track status system is under construction...";
    }

    public function arrival($mawb)
    {
        # 查运抵及放行（调用货站查询系统-pactl，东航物流） // 699
        if($this->invalidMawb($mawb)){
            echo "<br>";
        }elseif(in_array($this->mawb3, ['020','043','065','071','160','176','232','235','406','695','738','999'])){
            $this->arrivalPactl();
        }elseif(in_array($this->mawb3, ['016','018','098','112','172','205','217','297','501','537','618','672','756','784','843','933','988'])){
            $this->arrivalCeAir();
        }else{
            echo "暂不支持查询 ".$this->mawb3." 运抵信息"."<br><br>";
        }
    }

    private function arrivalPactl()
    {
        $url = "http://www.pactl.com.cn/cn/WaybillTracking.aspx?bill_no_1=".$this->mawb3."&bill_no_2=".$this->mawb8."&typeId=E";
        Header("Location: $url");
    }

    private function arrivalCeAir()
    {
        $url = "http://www.eal-ceair.com/service/track.html";
        echo "<form style='display:none;' id='form1' name='form1' method='post' action='".$url."'>
              <input name='tabCode' type='text' value='cargo_trace' />
              <input name='awbNos' type='text' value='".$this->mawb3.$this->mawb8."'/>
              <input name='verCode' type='text' value='1111'/>
              </form>
              <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
    }

    public function flight($mawb)
    {
        # 航班信息查询（调用个航司货物状态查询系统）
        if($this->invalidMawb($mawb)){
            echo "<br>";
        }elseif(in_array($this->mawb3, ['999'])){
            $this->flightAirChina();
        }elseif(in_array($this->mawb3, ['112','784','172','217','205','756'])){
            $this->flightCeAir();
        }elseif(in_array($this->mawb3, ['160'])){
            $this->flightCathayCacific();
        }elseif(in_array($this->mawb3, ['232'])){
            $this->flightMaskargo();
        }elseif(in_array($this->mawb3, ['406'])){
            $this->flightUPS();
        }elseif(in_array($this->mawb3, ['235'])){
            $this->flightTK();
        }elseif(in_array($this->mawb3, ['016'])){
            $this->flightUnitedCargo();
        }elseif(in_array($this->mawb3, ['695'])){
            $this->flightEVACargo();
        }elseif(in_array($this->mawb3, ['988'])){
            $this->flightAsiana();
        }elseif(in_array($this->mawb3, ['501'])){
            $this->flightSilkwayWest();
        }else{
            echo "暂不支持直接查询 ".$this->mawb3." 运单"."<br><br>";
            echo "<a href=\"/track/airline\">航空公司官网货运追踪网址列表</a>";
        }
    }

    private function flightAirChina()
    {
        // 国航货运查询官网
        $query_data = array('orders10' => '999','orders0' => $this->mawb8,'section' => '0-0001-0003-0081');
        $query_data = http_build_query($query_data);
        $http_data = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n"."Content-length:".strlen($query_data)."\r\n",
                'content' => $query_data)
            );
            $http_context = stream_context_create($http_data);
            $search_res = file_get_contents("http://www.airchinacargo.com/en/search_order.php", false, $http_context);

        preg_match("/<table class=\"tableE\" id=\"tbtrackingmaintitle\">.*<\/table>/sU", $search_res, $mawbhead);
        preg_match("/<table id=\"tableCargo\" class=\"tableE\">.*<\/table>/sU", $search_res, $mawbtitle);
        preg_match_all("/<table class=\"tableE\" id=\"tbcargostatus\">.*<\/table>/sU", $search_res, $mawbstatus);

        echo "<link href=\"/css/track-flight.css\" rel=\"stylesheet\">";
        echo "<title>国航货运查询</title>";
        echo $mawbhead[0];
        echo $mawbtitle[0];
        echo $mawbstatus[0][0];
        echo $mawbstatus[0][1];
    }

    private function flightCeAir()
    {
        // 东航货运业务系统
        $query_data = array(
            '__VIEWSTATE' => '/wEPDwULLTEyODYxNTg3NzIPZBYCZg9kFgoCAg8PFgIeBFRleHQFBuafpeivomRkAgQPZBYCZg9kFgRmDw8WBh4JRm9yZUNvbG9yCk4fAAUS6YCJ5oup6Lef6Liq54q25oCBHgRfIVNCAgRkZAIBDxAPZBYCHgdvbmNsaWNrBSRDaGVja0JveExpc3RfQ2xpY2soJ3R4dFN0YXR1c0NvZGUnKTsQFQkM6LSn54mp5Lqk5o6lDOi0p+eJqeWHuua4rwzov5vmuK/liLDovr4M6LSn54mp6L2s5Ye6DOeQhui0p+WujOavlQ/kuI3mraPluLjnmbvorrAM6LSn54mp5o+Q5Y+WDOi0p+eJqeiuouiIsQzotKfnianmi4nkuIsVCQzotKfniankuqTmjqUM6LSn54mp5Ye65rivDOi/m+a4r+WIsOi+vgzotKfnianovazlh7oM55CG6LSn5a6M5q+VD+S4jeato+W4uOeZu+iusAzotKfnianmj5Dlj5YM6LSn54mp6K6i6IixDOi0p+eJqeaLieS4ixQrAwlnZ2dnZ2dnZ2dkZAIFDw8WAh8ABRLlrprliLbot5/ouKrpgq7ku7ZkZAIIDxAPFgIfAAUS5p+l55yL5rS+6YCB5L+h5oGvZGRkZAIKDxYCHwAFGzxkaXYgY2xhc3M9J2NvbnRyb2wnPjwvZGl2PmQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgsFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkMAUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQxBR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDIFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkMwUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQ0BR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDUFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkNgUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQ3BR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDgFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkOAUNY2hrUXVlcnlUYWxseQhK6a17wTpV7k/51aAYal7o6LLZ9xXjLZjd7tIvW2wz',
            '__EVENTVALIDATION' => '/wEWEwLp8+61BQK4kq2dCgLRxoa2CAL2ktWKCwKXnpSaAQKfwsyDBAL0ttfVDAL0ttPVDAL0tt/VDAL0ttvVDAL0tsfVDAL0tsPVDAL0ts/VDAL0tsvVDAL0tvfVDALZl92kCAKj4sWqDQLThsqfCgLn6ImSCju1tcDqHsnQiZjLcE2nKe/xCWTmE5SHwEoNj3K51oPx',
            'txtStatusCode%24__txtSelect' => '%D1%A1%D4%F1%B8%FA%D7%D9%D7%B4%CC%AC',
            'btnQry' => '%B2%E9%D1%AF',
            'rowid' => 1,
            'txtstrAwbPfx0' => $this->mawb3,
            'txtstrbum0' => $this->mawb8);
        $query_data = http_build_query($query_data);
        $http_data = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n"."Content-length:".strlen($query_data)."\r\n",
                'content' => $query_data)
            );
        $http_context = stream_context_create($http_data);
        $search_res = file_get_contents("http://cargo2.ce-air.com/MU/Service/getawbinfo.aspx?strCul=zh-CN", false, $http_context);

        preg_match("/<table align=\"center\" border=\"0\" width=\"600\" id=\"result\">.*<\/table>/s", $search_res, $mawbhead);
        $mawbinfo = str_replace("display:block", "display: none", $mawbhead[0]);
        $mawbinfo = str_replace("display:none", "display:block", $mawbinfo);
        echo "<title>东航货运系统</title>";
        echo "<link href=\"/css/track-flight.css\" rel=\"stylesheet\">";
        echo "<div style=\"float:left;\">";
        echo mb_convert_encoding($mawbinfo,"UTF-8","GB2312");
        echo "</div>";
    }

    private function flightCathayCacific()
    {
        // 国泰货运查询官网
        $url = "http://www.cathaypacificcargo.com/%E7%AE%A1%E7%90%86%E6%82%A8%E7%9A%84%E8%B4%A7%E4%BB%B6/%E8%B4%A7%E4%BB%B6%E8%BF%BD%E8%B8%AA/tabid/110/SingleAWBNo/".$this->mawb3."-".$this->mawb8."/language/zh-CN/Default.aspx";
        Header("Location: $url");
    }

    private function flightMaskargo()
    {
        // 马航货运查询官网
        $query_data = array('Process' => 'yes','code' => '232','awb' => $this->mawb8,'submit' => 'GO!');
        $query_data = http_build_query($query_data);
        $http_data = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n"."Content-length:".strlen($query_data)."\r\n",
                'content' => $query_data)
            );
            $http_context = stream_context_create($http_data);
            $search_res = file_get_contents("http://www.maskargo.com/online_awb_info/index.php", false, $http_context);

        preg_match("/<table class=\"table-content\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" style=\"BACKGROUND-COLOR: #666666\">.*<\/table>/sU", $search_res, $mawbhead);
        preg_match("/<table class=\"table-content\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"95%\" style=\"BACKGROUND-COLOR: #666666;\">.*<\/table>/sU", $search_res, $mawbtitle);

        echo "<title>马航货运查询</title>";
        echo "<link href=\"/css/track-flight.css\" rel=\"stylesheet\">";
        echo $mawbhead[0]."<br>";
        echo $mawbtitle[0];
    }

    private function flightUPS()
    {
        // UPS查询官网
        $query_data = array('loc' => 'en_US','awbNum' => $this->mawb3.$this->mawb8,'track.x' => '29','track.y' => '7');
        $query_data = http_build_query($query_data);
        $http_data = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n"."Content-length:".strlen($query_data)."\r\n",
                'content' => $query_data)
            );
            $http_context = stream_context_create($http_data);
            $search_res = file_get_contents("https://www.ups.com/actrack/track/submit", false, $http_context);

        preg_match("/<!-- Begin Table: Formatting Table 4col -->.*<!-- End Table: Formatting Table 4col -->/sU", $search_res, $mawbstatus);
        $ups_res = str_replace("/actrack/track", "https://www.ups.com/actrack/track", $mawbstatus[0]);
        echo "<link href=\"/css/track-flight.css\" rel=\"stylesheet\">";
        echo "<title>UPS货运查询</title>";
        echo $ups_res;
    }

    private function flightTK()
    {
        // 土耳其货运查询官网
        $query_data = array('prefix' => $this->mawb3,'awb'=>$this->mawb8,'lang' => 'tr','operation' => 'sorawbinput','x'=>61,'y'=>13);
        $query_data = http_build_query($query_data);
        $http_data = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n"."Content-length:".strlen($query_data)."\r\n",
                'content' => $query_data)
            );
        $http_context = stream_context_create($http_data);
        $search_res = file_get_contents("http://www.turkishcargo.com.tr/en/e-cargo/cargo-tracking", false, $http_context);
        echo $search_res;
    }

    private function flightUnitedCargo()
    {
        // 美联航查询官网
        $url = "https://booking.unitedcargo.com/skychain/app?service=page/nwp:Trackshipmt&doc_typ=AWB&awb_pre=".$this->mawb3."&awb_no=".$this->mawb8."&job_no=";
        Header("Location: $url");
    }

    private function flightEVACargo()
    {
        // 长荣货运查询官网
        $url = "http://www.brcargo.com/ec_web/Default.aspx?Parm2=191&Parm3=?TNT_FLAG=Y&AWB_CODE=".$this->mawb3."&MAWB_NUMBER=".$this->mawb8;
        Header("Location: $url");
    }

    private function flightAsiana()
    {
        // 韩亚航空运单查询
        $url = "https://www.asianacargo.com/tracking/newAirWaybill.do?globalLang=Cn&mawb=988-".$this->mawb8;
        Header("Location: $url");
    }

    private function flightSilkwayWest()
    {
        // 长荣货运查询官网
        $url = "http://www.silkwaywest.com/test.php?awb=".$this->mawb8."&pfx=".$this->mawb3;
        Header("Location: $url");
    }

    private function invalidMawb($mawb)
    {
        # 验证总单有效性
        $mawb = str_replace("-","",$mawb);
        $this->mawb3 = substr($mawb, 0,3);
        $this->mawb8 = substr($mawb, 3, 8);
        $ismawb7 = substr($mawb,3,7);
        $ismawb8 = substr($mawb,10,1);
        if(!preg_match('/^\d{11}$/', $mawb)){
            # 验证总单格式
            echo "总运单格式不正确！<br>";
            return true;
        }elseif($ismawb7%7!=$ismawb8) {
            # 验证总单规则
            echo "总运单格式不符合规则！<br>";
            return true;
        }
    }
}
