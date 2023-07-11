<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name') ;
            $table->integer('age');
            $table->integer('phone_num') ;
            $table->string('infection')->nullable();
            $table->string('section')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
