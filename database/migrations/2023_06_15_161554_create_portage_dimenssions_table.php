<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('portage_dimenssions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title') ;
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('portage_dimenssions');
    }
};
