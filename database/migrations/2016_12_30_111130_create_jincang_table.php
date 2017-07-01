<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJincangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jincang', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 托运日期
            $table->date('regdate');
            // 进仓编号
            $table->string('jcno');
            // 目的港三字代码
            $table->string('dest');
            // 航班日期
            $table->date('fltdate');
            // 托运人
            $table->string('client');
            // 货源代理
            $table->string('forward');
            // 生产厂家
            $table->string('factory');
            // 承运人代码
            $table->string('carrier');
            // 交货要求：磁检、化工鉴定、超长超高
            $table->text('delivery');
            // 货物信息：品名、件重体、尺寸
            $table->text('cargodata');
            // 备注：单证、提货等
            $table->text('remark');

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
        Schema::dropIfExists('jincang');
    }
}
