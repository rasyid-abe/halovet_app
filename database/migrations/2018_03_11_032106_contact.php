<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('contact', function (Blueprint $table) {
            $table->increments('contid');
            $table->string('contjudul');
            $table->text('contisi');
            $table->string('contemail');
            $table->string('contname');
            $table->date('contdate');
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
