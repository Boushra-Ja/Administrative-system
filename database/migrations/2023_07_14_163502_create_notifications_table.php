<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('message');
            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
