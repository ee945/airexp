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
        # 查运抵及放行（调用货站查询系统-pactl，东航物流）
        if($this->invalidMawb($mawb)){
            echo "<br>";
        }elseif(in_array($this->mawb3, ['999','160','232','738','043','406','065','235'])){
            $this->arrivalPactl();
        }elseif(in_array($this->mawb3, ['112','784','172','217','205','297','756','672','016'])){
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
        }elseif(in_array($this->mawb3, ['112','784','172','217','205'])){
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
            '__VIEWSTATE' => '/wEPDwUKLTc1Nzc3Mzg4Mw9kFgJmD2QWCgICDw8WAh4EVGV4dAUG5p+l6K+iZGQCBA9kFgJmD2QWBGYPDxYGHglGb3JlQ29sb3IJgEAA/x8ABRLpgInmi6not5/ouKrnirbmgIEeBF8hU0ICBGRkAgEPEA9kFgIeB29uY2xpY2sFJENoZWNrQm94TGlzdF9DbGljaygndHh0U3RhdHVzQ29kZScpOxAVCQzotKfniankuqTmjqUM6LSn54mp5Ye65rivDOi/m+a4r+WIsOi+vgzotKfnianovazlh7oM55CG6LSn5a6M5q+VD+S4jeato+W4uOeZu+iusAzotKfnianmj5Dlj5YM6LSn54mp6K6i6IixDOi0p+eJqeaLieS4ixUJDOi0p+eJqeS6pOaOpQzotKfnianlh7rmuK8M6L+b5riv5Yiw6L6+DOi0p+eJqei9rOWHugznkIbotKflrozmr5UP5LiN5q2j5bi455m76K6wDOi0p+eJqeaPkOWPlgzotKfnianorqLoiLEM6LSn54mp5ouJ5LiLFCsDCWdnZ2dnZ2dnZ2RkAgUPDxYCHwAFEuWumuWItui3n+i4qumCruS7tmRkAgcPEA8WAh8ABRLmn6XnnIvmtL7pgIHkv6Hmga9kZGRkAggPFgIfAAXwHjxkaXYgY2xhc3M9J3Jlc3VsdGInIGlkPSdkaXNwbGF5MCc+PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTE2Ij8+PHRhYmxlIGFsaWduPSJjZW50ZXIiIGJvcmRlcj0iMCIgd2lkdGg9IjYwMCIgaWQ9InJlc3VsdCI+PHRyPjx0ZCB3aWR0aD0iMTAiPi48L3RkPjx0ZCB2YWxpZ249InRvcCI+PHRhYmxlIGJvcmRlcj0iMSIgd2lkdGg9IjYwMCI+PHRib2R5Pjx0cj48dGQgY29sc3Bhbj0iMTAiPjxzdHJvbmc+MjA1MjQwNTg5NjM8L3N0cm9uZz48L3RkPjwvdHI+PHRyPjx0ZCB3aWR0aD0iNTAiPuS7tiDmlbA8L3RkPjx0ZCB3aWR0aD0iOTAiPumHjSDph48oS0cpPC90ZD48dGQgd2lkdGg9IjkwIj7orqEg6YeNKEtHKTwvdGQ+PHRkIHdpZHRoPSI4MCI+5LujIOeQhjwvdGQ+PHRkIHdpZHRoPSI3MCI+5aeL5Y+R5ZywPC90ZD48dGQgd2lkdGg9IjcwIj7nm67nmoTlnLA8L3RkPjx0ZCB3aWR0aD0iMzAwIj7lk4Eg5ZCNPC90ZD48dGQgd2lkdGg9IjkwIj7nibnmrorlk4E8L3RkPjwvdHI+PHRyPjx0ZD4mbmJzcDsxPC90ZD48dGQ+Jm5ic3A7MjE4PC90ZD48dGQ+Jm5ic3A7MjE4PC90ZD48dGQ+Jm5ic3A7PC90ZD48dGQ+Jm5ic3A75LiK5rW35rWm5LicPC90ZD48dGQ+Jm5ic3A756aP5YaIPC90ZD48dGQ+Jm5ic3A7Q09OU09MPC90ZD48dGQ+Jm5ic3A7PC90ZD48L3RyPjwvdGJvZHk+PC90YWJsZT48dGFibGUgYm9yZGVyPSIxIiB3aWR0aD0iNjAwIj48dGJvZHk+PHRyPjx0ZCBjb2xzcGFuPSIxMCI+PHN0cm9uZz7oiKrmrrXkv6Hmga88L3N0cm9uZz48L3RkPjwvdHI+PHRyPjx0ZD7oo4XmnLrnq5k8L3RkPjx0ZD7ljbjmnLrnq5k8L3RkPjx0ZD7oiKrnj63lj7c8L3RkPjx0ZD7oiKrnj63ml6XmnJ88L3RkPjx0ZD7mnLrlnosv6L2m54mMPC90ZD48dGQ+5a6e6ZmF6LW36aOe5pe26Ze0PC90ZD48dGQ+5a6e6ZmF5Yiw6L6+5pe26Ze0PC90ZD48dGQ+5Lu25pWwPC90ZD48dGQ+6YeN6YePPC90ZD48dGQ+54q25oCBPC90ZD48L3RyPjx0cj48dGQ+Jm5ic3A75LiK5rW35rWm5LicPC90ZD48dGQ+Jm5ic3A75Lic5Lqs576955Sw5py65Zy677yI5Zu95YaF77yJPC90ZD48dGQ+Jm5ic3A7Tkg5Njg8L3RkPjx0ZD4mbmJzcDsyMDE3MDUwMzwvdGQ+PHRkIHN0eWxlPSJ3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7d29yZC1icmVhazogYnJlYWstYWxsOyI+Jm5ic3A7Nzg4PC90ZD48dGQ+Jm5ic3A7MjAxNzA1MDMgMDE6NDU8L3RkPjx0ZD4mbmJzcDs8L3RkPjx0ZD4mbmJzcDsxPC90ZD48dGQ+Jm5ic3A7MjE4PC90ZD48dGQ+Jm5ic3A7PC90ZD48L3RyPjwvdGJvZHk+PC90YWJsZT48dGFibGUgYm9yZGVyPSIxIiB3aWR0aD0iNjAwIiBjbGFzcz0ibmV3IiBzdHlsZT0iZGlzcGxheTpibG9jayI+PHRib2R5Pjx0cj48dGQgY29sc3Bhbj0iOCI+PHN0cm9uZz7mnIDmlrDnirbmgIHkv6Hmga8gPHNwYW4gc3R5bGU9IndpZHRoOjUwMHB4OyB0ZXh0LWFsaWduOnJpZ2h0Ij7ngrnlh7vmn6XnnIvor6bnu4bnirbmgIHkv6Hmga88L3NwYW4+PC9zdHJvbmc+PC90ZD48L3RyPjx0cj48dGQgd2lkdGg9IjYwcHgiPueKtuaAgeWQjeensDwvdGQ+PHRkPuiIquermTwvdGQ+PHRkPuiIquePreWPtzwvdGQ+PHRkPuaXpeacnzwvdGQ+PHRkPuaXtumXtDwvdGQ+PHRkPueKtuaAgeaPj+i/sDwvdGQ+PHRkPuS7tuaVsDwvdGQ+PHRkPumHjemHjzwvdGQ+PC90cj48dHI+PHRkPiZuYnNwO+WHuuWPkTwvdGQ+PHRkPiZuYnNwO+S4iua1t+a1puS4nDwvdGQ+PHRkPiZuYnNwO05IOTY4PC90ZD48dGQ+Jm5ic3A7MjAxNzA1MDM8L3RkPjx0ZD4mbmJzcDswMTo0NTwvdGQ+PHRkPiZuYnNwO+i0p+eJqeW3sueUseaMh+WumuiIquePreS7juS4iua1t+a1puS4nOi/kOWHuiwg5YmN5b6A5Lic5Lqs576955Sw5py65Zy677yI5Zu95YaF77yJLOiIquePreWunumZhei1t+mjnuaXtumXtDAxNDUsIOiuoeWIkuWIsOi+vuaXtumXtCAwNTQwPC90ZD48dGQ+Jm5ic3A7MTwvdGQ+PHRkPiZuYnNwOzIxODwvdGQ+PC90cj48L3Rib2R5PjwvdGFibGU+PHRhYmxlIGJvcmRlcj0iMSIgd2lkdGg9IjYwMCIgY2xhc3M9Im1vcmUiIHN0eWxlPSJkaXNwbGF5Om5vbmUiPjx0Ym9keT48dHI+PHRkIGNvbHNwYW49IjgiPjxzdHJvbmc+6K+m57uG54q25oCB5L+h5oGvIDxzcGFuIHN0eWxlPSJ3aWR0aDo1MDBweDsgdGV4dC1hbGlnbjpyaWdodCI+54K55Ye75p+l55yL5pyA5paw54q25oCB5L+h5oGvPC9zcGFuPjwvc3Ryb25nPjwvdGQ+PC90cj48dHI+PHRkIHdpZHRoPSI2MHB4Ij7nirbmgIHlkI3np7A8L3RkPjx0ZD7oiKrnq5k8L3RkPjx0ZD7oiKrnj63lj7c8L3RkPjx0ZD7ml6XmnJ88L3RkPjx0ZD7ml7bpl7Q8L3RkPjx0ZD7nirbmgIHmj4/ov7A8L3RkPjx0ZD7ku7bmlbA8L3RkPjx0ZD7ph43ph488L3RkPjwvdHI+PHRyPjx0ZD4mbmJzcDvlh7rlj5E8L3RkPjx0ZD4mbmJzcDvkuIrmtbfmtabkuJw8L3RkPjx0ZD4mbmJzcDtOSDk2ODwvdGQ+PHRkPiZuYnNwOzIwMTcwNTAzPC90ZD48dGQ+Jm5ic3A7MDE6NDU8L3RkPjx0ZD4mbmJzcDvotKfnianlt7LnlLHmjIflrproiKrnj63ku47kuIrmtbfmtabkuJzov5Dlh7osIOWJjeW+gOS4nOS6rOe+veeUsOacuuWcuu+8iOWbveWGhe+8iSzoiKrnj63lrp7pmYXotbfpo57ml7bpl7QwMTQ1LCDorqHliJLliLDovr7ml7bpl7QgMDU0MDwvdGQ+PHRkPiZuYnNwOzE8L3RkPjx0ZD4mbmJzcDsyMTg8L3RkPjwvdHI+PHRyPjx0ZD4mbmJzcDvotKfnianphY3ovb08L3RkPjx0ZD4mbmJzcDvkuIrmtbfmtabkuJw8L3RkPjx0ZD4mbmJzcDtOSDk2ODwvdGQ+PHRkPiZuYnNwOzIwMTcwNTAzPC90ZD48dGQ+Jm5ic3A7MDE6NDU8L3RkPjx0ZD4mbmJzcDvotKfnianlt7LooqvphY3kuIrmjIflrproiKrnj60s6K6h5YiS5LuOIOS4iua1t+a1puS4nCDov5DlvoAg5Lic5Lqs576955Sw5py65Zy677yI5Zu95YaF77yJIOiIquePreiuoeWIkui1t+mjnuaXtumXtCAwMTQ1LOiuoeWIkuWIsOi+vuaXtumXtCAwNTQwPC90ZD48dGQ+Jm5ic3A7MTwvdGQ+PHRkPiZuYnNwO1NMQUMgUGllY2U6MTwvdGQ+PC90cj48dHI+PHRkPiZuYnNwO+i0p+eJqemihOmFjTwvdGQ+PHRkPiZuYnNwO+S4iua1t+a1puS4nDwvdGQ+PHRkPiZuYnNwO05IOTY4PC90ZD48dGQ+Jm5ic3A7MjAxNzA1MDM8L3RkPjx0ZD4mbmJzcDswMTo0NTwvdGQ+PHRkPiZuYnNwO+i0p+eJqeW3sumihOmFjeS4iuaMh+WumuiIquePrSzorqHliJLku44g5LiK5rW35rWm5LicIOi/kOW+gCDkuJzkuqznvr3nlLDmnLrlnLrvvIjlm73lhoXvvIkg6Iiq54+t6K6h5YiS6LW36aOe5pe26Ze0IDAxNDUsIOiuoeWIkuWIsOi+vuaXtumXtCAwNTQwPC90ZD48dGQ+Jm5ic3A7MTwvdGQ+PHRkPiZuYnNwOzIxODwvdGQ+PC90cj48dHI+PHRkPiZuYnNwO+W3suaKpeWFszwvdGQ+PHRkPiZuYnNwO+S4iua1t+a1puS4nDwvdGQ+PHRkPiZuYnNwOzwvdGQ+PHRkPiZuYnNwOzIwMTcwNTAyPC90ZD48dGQ+Jm5ic3A7MjA6MTQ8L3RkPjx0ZD4mbmJzcDvotKfniankv6Hmga/lt7LkvKDovpPnu5nmtbflhbM8L3RkPjx0ZD4mbmJzcDsxPC90ZD48dGQ+Jm5ic3A7MjE4PC90ZD48L3RyPjx0cj48dGQ+Jm5ic3A75pS26LSnPC90ZD48dGQ+Jm5ic3A75LiK5rW35rWm5LicPC90ZD48dGQ+Jm5ic3A7PC90ZD48dGQ+Jm5ic3A7MjAxNzA1MDI8L3RkPjx0ZD4mbmJzcDsyMDoxNDwvdGQ+PHRkPiZuYnNwO+S7juWPkei0p+S6uuaIluWFtuS7o+eQhiAg5omL5Lit5pS25Yiw5Ye65riv6LSn54mp5ZKM5paH5Lu2PC90ZD48dGQ+Jm5ic3A7MTwvdGQ+PHRkPiZuYnNwOzIxODwvdGQ+PC90cj48dHI+PHRkPiZuYnNwOzwvdGQ+PHRkPiZuYnNwOzwvdGQ+PHRkPiZuYnNwOzwvdGQ+PHRkPiZuYnNwOzIwMTcwNTAyPC90ZD48dGQ+Jm5ic3A7MjA6MTQ8L3RkPjx0ZD4mbmJzcDs8L3RkPjx0ZD4mbmJzcDs8L3RkPjx0ZD4mbmJzcDs8L3RkPjwvdHI+PC90Ym9keT48L3RhYmxlPjxwIC8+PHAgLz48L3RkPjx0ZCB3aWR0aD0iMTAiPi48L3RkPjwvdHI+PC90YWJsZT48L2Rpdj5kGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYLBR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDAFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkMQUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQyBR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDMFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkNAUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQ1BR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDYFHnR4dFN0YXR1c0NvZGUkX2dyaWRDaGVja0xpc3QkNwUedHh0U3RhdHVzQ29kZSRfZ3JpZENoZWNrTGlzdCQ4BR50eHRTdGF0dXNDb2RlJF9ncmlkQ2hlY2tMaXN0JDgFDWNoa1F1ZXJ5VGFsbHlf3VH1GtuGSRnebUvRRYPrM75mFJ7b3GMyyBxqAQhQKw==',
            '__EVENTVALIDATION' => '/wEWEgLilvCEDQK4kq2dCgLRxoa2CAL2ktWKCwKXnpSaAQKfwsyDBAL0ttfVDAL0ttPVDAL0tt/VDAL0ttvVDAL0tsfVDAL0tsPVDAL0ts/VDAL0tsvVDAL0tvfVDALZl92kCAKj4sWqDQLn6ImSChmmMP9YYsBFx62s8v0Mv+qUGzUMe+xl6E2jh1j3gezB',
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
