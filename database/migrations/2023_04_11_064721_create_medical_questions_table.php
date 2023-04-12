<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('medical_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question') ;
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('medical_questions');
    }
};
