<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_user', function (Blueprint $table) {
            $table->increments('id');
            // 用户名
            $table->string('name');
            // 用户密码
            $table->string('pass');
            // 用户昵称
            $table->string('nick');
            // 所在部门
            $table->string('dept');
            // 操作权限
            $table->integer('grade');
            // 访问权限
            $table->integer('access');
            // 注册时间
            $table->datetime('regdate');
            // 上次登陆时间
            $table->datetime('lastdate');
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
        Schema::drop('exp_user');
    }
}
