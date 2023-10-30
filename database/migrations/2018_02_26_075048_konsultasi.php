<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Konsultasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->increments('konsid');
            $table->string('konsjudul');
            $table->string('konsslug');
            $table->text('konsisi');
            $table->integer('konscat');
            $table->integer('konswriter');
            $table->date('konsdate');
            $table->integer('konstatus');
            $table->timestamps();
            //
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
