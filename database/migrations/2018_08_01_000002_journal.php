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
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('name');
            $table->string('initials');

            $table->timestamps();
        });

        Schema::create('journal_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('journal_id');
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals');
        });

        Schema::create('journal_article_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('journal_id');
            $table->text('slug', 255);
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
        Schema::dropIfExists('journal_article_fields');
        Schema::dropIfExists('journal_settings');
        Schema::dropIfExists('journals');
    }
}
