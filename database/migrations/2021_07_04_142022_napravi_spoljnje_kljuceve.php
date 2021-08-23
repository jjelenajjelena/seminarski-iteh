<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NapraviSpoljnjeKljuceve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prijava', function (Blueprint $table) {
            $table->foreign('vakcina_id')->references('id')->on('vakcina')->onDelete('cascade');
            $table->foreign('doktor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pacijent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ustanova_id')->references('id')->on('ustanova')->onDelete('cascade');
        });


        Schema::table('users', function (Blueprint $table) {
            $table->foreign('uloga_id')->references('id')->on('uloga')->onDelete('cascade');
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
