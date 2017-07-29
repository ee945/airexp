<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 姓名
            $table->string('name');
            // 性别
            $table->string('gender');
            // 代码
            $table->string('code');
            // 公司
            $table->string('company');
            // 部门职位
            $table->string('title');
            // 手机
            $table->string('mobile');
            // 座机
            $table->string('tel');
            // 传真
            $table->string('fax');
            // 邮件
            $table->string('mail');
            // 即时通讯
            $table->string('im');
            // 地址
            $table->string('address');
            // 备注
            $table->text('remark');
            // 状态
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('contacts');
    }
}
