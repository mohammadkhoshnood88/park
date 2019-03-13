<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('shop_name');
            $table->string('logo');
            $table->string('adderss');
            $table->string('type');
            $table->string('groups');
            $table->string('race_title');
            $table->string('race_desc');
            $table->string('arr_time');
            $table->string('number');
            $table->string('st_time');
            $table->string('fin_time');
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
        Schema::dropIfExists('shops');
    }
}
