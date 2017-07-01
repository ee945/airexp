<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->increments('id');
            // 目的地三字代码
            $table->string('code');
            // 目的地英文全称
            $table->string('name');
            // 目的地地区
            $table->string('zone');
            // 等级价 M
            $table->decimal('m',15,2);
            // 等级价 N
            $table->decimal('n',15,2);
            // 等级价 Q
            $table->decimal('q',15,2);

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
        Schema::drop('ports');
    }
}
