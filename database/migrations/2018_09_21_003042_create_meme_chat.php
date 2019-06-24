<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemeChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meme_chat', function (Blueprint $table) {
            $table->integer('chat_id')->unsigned()->index();
            $table->integer('meme_id')->unsigned()->index();
            
            $table->primary(['chat_id', 'meme_id']);   
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->foreign('meme_id')->references('id')->on('memes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meme_chat');


    }
}
