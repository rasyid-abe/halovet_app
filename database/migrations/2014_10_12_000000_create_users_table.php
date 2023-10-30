<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('role')->default(1);
            $table->string('email')->unique();
            $table->string('profilepic')->default('images/profile.png');
            $table->string('password');
            $table->string('nohp');
            $table->text('bio')->nullable();
            $table->tinyInteger('verified')->default(0); // this column will be a TINYINT with a default value of 0 , [0 for false & 1 for true i.e. verified]
            $table->string('alamat')->nullable();
            $table->string('email_token')->nullable(); // this column will be a VARCHAR with no default value and will also BE NULLABLE
            $table->string('tahunlulus')->nullable();
            $table->string('lulusan')->nullable();
            $table->string('klinik')->nullable();
            $table->string('longlatklinik')->nullable();
            $table->string('scanktp')->nullable();
            $table->string('scansurat')->nullable();
            $table->string('pengalaman')->nullable();
             $table->tinyInteger('verifadmin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
