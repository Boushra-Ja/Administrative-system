<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hours') ;
            $table->time('start') ;
            $table->string('description');
            $table->string('title');
            $table->boolean('check');
            $table->string('notes')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->integer('app_id')->unsigned();
            $table->foreign('app_id')->references('id')->on('appointments')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
