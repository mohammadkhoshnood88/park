<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('beacon_id');
            $table->string('customer_id');
            $table->String('rssi');
            $table->String('beacon_mac');
            $table->integer('count');
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
        Schema::dropIfExists('iots');
    }
}
