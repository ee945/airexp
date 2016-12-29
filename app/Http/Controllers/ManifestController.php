<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hawb;
use Excel;

class ManifestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($mawb)
    {
    	# 预览清单
    	$title = "分单清单";

    	$hawbs = Hawb::where('mawb',$mawb)->orderBy('hawb','asc')->get();
    	$hawb_first = $hawbs->first();
    	$data['hawb_count'] = $hawbs->count();
    	$data['amount_num'] = $hawbs->sum('num');
    	$data['amount_gw'] = $hawbs->sum('gw');
    	return view(theme("manifest.manifest"), compact('hawbs','hawb_first','title'))->with($data);
    }

    public function export($mawb)
    {
        # 导出清单 excel

        // 获取清单数据
        $hawbs = Hawb::where('mawb',$mawb)->orderBy('hawb','asc')->get();
        $hawb_first = $hawbs->first();
        $data['mani_dest'] = $hawb_first->dest;
        $data['mani_mawb'] = $hawb_first->mawb;
        $data['mani_fltno'] = $hawb_first->fltno;
        $data['mani_fltdate'] = $hawb_first->fltdate;
        $data['mani_count'] = $hawbs->count();
        $data['mani_num'] = $hawbs->sum('num');
        $data['mani_gw'] = $hawbs->sum('gw');

        $data['mani_oversea'] = "THE SUMITOMO WAREHOUSE CO.,LTD.";

        // 创建清单excel文件 - 文件名“manifest-{总单号}”
        Excel::create('manifest-'.$mawb,function($excel) use($data,$hawbs){
            // 创建sheet1 - 表名“清单”
            $excel->sheet("清单", function($sheet) use($data,$hawbs){
                // 设置打印方向 - 横向
                $sheet->setOrientation('landscape');
                $sheet->setfitToHeight('true');
                // 设置边距 - top, right, bottom, left
                $sheet->setPageMargin(array(0.4, 0.4, 0.4, 0.4));
                // 设置列宽
                $sheet->setWidth(array('A'=>12,'B'=>9,'C'=>9,'D'=>23,'E'=>9,'F'=>9,'G'=>24,'H'=>22,'I'=>12));
                // 设置行高
                $sheet->setHeight(array(1=>30,2=>20,3=>20,4=>15,5=>20));
                // 第一行：总标题
                $sheet->mergeCells('A1:I1');
                $sheet->cell('A1',function($cell){
                    $cell->setValue('HOUSE CARGO MANIFEST');
                    $cell->setFontFamily('Times New Roman');
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });
                // 第二行：总单信息表头
                $sheet->cells('A2:I2', function($cells) {
                    $cells->setFontFamily('Times New Roman');
                    $cells->setFontSize(10);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->mergeCells('A2:C2');
                $sheet->cell('A2',function($cell){
                    $cell->setValue('Air Freight Agent');
                    $cell->setAlignment('center');
                });
                $sheet->cell('D2',function($cell){
                    $cell->setValue('Master AWB No.');
                });
                $sheet->mergeCells('E2:F2');
                $sheet->cell('E2',function($cell){
                    $cell->setValue('Port of Discharge');
                    $cell->setAlignment('center');
                });
                $sheet->cell('G2',function($cell){
                    $cell->setValue('Total No.of Shipment');
                });
                $sheet->cell('H2',function($cell){
                    $cell->setValue('Flight No.');
                });
                $sheet->cell('I2',function($cell){
                    $cell->setValue('Date');
                });
                // 第三行：总单信息
                $sheet->cells('A3:I3', function($cells) {
                    $cells->setFontFamily('Arial');
                    $cells->setFontSize(8);
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->mergeCells('A3:C3');
                $sheet->cell('A3',function($cell) use($data){
                    $cell->setValue($data['mani_oversea']);
                    $cell->setAlignment('center');
                });
                $sheet->cell('D3',function($cell) use($data){
                    $cell->setValue($data['mani_mawb']);
                });
                $sheet->mergeCells('E3:F3');
                $sheet->cell('E3',function($cell) use($data){
                    $cell->setValue($data['mani_dest']);
                    $cell->setAlignment('center');
                });
                $sheet->cell('G3',function($cell) use($data){
                    $cell->setValue($data['mani_count']);
                });
                $sheet->cell('H3',function($cell) use($data){
                    $cell->setValue($data['mani_fltno']);
                });
                $sheet->cell('I3',function($cell) use($data){
                    $cell->setValue($data['mani_fltdate']);
                });
                // 第二、三行边框设置
                $sheet->setBorder('A2:I3', 'thin');

                // 第五行：分单列表表头
                $sheet->cells('A5:I5', function($cells) {
                    $cells->setFontFamily('Times New Roman');
                    $cells->setFontSize(10);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('left');
                    $cells->setValignment('center');
                });
                $sheet->setBorder('A5:I5', 'thin');
                $sheet->cell('A5',function($cell){$cell->setValue('Hawb No.');});
                $sheet->cell('B5',function($cell){$cell->setValue("Package");});
                $sheet->cell('C5',function($cell){$cell->setValue("Weight");});
                $sheet->cell('D5',function($cell){$cell->setValue('Nature of Goods');});
                $sheet->cell('E5',function($cell){$cell->setValue("Departure");});
                $sheet->cell('F5',function($cell){$cell->setValue("Destination");});
                $sheet->cell('G5',function($cell){$cell->setValue('Name & Address of Shipper');});
                $sheet->cell('H5',function($cell){$cell->setValue('Name & Address of Consignee');});
                $sheet->cell('I5',function($cell){$cell->setValue("Offical Use");});
                // 第六行 - 开始循环输出分单列表内容
                foreach ($hawbs as $hawb) {
                    $shipper = $hawb->shipper;
                    $consignee = $hawb->consignee;
                    $cgodescp = substr($hawb->cgodescp,0,stripos($hawb->cgodescp, "\n")-1);
                    // dd($shipper);
                    $sheet->appendRow(array(
                        'YH-'.$hawb->hawb,
                        $hawb->num,
                        $hawb->gw,
                        $cgodescp,
                        'SHA',
                        $hawb->dest,
                        $shipper,
                        $consignee
                    ));
                }
                // 设置分单列表边框
                $i = $data['mani_count']+5;
                $sheet->setBorder('A6:I'.$i, 'thin');
                // 插入最后两行：空行 + 合计数行
                $sheet->appendRow(array(''));
                $sheet->appendRow(array(
                    'TOTAL:',$data['mani_num'], $data['mani_gw']
                ));

                // 第六行后统一格式
                $sheet->cells('A6:I100', function($cells) {
                    $cells->setFontFamily('Arial');
                    $cells->setFontSize(8);
                    $cells->setAlignment('left');
                    $cells->setValignment('center');
                });
            });
        })->export('xls');
    }
}
