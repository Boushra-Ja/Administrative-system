<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('intelligent_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('degree') ;
            $table->string('infection') ;
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('intelligent_marks');
    }
};
