<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // 用户名
            $table->string('name')->unique();
            // 用户密码
            $table->string('password');
            // 用户邮件
            $table->string('email')->unique();
            // 用户昵称
            $table->string('nick');
            // 所属公司
            $table->string('company');
            // 上次登陆时间
            $table->timestamp('lastlogin');
            // 上次登陆IP
            $table->string('lastip');
            // 备注
            $table->text('remark');
            // 记住登陆状态
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
