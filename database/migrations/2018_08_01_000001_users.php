<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->uuid('id');

            $table->string('name')->unique();

            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->uuid('id');

            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');

            $table->rememberToken();

            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('organization_users', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->uuid('user_id');
            $table->uuid('organization_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('organization_users');

        Schema::dropIfExists('users');
        Schema::dropIfExists('organizations');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
