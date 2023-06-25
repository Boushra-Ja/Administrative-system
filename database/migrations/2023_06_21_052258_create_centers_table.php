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
        Schema::create('centers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->constrained()->onDelete('cascade');
            $table->string('center_name') ;
            $table->string('diagnosis') ;
            $table->string('specialist');
            $table->string('qualification');
            $table->string('qualification_axes');
            $table->string('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
