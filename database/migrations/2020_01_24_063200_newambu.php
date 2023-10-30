<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Newambu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulatoir', function (Blueprint $table) {
            $table->increments('perid');
            $table->integer('perpetid');
            $table->string('perberatbadan');
            $table->text('perkedumum');
            $table->string('perfreknafas');
            $table->string('perkfrekpulsus');
            $table->string('perturgor');
            $table->integer('perkedmata')->nullable();
            $table->integer('permata')->nullable();
            $table->integer('perkedmukosa')->nullable();
            $table->integer('permukosa')->nullable();
            $table->string('percrt')->nullable();
            $table->text('perfotoperiksa')->nullable();
            $table->text('perpencernaan')->nullable();
            $table->text('perpernafasan')->nullable();
            $table->text('persirkulasi')->nullable();
            $table->text('pergenitalia')->nullable();
            $table->text('perurinaria')->nullable();
            $table->text('persaraf')->nullable();
            $table->text('peranggotagerak')->nullable();
            $table->text('perkulitrambut')->nullable();
            $table->text('perusg')->nullable();
            $table->text('perfotousg')->nullable();
            $table->text('perrontgent')->nullable();
            $table->text('perfotorontgent')->nullable();
            $table->text('perbloodcount')->nullable();
            $table->text('perfotobloodcount')->nullable();
            $table->text('perbloodsmear')->nullable();
            $table->text('perfotobloodsmear')->nullable();
            $table->text('perurinalysis')->nullable();
            $table->text('perfotourinalysis')->nullable();
            $table->text('perfeses')->nullable();
            $table->text('perfotofeses')->nullable();
            $table->text('perfungsiorgan')->nullable();
            $table->text('perfotofungsiorgan')->nullable();
            $table->text('perpatologi')->nullable();
            $table->text('perfotopatologi')->nullable();
            $table->text('perdiagnosa')->nullable();
            $table->text('perterapi')->nullable();
            $table->integer('perdokid')->nullable();
            $table->date('pertanggal')->nullable();
            $table->integer('pertatus')->nullable();
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
