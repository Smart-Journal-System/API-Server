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

            $table->primary('id');

            $table->foreign('journal_id')->references('id')->on('journals');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_status_id')->references('id')->on('article_statuses');
        });

        Schema::create('article_versions', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->uuid('id');
            $table->uuid('article_id');

            $table->unsignedInteger('version');

            $table->timestamps();

            $table->primary('id');

            $table->foreign('article_id')->references('id')->on('articles');
        });

        Schema::create('article_version_data', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            
            $table->uuid('article_version_id');
            $table->unsignedInteger('journal_article_field_id');

            // TODO: Make this two columns - small / large; improve the performance of this
            // table by storing data in the most appropriate column.
            $table->text('value');

            $table->foreign('journal_article_field_id')->references('id')->on('journal_article_fields');
            $table->foreign('article_version_id')->references('id')->on('article_versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_version_data');
        Schema::dropIfExists('article_versions');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_statuses');
    }
}
