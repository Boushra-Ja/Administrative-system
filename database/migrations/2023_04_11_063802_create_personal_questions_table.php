<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('personal_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question') ;
            $table->boolean('type') ;
            $table->integer('title_id')->unsigned();
            $table->foreign('title_id')->references('id')->on('titels')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('personal_questions');
    }
};
