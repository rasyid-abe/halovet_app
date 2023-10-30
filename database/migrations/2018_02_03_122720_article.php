<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('article', function (Blueprint $table) {
            $table->increments('artid');
            $table->string('artjudul');
            $table->string('artslug');
            $table->text('artisi');
            $table->integer('artcat');
            $table->integer('artwriter');
            $table->date('artdate');
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
         Schema::dropIfExists('article');
    }
}
