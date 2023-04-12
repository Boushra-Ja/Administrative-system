<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('portage_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('type') ;
            $table->integer('Social_age') ;
            $table->integer('Knowladge_age') ;
            $table->integer('Connection_age') ;
            $table->integer('Care_age') ;
            $table->integer('Movement_age') ;
            $table->string('infection') ;
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('portage_marks');
    }
};
