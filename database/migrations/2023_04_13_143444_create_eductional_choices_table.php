<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eductional_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('choice') ;
            $table->integer('edu_id')->unsigned();
            $table->foreign('edu_id')->references('id')->on('eductional_questions')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eductional_choices');
    }
};
