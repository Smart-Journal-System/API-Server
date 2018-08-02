<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Journal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('journal_settings', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->unsignedInteger('journal_id');
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
        Schema::dropIfExists('journal_settings');
    }
}
