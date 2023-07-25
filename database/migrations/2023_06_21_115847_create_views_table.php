<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('year');
            $table->unsignedBigInteger('diseases_id');
            $table->foreign('diseases_id')->references('id')->on('diseases')->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
