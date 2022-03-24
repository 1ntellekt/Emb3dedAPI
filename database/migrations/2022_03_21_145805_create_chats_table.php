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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->boolean('download_first')->default(false);
            $table->boolean('download_second')->default(false);
            $table->foreignId('user_id_first')->constrained()->onDelete('cascade');
            $table->foreignId('user_id_second')->constrained()->onDelete('cascade');

            $table->unique(['user_id_first', 'user_id_second']);

            //$table->foreign('user_first')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('user_second')->references('id')->on('users')->onDelete('cascade');
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
