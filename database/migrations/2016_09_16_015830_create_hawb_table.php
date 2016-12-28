<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHawbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_hawb', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 分单号
            $table->string('hawb');
            // 总单号
            $table->string('mawb');
            // 操作日期
            $table->date('opdate');
            // 目的港三字代码
            $table->string('dest');
            // 航班号
            $table->string('fltno');
            // 航班日期
            $table->date('fltdate');
            // 货源代理
            $table->string('forward');
            // 销售人
            $table->string('seller');
            // 生产厂家
            $table->string('factory');
            // 承运人代码
            $table->string('carrier');
            // 承运人名称
            $table->string('carriername');
            // 付费方式
            $table->string('paymt');
            // 费用不显示
            $table->integer('arranged');
            // 件数
            $table->integer('num');
            // 实际重量
            $table->integer('gw');
            // 收费重量
            $table->integer('cw');
            // 体积
            $table->decimal('cbm',15,3);
            // 备注
            $table->string('remark');
            // 始发地全称
            $table->string('depar');
            // 目的港全称
            $table->string('desti');
            // 收货人地址
            $table->text('consignee');
            // 通知人地址
            $table->text('notify');
            // 发货人地址
            $table->text('shipper');
            // 币制
            $table->string('curr');
            // 无价值声明
            $table->string('nvd');
            $table->string('ncv');
            // 包装
            $table->string('package');
            // 运价等级
            $table->string('rclass');
            // 特别操作信息
            $table->text('special');
            // 货物品名及描述
            $table->text('cgodescp');
            // 代理代码/缩写
            $table->string('agentabbr');
            // 添加时间
            $table->datetime('regtime');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exp_hawb');
    }
}
