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
            $table->string('name');
            $table->string('pass');
            $table->string('nick');
            $table->string('dept');
            $table->integer('grade');
            $table->integer('access');
            $table->datetime('regdate');
            $table->datetime('lastdate');
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
