<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('advice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text') ;
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('advice');
    }
};
