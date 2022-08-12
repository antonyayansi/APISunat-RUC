<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('limite'); //limite de consultas por mes, ejemplo: 100, 200, 10000, etc...
            $table->integer('credit'); //creditos que poseé el usuario, ejemplo: 20, 200, etc...
            $table->integer('consult'); //consultas ya realizadas, SE AUTO INCREMENTA POR CADA CONSULTA
            $table->string('token');
            $table->integer('estado');
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
        Schema::dropIfExists('permissions');
    }
};
