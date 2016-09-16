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
        Schema::create('exp_mawb', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mawb');
            $table->string('oversea');
            $table->string('dest');
            $table->string('desti');
            $table->string('depa');
            $table->string('depar');
            $table->text('shipper');
            $table->text('consignee');
            $table->string('agentabbr');
            $table->string('agentcode');
            $table->string('agentaccount');
            $table->string('carrier');
            $table->string('fltno');
            $table->date('fltdate');
            $table->text('special');
            $table->string('package');
            $table->integer('num');
            $table->integer('gw');
            $table->integer('cw');
            $table->decimal('cbm',15,3);
            $table->string('rclass');
            $table->decimal('up',15,2);
            $table->decimal('freight',15,2);
            $table->string('awn');
            $table->string('myn');
            $table->string('scn');
            $table->decimal('myup',15,2);
            $table->decimal('scup',15,2);
            $table->decimal('aw',15,2);
            $table->decimal('my',15,2);
            $table->decimal('sc',15,2);
            $table->decimal('other',15,2);
            $table->decimal('amount',15,2);
            $table->text('cgodescp');
            $table->string('signature');
            $table->string('atplace');
            $table->string('operator');
            $table->date('opdate');
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
        Schema::drop('exp_mawb');
    }
}
