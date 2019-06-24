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
            $table->string('id')->unique()->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->mediumText('description')->nullable();
            $table->string('video')->nullable();
            $table->string('img_link')->default('default_avatar.png');
            $table->rememberToken();
            $table->timestamps();

            $table->primary(array('id'));

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
    // Column Methods
    //https://laravel.com/docs/5.6/migrations#creating-columns
}
