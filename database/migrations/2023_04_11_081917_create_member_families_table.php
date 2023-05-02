<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('member_families', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->constrained()->onDelete('cascade');
            $table->string('gender') ;
            $table->string('name') ;
            $table->integer('age');
            $table->string('Educ_level');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('member_families');
    }
};
