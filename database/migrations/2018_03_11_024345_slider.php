<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Slider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('slider', function (Blueprint $table) {
            $table->increments('slidid');
            $table->string('slidjudul')->nullable();
            $table->text('sliddesc')->nullable();
            $table->string('slidimg')->nullable();
            $table->string('slidbg');
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
        //
    }
}
