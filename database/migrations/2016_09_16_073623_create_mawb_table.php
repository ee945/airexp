<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMawbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 总单号
            $table->string('mawb');
            // 海外代理
            $table->string('oversea');
            // 目的港三字代码
            $table->string('dest');
            // 目的港全称
            $table->string('desti');
            // 始发地代码
            $table->string('depa');
            // 始发地全称
            $table->string('depar');
            // 发货人地址
            $table->text('shipper');
            // 收货人地址
            $table->text('consignee');
            // 代理名称
            $table->string('agentabbr');
            // 代理代码
            $table->string('agentcode');
            // 代理账号
            $table->string('agentaccount');
            // 承运人两字代码
            $table->string('carrier');
            // 航班号
            $table->string('fltno');
            // 航班日期
            $table->date('fltdate');
            // 特别操作信息
            $table->text('special');
            // 包装
            $table->string('package');
            // 件数
            $table->integer('num');
            // 实际重量
            $table->integer('gw');
            // 收费重量
            $table->integer('cw');
            // 体积
            $table->decimal('cbm',15,3);
            // 运价等级
            $table->string('rclass');
            // 运费单价
            $table->decimal('up',15,2);
            // 总运费
            $table->decimal('freight',15,2);
            // 制单费名称(代码)
            $table->string('awn');
            // 油费名称(代码)
            $table->string('myn');
            // 战险名称(代码)
            $table->string('scn');
            // 油费单价
            $table->decimal('myup',15,2);
            // 战险单价
            $table->decimal('scup',15,2);
            // 制单费
            $table->decimal('aw',15,2);
            // 油费
            $table->decimal('my',15,2);
            // 战险
            $table->decimal('sc',15,2);
            // 杂费总额
            $table->decimal('other',15,2);
            // 总金额
            $table->decimal('amount',15,2);
            // 货物品名描述
            $table->text('cgodescp');
            // 制单签名
            $table->string('signature');
            // 制单地点
            $table->string('atplace');
            // 操作人
            $table->string('operator');
            // 操作日期
            $table->date('opdate');
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
        Schema::drop('mawbs');
    }
}
