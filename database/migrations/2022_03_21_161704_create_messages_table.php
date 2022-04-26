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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->longText('text_msg')->nullable()->default(null);
            $table->string('img_msg')->nullable()->default(null);
            $table->string('file_msg')->nullable()->default(null);
            $table->string('file_3d_msg')->nullable()->default(null);
            //$table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
           // $table->foreign('recepient_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreignId('user_id_sender')->constrained()->onDelete('cascade');
           $table->foreignId('user_id_recepient')->constrained()->onDelete('cascade');
            $table->foreignId('chat_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
};
