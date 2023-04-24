<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('personal_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('choice') ;
            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')->references('id')->on('personal_questions')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('personal_choices');
    }
};
