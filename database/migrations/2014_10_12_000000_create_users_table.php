<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('role');
            $table->string('email');
            $table->integer('points');
            $table->string('password')->nullable();
            $table->string('scientific_level')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
