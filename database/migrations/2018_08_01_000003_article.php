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
        Schema::create('article_statuses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('name', 256);
            $table->string('slug', 256);
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->uuid('id');

            $table->unsignedInteger('journal_id');

            $table->uuid('user_id');

            // TODO: Make field not nullable
            $table->unsignedInteger('article_status_id')->nullable();

            $table->string('title');
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_status_id')->references('id')->on('article_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_statuses');
    }
}
