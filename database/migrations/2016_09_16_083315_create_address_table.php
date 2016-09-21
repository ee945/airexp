<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_address', function (Blueprint $table) {
            $table->increments('id');
            // 地址代码
            $table->string('code');
            // 地址简称
            $table->string('name');
            // 地址
            $table->text('addr');
            // 分类
            $table->string('cata');
            // 备注
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
        Schema::drop('exp_address');
    }
}
