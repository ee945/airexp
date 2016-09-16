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
            $table->string('hawb');
            $table->string('mawb');
            $table->date('opdate');
            $table->string('dest');
            $table->string('fltno');
            $table->date('fltdate');
            $table->string('forward');
            $table->string('seller');
            $table->string('factory');
            $table->string('carrier');
            $table->string('carriername');
            $table->string('paymt');
            $table->integer('arranged');
            $table->integer('num');
            $table->integer('gw');
            $table->integer('cw');
            $table->decimal('cbm',15,3);
            $table->string('remark');
            $table->string('depar');
            $table->string('desti');
            $table->text('consignee');
            $table->text('notify');
            $table->text('shipper');
            $table->string('curr');
            $table->string('nvd');
            $table->string('ncv');
            $table->string('package');
            $table->string('rclass');
            $table->text('special');
            $table->text('cgodescp');
            $table->string('agentabbr');
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
