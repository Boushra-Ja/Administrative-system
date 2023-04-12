<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bouns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->constrained()->onDelete('cascade');
            $table->integer('points');
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('bouns');
    }
};
