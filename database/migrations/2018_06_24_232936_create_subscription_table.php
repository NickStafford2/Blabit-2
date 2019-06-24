<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->string('subscriber_user_id')->index();
            $table->string('subscribee_user_id')->index();

            $table->foreign('subscriber_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscribee_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(array('subscriber_user_id', 'subscribee_user_id'));
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription');
    }
}
